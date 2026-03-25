<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocumentRequest;
use App\Models\Setting;
use App\Mail\ApplicationStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['student', 'institution', 'destination', 'documents']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('application_type', $request->type);
        }

        if ($request->filled('search')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('period')) {
            $period = $request->period;
            if ($period === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($period === 'week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($period === 'month') {
                $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
            } elseif ($period === 'year') {
                $query->whereYear('created_at', now()->year);
            }
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->latest()->paginate(15)->withQueryString();

        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        $application->load(['student', 'institution', 'destination', 'documents', 'documentRequests.document']);
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $data = $request->validate([
            'status'                  => 'required|in:pending,reviewing,approved,rejected,documents_required',
            'admin_notes'             => 'nullable|string',
            'doc_requests'            => 'nullable|array',
            'doc_requests.*.type'     => 'required_with:doc_requests|string|max:100',
            'doc_requests.*.note'     => 'nullable|string|max:255',
        ]);

        $application->update([
            'status'      => $data['status'],
            'admin_notes' => $data['admin_notes'] ?? null,
        ]);

        // When requesting documents, save each requested type
        if ($data['status'] === 'documents_required' && !empty($data['doc_requests'])) {
            // Delete old unfulfilled requests and replace with new ones
            $application->documentRequests()->whereNull('fulfilled_at')->delete();

            foreach ($data['doc_requests'] as $req) {
                if (!empty($req['type'])) {
                    ApplicationDocumentRequest::create([
                        'application_id' => $application->id,
                        'document_type'  => $req['type'],
                        'note'           => $req['note'] ?? null,
                    ]);
                }
            }
        }

        $this->sendStatusEmail($application);

        return back()->with('success', 'Application status updated.');
    }

    private function sendStatusEmail(Application $application): void
    {
        try {
            // Apply dynamic SMTP settings from DB
            $host       = Setting::get('smtp_host');
            $port       = Setting::get('smtp_port', 587);
            $encryption = Setting::get('smtp_encryption', 'tls');
            $username   = Setting::get('smtp_username');
            $password   = Setting::get('smtp_password');
            $fromAddr   = Setting::get('mail_from_address');
            $fromName   = Setting::get('mail_from_name', Setting::get('site_name', 'WeducaApply'));

            if ($host && $username && $fromAddr) {
                config([
                    'mail.mailers.smtp.host'       => $host,
                    'mail.mailers.smtp.port'       => $port,
                    'mail.mailers.smtp.encryption' => $encryption ?: null,
                    'mail.mailers.smtp.username'   => $username,
                    'mail.mailers.smtp.password'   => $password,
                    'mail.from.address'            => $fromAddr,
                    'mail.from.name'               => $fromName,
                ]);

                $studentEmail = $application->student?->email ?? $application->student?->user?->email;
                if ($studentEmail) {
                    Mail::to($studentEmail)->send(new ApplicationStatusChanged($application));
                }
            }
        } catch (\Throwable $e) {
            // Log but don't fail the request if email fails
            logger()->error('Status email failed: ' . $e->getMessage());
        }
    }}