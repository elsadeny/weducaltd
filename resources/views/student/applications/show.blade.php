<x-student.layouts.app title="Application Details">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('student.applications.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-navy transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to applications
            </a>
        </div>

        @php
            $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
            $c = $colors[$application->status] ?? 'gray';
        @endphp

        {{-- Header card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-navy">{{ $application->program }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ $application->institution->name ?? '—' }} · {{ $application->destination->name ?? '—' }}</p>
                    <p class="text-gray-400 text-xs mt-1">Submitted {{ $application->created_at->format('M d, Y') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-{{ $c }}-100 text-{{ $c }}-700 self-start">
                    {{ $application->status_label }}
                </span>
            </div>

            {{-- Progress tracker --}}
            @if($application->status !== 'rejected')
                @php
                    $steps = [
                        ['label' => 'Submitted',     'status' => 'pending'],
                        ['label' => 'Under Review',  'status' => 'reviewing'],
                        ['label' => 'Docs Review',   'status' => 'documents_required'],
                        ['label' => 'Approved',      'status' => 'approved'],
                    ];
                    $currentIdx = 0;
                    foreach($steps as $i => $step) {
                        if ($application->status === $step['status']) $currentIdx = $i;
                    }
                    if ($application->status === 'approved') $currentIdx = 3;
                @endphp
                <div class="mt-6 flex items-center space-x-1">
                    @foreach($steps as $i => $step)
                        <div class="flex-1">
                            <div class="h-2 rounded-full {{ $i <= $currentIdx ? 'bg-teal' : 'bg-gray-100' }}"></div>
                            <div class="text-xs text-center mt-1.5 {{ $i <= $currentIdx ? 'text-teal font-semibold' : 'text-gray-400' }}">
                                {{ $step['label'] }}
                            </div>
                        </div>
                        @if(!$loop->last) <div class="w-1"></div> @endif
                    @endforeach
                </div>
            @else
                <div class="mt-4 bg-red-50 border border-red-100 rounded-xl px-4 py-3">
                    <p class="text-red-700 text-sm font-medium">This application was not successful.</p>
                </div>
            @endif
        </div>

        {{-- Pending document requests alert --}}
        @if($application->status !== 'rejected' && $application->pendingDocumentRequests->isNotEmpty())
            <div class="bg-orange-50 border border-orange-200 rounded-2xl p-5 mb-4">
                <div class="flex items-center space-x-2 mb-3">
                    <svg class="w-5 h-5 text-orange-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    <span class="font-bold text-orange-800">Action Required — Documents Needed</span>
                </div>
                <p class="text-orange-700 text-sm mb-4">Please upload the following documents to continue with your application:</p>
                <div class="space-y-4">
                    @foreach($application->pendingDocumentRequests as $req)
                        <div class="bg-white rounded-xl border border-orange-100 p-4">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <p class="font-semibold text-navy text-sm">{{ $req->document_type }}</p>
                                    @if($req->note)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $req->note }}</p>
                                    @endif
                                </div>
                                <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-700 font-semibold">Pending</span>
                            </div>
                            <form method="POST"
                                  action="{{ route('student.applications.upload', $application) }}"
                                  enctype="multipart/form-data"
                                  class="flex flex-col sm:flex-row gap-2 mt-3">
                                @csrf
                                <input type="hidden" name="type" value="{{ $req->document_type }}">
                                <input type="hidden" name="request_id" value="{{ $req->id }}">
                                <input type="file" name="document" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                    class="flex-1 px-3 py-2 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                                <button type="submit"
                                    class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-xl transition whitespace-nowrap">
                                    Upload
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Fulfilled requests (collapsed) --}}
        @if($application->documentRequests->where('fulfilled_at', '!=', null)->isNotEmpty())
            <div class="bg-green-50 border border-green-100 rounded-2xl px-5 py-4 mb-4">
                <p class="text-green-800 font-semibold text-sm mb-2">&#10003; Completed Document Requests</p>
                <div class="space-y-1">
                    @foreach($application->documentRequests->whereNotNull('fulfilled_at') as $req)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-green-700">{{ $req->document_type }}</span>
                            <span class="text-xs text-green-600">Uploaded {{ $req->fulfilled_at->format('M d, Y') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Admin notes if any --}}
        @if($application->admin_notes)
            <div class="bg-blue-50 border border-blue-100 rounded-2xl px-5 py-4 mb-4">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold text-blue-800 text-sm">Message from Admissions Team</span>
                </div>
                <p class="text-blue-700 text-sm">{{ $application->admin_notes }}</p>
            </div>
        @endif

        {{-- Details --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4">
            <h3 class="font-bold text-navy mb-4">Application Details</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-400">Program</span>
                    <span class="font-medium text-navy">{{ $application->program }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-400">Institution</span>
                    <span class="font-medium text-navy">{{ $application->institution->name ?? '—' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-gray-400">Destination</span>
                    <span class="font-medium text-navy">{{ $application->destination->name ?? '—' }}</span>
                </div>
                @if($application->notes)
                    <div class="py-2">
                        <span class="text-gray-400 block mb-1">Your Notes</span>
                        <p class="text-navy">{{ $application->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Documents --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-navy">Documents</h3>
                <span class="text-xs text-gray-400">{{ $application->documents->count() }} uploaded</span>
            </div>

            @if($application->documents->isEmpty())
                <p class="text-gray-400 text-sm text-center py-6">No documents uploaded yet.</p>
            @else
                <div class="space-y-2 mb-4">
                    @foreach($application->documents as $doc)
                        <div class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-teal shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-navy">{{ $doc->name }}</p>
                                    @if($doc->type) <p class="text-xs text-gray-400">{{ $doc->type }}</p> @endif
                                </div>
                            </div>
                            <a href="{{ Storage::url($doc->path) }}" target="_blank"
                               class="text-teal text-xs font-semibold hover:underline">View</a>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Upload more --}}
            @if($application->status !== 'rejected')
            <form method="POST"
                  action="{{ route('student.applications.upload', $application) }}"
                  enctype="multipart/form-data"
                  class="border-t border-gray-100 pt-4">
                @csrf
                <p class="text-sm font-semibold text-navy mb-3">Upload additional document</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <select name="type"
                        class="w-full sm:w-48 px-3 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                        <option value="">Document type</option>
                        <option>Passport</option>
                        <option>Transcript</option>
                        <option>Diploma / Certificate</option>
                        <option>Recommendation Letter</option>
                        <option>Personal Statement</option>
                        <option>Language Certificate</option>
                        <option>Payment Slip</option>
                        <option>Other</option>
                    </select>
                    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                        class="flex-1 px-3 py-2 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                    <button type="submit" class="bg-teal text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-teal-light transition whitespace-nowrap">
                        Upload
                    </button>
                </div>
            </form>
            @else
            <div class="border-t border-gray-100 pt-4">
                <p class="text-sm text-red-500 text-center">This application is closed. No further uploads are accepted. Contact us if you need assistance.</p>
            </div>
            @endif
        </div>
    </div>

</x-student.layouts.app>
