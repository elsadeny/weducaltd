<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
    <style>
        body { font-family: 'Inter', Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #e5e7eb; }
        .header { background: #1e3a5f; padding: 32px 40px; }
        .header h1 { color: #fff; font-size: 22px; margin: 0 0 4px; }
        .header p { color: #93c5fd; font-size: 14px; margin: 0; }
        .body { padding: 32px 40px; }
        .status-badge { display: inline-block; padding: 6px 18px; border-radius: 999px; font-size: 13px; font-weight: 700; margin: 0 0 20px; }
        .s-pending   { background: #fef3c7; color: #92400e; }
        .s-reviewing { background: #dbeafe; color: #1e40af; }
        .s-approved  { background: #d1fae5; color: #065f46; }
        .s-rejected  { background: #fee2e2; color: #991b1b; }
        .s-documents_required { background: #ffedd5; color: #9a3412; }
        .card { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin: 20px 0; }
        .card-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e5e7eb; font-size: 14px; }
        .card-row:last-child { border-bottom: none; }
        .label { color: #6b7280; }
        .value { color: #111827; font-weight: 600; }
        .notes-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 16px; margin-top: 20px; font-size: 14px; color: #1e40af; }
        .footer { background: #f9fafb; border-top: 1px solid #e5e7eb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; }
        .btn { display: inline-block; background: #0ea5a0; color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 999px; font-size: 14px; font-weight: 700; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>{{ \App\Models\Setting::get('site_name', 'WeducaApply') }}</h1>
            <p>Application Status Update</p>
        </div>

        <div class="body">
            <p style="font-size:16px;color:#111827;margin:0 0 16px;">
                Hi <strong>{{ $application->student->name ?? 'Applicant' }}</strong>,
            </p>
            <p style="font-size:14px;color:#4b5563;margin:0 0 20px;">
                Your application status has been updated. Here are the details:
            </p>

            @php
                $status = $application->status;
                $badgeClass = 's-' . $status;
            @endphp
            <span class="status-badge {{ $badgeClass }}">{{ $application->status_label }}</span>

            <div class="card">
                <div class="card-row">
                    <span class="label">Program</span>
                    <span class="value">{{ $application->program }}</span>
                </div>
                <div class="card-row">
                    <span class="label">Institution</span>
                    <span class="value">{{ $application->institution->name ?? '—' }}</span>
                </div>
                <div class="card-row">
                    <span class="label">Destination</span>
                    <span class="value">{{ $application->destination->name ?? '—' }}</span>
                </div>
                <div class="card-row">
                    <span class="label">Application Type</span>
                    <span class="value">{{ ucfirst($application->application_type ?? 'Study') }}</span>
                </div>
            </div>

            @if($application->admin_notes)
                <div class="notes-box">
                    <strong>Message from Admissions Team:</strong><br>
                    {{ $application->admin_notes }}
                </div>
            @endif

            @if($application->pendingDocumentRequests->isNotEmpty())
                <div style="background:#fff7ed;border:1px solid #fed7aa;border-radius:10px;padding:16px;margin-top:16px;">
                    <strong style="color:#9a3412;font-size:14px;">&#9888; Documents Required:</strong>
                    <ul style="margin:8px 0 0;padding-left:18px;font-size:14px;color:#9a3412;">
                        @foreach($application->pendingDocumentRequests as $req)
                            <li>{{ $req->document_type }}{{ $req->note ? ' — ' . $req->note : '' }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="text-align:center;">
                <a href="{{ url('/portal/applications/' . $application->id) }}" class="btn">View My Application →</a>
            </div>
        </div>

        <div class="footer">
            <p>{{ \App\Models\Setting::get('site_name', 'WeducaApply') }} &mdash; {{ \App\Models\Setting::get('contact_email', '') }}</p>
            <p>{{ \App\Models\Setting::get('contact_address', '') }}</p>
            <p style="margin-top:8px;">You are receiving this because you have an active application with us.</p>
        </div>
    </div>
</body>
</html>
