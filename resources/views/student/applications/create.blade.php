<x-student.layouts.app title="New Application">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('student.applications.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-navy transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to applications
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-navy px-6 py-5">
                <h2 class="text-xl font-bold text-white">New Application</h2>
                <p class="text-gray-300 text-sm">Fill in the details below and upload your supporting documents.</p>
            </div>

            @if($errors->any())
                <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('student.applications.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                {{-- ── Step 1: Application Type ── --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Application Type <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label id="type-study-label"
                            class="flex items-center space-x-3 px-5 py-4 rounded-2xl border-2 cursor-pointer transition-all border-teal bg-teal/5">
                            <input type="radio" name="application_type" value="study" id="type-study" class="sr-only"
                                {{ old('application_type', 'study') !== 'work' ? 'checked' : '' }}>
                            <svg class="w-5 h-5 text-teal shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            <div>
                                <div class="font-bold text-navy text-sm">Study Abroad</div>
                                <div class="text-xs text-gray-400">Universities &amp; colleges</div>
                            </div>
                        </label>

                        <label id="type-work-label"
                            class="flex items-center space-x-3 px-5 py-4 rounded-2xl border-2 cursor-pointer transition-all border-gray-200 hover:border-indigo-300">
                            <input type="radio" name="application_type" value="work" id="type-work" class="sr-only"
                                {{ old('application_type') === 'work' ? 'checked' : '' }}>
                            <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <div class="font-bold text-navy text-sm">Work Abroad</div>
                                <div class="text-xs text-gray-400">Work permits &amp; visas</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- ── Step 2: Destination (filtered by type) ── --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Destination <span class="text-red-500">*</span>
                    </label>
                    <select name="destination_id" id="destination-select" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                        <option value="">— Select a destination —</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}"
                                data-category="{{ $dest->category }}"
                                data-description="{{ $dest->description }}"
                                data-required="{{ $dest->required_documents }}"
                                {{ old('destination_id') == $dest->id ? 'selected' : '' }}>
                                {{ $dest->flag_emoji }} {{ $dest->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('destination_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                    {{-- Destination info card — Study --}}
                    <div id="dest-info-study" class="hidden mt-4 rounded-2xl border border-teal/20 bg-teal/5 p-5">
                        <p id="dest-desc-study" class="text-sm text-gray-700 leading-relaxed"></p>
                        <div id="dest-req-wrap-study" class="hidden mt-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-4 h-4 text-teal shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="text-sm font-bold text-teal">Required Documents</span>
                            </div>
                            <ul id="dest-req-list-study" class="space-y-1.5"></ul>
                        </div>
                    </div>

                    {{-- Destination info card — Work --}}
                    <div id="dest-info-work" class="hidden mt-4 rounded-2xl border border-indigo-200 bg-indigo-50/50 p-5">
                        <p id="dest-desc-work" class="text-sm text-gray-700 leading-relaxed"></p>
                        <div id="dest-req-wrap-work" class="hidden mt-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-4 h-4 text-indigo-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <span class="text-sm font-bold text-indigo-600">Required Documents</span>
                            </div>
                            <ul id="dest-req-list-work" class="space-y-1.5"></ul>
                        </div>
                    </div>
                </div>

                {{-- Institution --}}
                <div id="institution-field">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Institution <span class="text-red-500">*</span></label>
                    <select name="institution_id" id="institution-select" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                        <option value="">— Select destination first —</option>
                        @foreach($institutions as $inst)
                            <option value="{{ $inst->id }}"
                                data-destination="{{ $inst->destination_id }}"
                                {{ old('institution_id') == $inst->id ? 'selected' : '' }}>
                                {{ $inst->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('institution_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Program --}}
                <div id="program-field">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Program / Course <span class="text-red-500">*</span></label>
                    {{-- Dynamic select (populated by JS when institution chosen) --}}
                    <select id="program-select"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm mb-2">
                        <option value="">— Select institution first —</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->name }}"
                                data-institution="{{ $prog->institution_id }}"
                                data-name="{{ $prog->name }}">
                                {{ $prog->name }}{{ $prog->level ? ' ('.$prog->level.')' : '' }}
                            </option>
                        @endforeach
                        <option value="__other__">✏ Enter manually…</option>
                    </select>
                    {{-- Free text fallback --}}
                    <input name="program" id="program-input" type="text" value="{{ old('program') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm hidden"
                        placeholder="Type program name…">
                    @error('program') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Notes --}}
                <div>
                    <label id="notes-label" class="block text-sm font-semibold text-gray-700 mb-1.5">Additional Notes</label>
                    <textarea name="notes" id="notes-input" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm resize-none"
                        placeholder="Any additional information or specific requests...">{{ old('notes') }}</textarea>
                </div>

                {{-- Documents --}}
                <div class="border border-dashed border-gray-200 rounded-2xl p-5 bg-gray-50">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-teal/10 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-navy text-sm">Upload Documents</h4>
                            <p class="text-gray-400 text-xs">PDF, JPG, PNG, DOC/DOCX · max 5 MB each</p>
                        </div>
                    </div>

                    <div id="doc-uploads" class="space-y-3">
                        <div class="doc-row flex flex-col sm:flex-row gap-2">
                            <select name="doc_types[]"
                                class="w-full sm:w-52 px-3 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                                <option value="">Document type</option>
                                <option>Passport</option>
                                <option>CV</option>
                                <option>Transcript</option>
                                <option>Diploma / Certificate</option>
                                <option>Recommendation Letter</option>
                                <option>Personal Statement</option>
                                <option>Language Certificate</option>
                                <option>Payment Slip</option>
                                <option>Bank Statement</option>
                                <option>Medical Certificate</option>
                                <option>Work Experience Letter</option>
                                <option>Other</option>
                            </select>
                            <input type="file" name="documents[]" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                class="flex-1 px-3 py-2 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                        </div>
                    </div>

                    <button type="button" onclick="addDocRow()"
                        class="mt-3 text-teal text-sm font-semibold hover:underline flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add another document
                    </button>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-2">
                    <a href="{{ route('student.applications.index') }}"
                       class="px-5 py-2.5 rounded-full border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">Submit Application</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const typeStudy        = document.getElementById('type-study');
        const typeWork         = document.getElementById('type-work');
        const labelStudy       = document.getElementById('type-study-label');
        const labelWork        = document.getElementById('type-work-label');
        const destSelect       = document.getElementById('destination-select');
        const institutionField = document.getElementById('institution-field');
        const institutionSel   = document.getElementById('institution-select');
        const programField     = document.getElementById('program-field');
        const programSel       = document.getElementById('program-select');
        const programInput     = document.getElementById('program-input');
        const notesLabel       = document.getElementById('notes-label');
        const notesInput       = document.getElementById('notes-input');

        // ── Type toggle ──────────────────────────────────────────────────────
        function applyTypeStyles() {
            const isWork = typeWork.checked;
            if (!isWork) {
                labelStudy.classList.add('border-teal', 'bg-teal/5');
                labelStudy.classList.remove('border-gray-200');
                labelWork.classList.remove('border-indigo-500', 'bg-indigo-50/50');
                labelWork.classList.add('border-gray-200');
            } else {
                labelWork.classList.add('border-indigo-500', 'bg-indigo-50/50');
                labelWork.classList.remove('border-gray-200');
                labelStudy.classList.remove('border-teal', 'bg-teal/5');
                labelStudy.classList.add('border-gray-200');
            }
            if (isWork) {
                institutionField.classList.add('hidden');
                institutionSel.removeAttribute('required');
                programField.classList.add('hidden');
                programSel.removeAttribute('required');
                programInput.removeAttribute('required');
                notesLabel.textContent = 'Work Criteria';
                notesInput.placeholder = 'Describe the type of work you are seeking, skills, experience, preferences...';
            } else {
                institutionField.classList.remove('hidden');
                institutionSel.setAttribute('required', 'required');
                programField.classList.remove('hidden');
                programSel.setAttribute('required', 'required');
                notesLabel.textContent = 'Additional Notes';
                notesInput.placeholder = 'Any additional information or specific requests...';
            }
            filterDestinations();
        }

        // ── Destination filtering ─────────────────────────────────────────────
        function filterDestinations() {
            const type    = typeStudy.checked ? 'study' : 'work';
            const current = destSelect.value;
            let found     = false;
            Array.from(destSelect.options).forEach(opt => {
                if (!opt.value) return;
                const show   = opt.dataset.category === type;
                opt.hidden   = !show;
                opt.disabled = !show;
                if (opt.value === current && show) found = true;
            });
            if (!found) destSelect.value = '';
            updateDestInfo();
            filterInstitutions();
        }

        // ── Institution filtering by destination ──────────────────────────────
        function filterInstitutions() {
            const destId  = destSelect.value;
            const current = institutionSel.value;
            let   found   = false;
            Array.from(institutionSel.options).forEach(opt => {
                if (!opt.value) return;
                const show   = !destId || opt.dataset.destination === destId;
                opt.hidden   = !show;
                opt.disabled = !show;
                if (opt.value === current && show) found = true;
            });
            if (!found) {
                institutionSel.value = '';
                institutionSel.options[0].text = destId ? '— Select institution —' : '— Select destination first —';
            }
            filterPrograms();
        }

        // ── Program filtering by institution ──────────────────────────────────
        function filterPrograms() {
            const instId  = institutionSel.value;
            let   hasOpts = false;
            Array.from(programSel.options).forEach(opt => {
                if (!opt.value || opt.value === '__other__') return;
                const show   = !instId || opt.dataset.institution === instId;
                opt.hidden   = !show;
                opt.disabled = !show;
                if (show) hasOpts = true;
            });
            // Reset select value if current is hidden
            const current = programSel.options[programSel.selectedIndex];
            if (current && current.hidden) programSel.value = '';
            // Adjust placeholder
            programSel.options[0].text = instId
                ? (hasOpts ? '— Select program —' : '— No programs found, enter manually —')
                : '— Select institution first —';
            handleProgramSelect();
        }

        // ── Program select / manual toggle ────────────────────────────────────
        function handleProgramSelect() {
            if (programSel.value === '__other__' || programSel.value === '') {
                programSel.removeAttribute('name');
                programInput.classList.remove('hidden');
                programInput.setAttribute('name', 'program');
                if (programSel.value !== '__other__') programInput.value = '';
            } else {
                programSel.setAttribute('name', 'program');
                programInput.removeAttribute('name');
                programInput.classList.add('hidden');
                programInput.value = programSel.value;
            }
        }

        // ── Destination info card ─────────────────────────────────────────────
        function buildDocList(text, listId, color) {
            const list = document.getElementById(listId);
            list.innerHTML = '';
            text.split('\n').map(s => s.trim()).filter(Boolean).forEach(item => {
                const li = document.createElement('li');
                li.className = 'flex items-start space-x-2 text-sm';
                li.innerHTML = `<svg class="w-4 h-4 mt-0.5 shrink-0 text-${color}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-gray-700">${item}</span>`;
                list.appendChild(li);
            });
        }

        function updateDestInfo() {
            const opt    = destSelect.options[destSelect.selectedIndex];
            const isWork = typeWork.checked;
            document.getElementById('dest-info-study').classList.add('hidden');
            document.getElementById('dest-info-work').classList.add('hidden');
            if (!opt || !opt.value) return;
            const desc     = opt.dataset.description || '';
            const required = opt.dataset.required    || '';
            if (isWork) {
                document.getElementById('dest-info-work').classList.remove('hidden');
                document.getElementById('dest-desc-work').textContent = desc;
                if (required) {
                    buildDocList(required, 'dest-req-list-work', 'indigo-500');
                    document.getElementById('dest-req-wrap-work').classList.remove('hidden');
                } else {
                    document.getElementById('dest-req-wrap-work').classList.add('hidden');
                }
            } else {
                document.getElementById('dest-info-study').classList.remove('hidden');
                document.getElementById('dest-desc-study').textContent = desc;
                if (required) {
                    buildDocList(required, 'dest-req-list-study', 'teal');
                    document.getElementById('dest-req-wrap-study').classList.remove('hidden');
                } else {
                    document.getElementById('dest-req-wrap-study').classList.add('hidden');
                }
            }
        }

        // ── Event listeners ───────────────────────────────────────────────────
        typeStudy.addEventListener('change',    applyTypeStyles);
        typeWork.addEventListener('change',     applyTypeStyles);
        destSelect.addEventListener('change',   () => { updateDestInfo(); filterInstitutions(); });
        institutionSel.addEventListener('change', filterPrograms);
        programSel.addEventListener('change',   handleProgramSelect);

        // Init
        applyTypeStyles();
        if (destSelect.value) { updateDestInfo(); filterInstitutions(); }

        function addDocRow() {
            const container = document.getElementById('doc-uploads');
            const row = container.querySelector('.doc-row').cloneNode(true);
            row.querySelector('select').value = '';
            row.querySelector('input[type="file"]').value = '';
            container.appendChild(row);
        }
    </script>

</x-student.layouts.app>
