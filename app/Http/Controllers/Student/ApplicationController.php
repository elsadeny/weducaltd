<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\ApplicationDocumentRequest;
use App\Models\Destination;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $student      = Auth::user()->student;
        $applications = $student
            ? $student->applications()->with(['institution', 'destination', 'documents'])->latest()->get()
            : collect();

        return view('student.applications.index', compact('applications'));
    }

    public function create()
    {
        $institutions = Institution::with('destination')->orderBy('name')->get();
        $destinations = Destination::orderBy('name')->get();
        $programs     = \App\Models\Program::where('is_active', true)->orderBy('name')->get();
        return view('student.applications.create', compact('institutions', 'destinations', 'programs'));
    }

    public function store(Request $request)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return back()->with('error', 'Student profile not found.');
        }

        $isWork = $request->input('application_type') === 'work';

        $data = $request->validate([
            'institution_id'   => $isWork ? 'nullable' : 'required|exists:institutions,id',
            'destination_id'   => 'required|exists:destinations,id',
            'program'          => $isWork ? 'nullable|string|max:255' : 'required|string|max:255',
            'notes'            => 'nullable|string',
            'application_type' => 'nullable|in:study,work',
            'documents.*'      => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'doc_types.*'      => 'nullable|string|max:100',
        ]);

        $institutionId = $isWork ? null : ($data['institution_id'] ?? null);

        $application = $student->applications()->create([
            'institution_id'   => $institutionId,
            'destination_id'   => $data['destination_id'],
            'program'          => $data['program'] ?? null,
            'notes'            => $data['notes'] ?? null,
            'status'           => 'pending',
            'application_type' => $data['application_type'] ?? 'study',
        ]);

        // Handle document uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $i => $file) {
                $path = $file->store('documents', 'public');
                ApplicationDocument::create([
                    'application_id' => $application->id,
                    'name'           => $file->getClientOriginalName(),
                    'path'           => $path,
                    'type'           => $request->input("doc_types.$i"),
                ]);
            }
        }

        return redirect()->route('student.applications.show', $application)
            ->with('success', 'Application submitted successfully!');
    }

    public function show(Application $application)
    {
        $student = Auth::user()->student;

        if (!$student || $application->student_id !== $student->id) {
            abort(403);
        }

        $application->load(['institution', 'destination', 'documents', 'documentRequests.document']);
        return view('student.applications.show', compact('application'));
    }

    public function uploadDocument(Request $request, Application $application)
    {
        $student = Auth::user()->student;

        if (!$student || $application->student_id !== $student->id) {
            abort(403);
        }

        if ($application->status === 'rejected') {
            return back()->with('error', 'This application is closed. Document uploads are not accepted.');
        }

        $request->validate([
            'document'    => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'type'        => 'nullable|string|max:100',
            'request_id'  => 'nullable|exists:application_document_requests,id',
        ]);

        $file = $request->file('document');
        $path = $file->store('documents', 'public');

        $doc = ApplicationDocument::create([
            'application_id' => $application->id,
            'name'           => $file->getClientOriginalName(),
            'path'           => $path,
            'type'           => $request->input('type'),
        ]);

        // Mark the related document request as fulfilled if provided
        if ($request->filled('request_id')) {
            ApplicationDocumentRequest::where('id', $request->request_id)
                ->where('application_id', $application->id)
                ->whereNull('fulfilled_at')
                ->update([
                    'fulfilled_at' => now(),
                    'document_id'  => $doc->id,
                ]);
        }

        return back()->with('success', 'Document uploaded successfully.');
    }
}
