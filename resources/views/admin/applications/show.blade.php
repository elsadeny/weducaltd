44<x-admin.layouts.app title="Review Application">

    <div class="max-w-3xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-navy transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to applications
            </a>
        </div>

        @php
            $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
            $c = $colors[$application->status] ?? 'gray';
        @endphp

        {{-- Header --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-navy">{{ $application->program }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ $application->institution->name ?? '—' }} · {{ $application->destination->name ?? '—' }}</p>
                    <p class="text-gray-400 text-xs mt-1">Submitted {{ $application->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-{{ $c }}-100 text-{{ $c }}-700 self-start">
                    {{ $application->status_label }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">

            {{-- Student info --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 lg:col-span-1">
                <h3 class="font-bold text-navy mb-4">Student</h3>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center text-white font-bold text-lg shrink-0">
                        {{ strtoupper(substr($application->student->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-navy">{{ $application->student->name ?? '—' }}</div>
                        <div class="text-gray-400 text-xs">{{ $application->student->email ?? '' }}</div>
                    </div>
                </div>
                <div class="space-y-2 text-sm">
                    @if($application->student->phone)
                        <div class="flex justify-between">
                            <span class="text-gray-400">Phone</span>
                            <span class="text-navy">{{ $application->student->phone }}</span>
                        </div>
                    @endif
                    @if($application->student->nationality)
                        <div class="flex justify-between">
                            <span class="text-gray-400">Nationality</span>
                            <span class="text-navy">{{ $application->student->nationality }}</span>
                        </div>
                    @endif
                    @if($application->student->passport_number)
                        <div class="flex justify-between">
                            <span class="text-gray-400">Passport</span>
                            <span class="text-navy">{{ $application->student->passport_number }}</span>
                        </div>
                    @endif
                </div>
                <a href="{{ route('admin.students.show', $application->student) }}"
                   class="mt-4 block text-center text-sm text-teal font-semibold hover:underline">
                    View full profile →
                </a>
            </div>

            {{-- Application details --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 lg:col-span-2">
                <h3 class="font-bold text-navy mb-4">Application Details</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-400">Program</span>
                        <span class="font-medium text-navy">{{ $application->program }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-400">Type</span>
                        @php $isWork = ($application->application_type ?? 'study') === 'work'; @endphp
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $isWork ? 'bg-indigo-100 text-indigo-700' : 'bg-teal/10 text-teal' }}">
                            {{ $isWork ? 'Work Abroad' : 'Study Abroad' }}
                        </span>
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
                            <span class="text-gray-400 block mb-1">Student Notes</span>
                            <p class="text-navy text-sm">{{ $application->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Documents --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
            <h3 class="font-bold text-navy mb-4">Uploaded Documents <span class="text-gray-400 font-normal text-sm">({{ $application->documents->count() }})</span></h3>
            @if($application->documents->isEmpty())
                <p class="text-gray-400 text-sm py-4 text-center">No documents uploaded.</p>
            @else
                <div class="space-y-2">
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
                               class="text-teal text-xs font-semibold hover:underline px-3 py-1 bg-teal/10 rounded-full">
                                View / Download
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Existing document requests --}}
        @if($application->documentRequests->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
                <h3 class="font-bold text-navy mb-4">Document Requests <span class="text-gray-400 font-normal text-sm">({{ $application->documentRequests->count() }})</span></h3>
                <div class="space-y-3">
                    @foreach($application->documentRequests as $req)
                        <div class="flex items-start justify-between rounded-xl px-4 py-3 {{ $req->isFulfilled() ? 'bg-green-50 border border-green-100' : 'bg-orange-50 border border-orange-100' }}">
                            <div>
                                <p class="text-sm font-semibold {{ $req->isFulfilled() ? 'text-green-700' : 'text-orange-800' }}">{{ $req->document_type }}</p>
                                @if($req->note) <p class="text-xs mt-0.5 {{ $req->isFulfilled() ? 'text-green-600' : 'text-orange-600' }}">{{ $req->note }}</p> @endif
                                @if($req->isFulfilled())
                                    <p class="text-xs text-green-600 mt-1">&#10003; Fulfilled on {{ $req->fulfilled_at->format('M d, Y') }}</p>
                                @endif
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full font-semibold {{ $req->isFulfilled() ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                {{ $req->isFulfilled() ? 'Fulfilled' : 'Pending' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Update status --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-bold text-navy mb-4">Update Application Status</h3>
            <form method="POST" action="{{ route('admin.applications.update-status', $application) }}">
                @csrf
                @method('PATCH')

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                    <select name="status" id="statusSelect" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                        @foreach(['pending'=>'Pending','reviewing'=>'Under Review','documents_required'=>'Documents Required','approved'=>'Approved','rejected'=>'Rejected'] as $val => $label)
                            <option value="{{ $val }}" {{ $application->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    {{-- Contextual status tips --}}
                    <p id="tipDocsRequired" class="mt-2 text-xs text-orange-600 hidden">
                        <svg class="inline w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Use this to ask the student for specific documents. The application stays active — specify which documents are needed below.
                    </p>
                    <p id="tipRejected" class="mt-2 text-xs text-red-500 hidden">
                        <svg class="inline w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                        <strong>This is final.</strong> Rejected applications cannot be edited or uploaded to. If you need more documents instead, use <em>Documents Required</em>.
                    </p>
                </div>

                {{-- Document request builder (shown only when status = documents_required) --}}
                <div id="docRequestsSection" class="mb-5 hidden">
                    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-sm font-semibold text-orange-800">Specify required documents</p>
                            <button type="button" id="addDocRequest"
                                class="text-xs bg-orange-100 hover:bg-orange-200 text-orange-800 font-semibold px-3 py-1.5 rounded-full transition">
                                + Add document
                            </button>
                        </div>
                        <div id="docRequestsList" class="space-y-3"></div>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Message to Student <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea name="admin_notes" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm resize-none"
                        placeholder="Add notes for the student e.g. what documents are missing, or approval details...">{{ $application->admin_notes }}</textarea>
                </div>

                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.applications.index') }}"
                       class="px-5 py-2.5 rounded-full border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="bg-teal text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-teal-light transition shadow-sm">
                        Update Status
                    </button>
                </div>
            </form>
        </div>

    </div>

    <script>
        const docTypes = [
            'Passport', 'Transcript', 'Diploma / Certificate', 'Recommendation Letter',
            'Personal Statement', 'Language Certificate', 'Payment Slip', 'Other'
        ];

        const statusSelect    = document.getElementById('statusSelect');
        const docSection      = document.getElementById('docRequestsSection');
        const addBtn          = document.getElementById('addDocRequest');
        const docRequestsList = document.getElementById('docRequestsList');
        let   rowIndex        = 0;

        const tipDocs     = document.getElementById('tipDocsRequired');
        const tipRejected = document.getElementById('tipRejected');

        function toggleSection() {
            const val = statusSelect.value;
            if (val === 'documents_required') {
                docSection.classList.remove('hidden');
                if (docRequestsList.children.length === 0) addRow();
            } else {
                docSection.classList.add('hidden');
            }
            tipDocs.classList.toggle('hidden',     val !== 'documents_required');
            tipRejected.classList.toggle('hidden', val !== 'rejected');
        }

        function addRow() {
            const i   = rowIndex++;
            const row = document.createElement('div');
            row.className = 'flex gap-2 items-start';
            row.innerHTML = `
                <select name="doc_requests[${i}][type]"
                    class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                    ${docTypes.map(t => `<option>${t}</option>`).join('')}
                </select>
                <input type="text" name="doc_requests[${i}][note]" placeholder="Note (optional)"
                    class="flex-1 px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                <button type="button" onclick="this.closest('.flex').remove()"
                    class="text-red-400 hover:text-red-600 px-2 py-2.5 rounded-xl border border-red-100 bg-red-50 text-sm font-bold leading-none transition">&times;</button>
            `;
            docRequestsList.appendChild(row);
        }

        statusSelect.addEventListener('change', toggleSection);
        addBtn.addEventListener('click', addRow);
        toggleSection();
    </script>

</x-admin.layouts.app>
