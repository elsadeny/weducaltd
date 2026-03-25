<x-admin.layouts.app title="Edit Program">

    <div class="mb-6">
        <a href="{{ route('admin.programs.index') }}" class="text-sm text-gray-400 hover:text-navy transition">← Back to Programs</a>
        <h2 class="text-xl font-bold text-navy mt-1">Edit Program</h2>
    </div>

    <form method="POST" action="{{ route('admin.programs.update', $program) }}" class="max-w-2xl space-y-6"
          x-data="{ category: '{{ old('category', $program->category) }}' }">
        @csrf @method('PUT')
        <input type="hidden" name="category" :value="category">

        {{-- Category toggle --}}
        <div class="flex items-center gap-3">
            <span class="text-sm font-semibold text-navy">Type:</span>
            <button type="button" @click="category = 'study'"
                :class="category === 'study' ? 'bg-teal text-white border-teal' : 'bg-white text-teal border-teal/40 hover:border-teal'"
                class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-bold transition focus:outline-none">
                📚 Study
            </button>
            <button type="button" @click="category = 'work'"
                :class="category === 'work' ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-indigo-600 border-indigo-300 hover:border-indigo-500'"
                class="flex items-center gap-2 px-4 py-2 rounded-full border text-sm font-bold transition focus:outline-none">
                💼 Work
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">

            {{-- STUDY: Institution --}}
            <div x-show="category === 'study'">
                <label class="block text-sm font-semibold text-navy mb-1.5">Institution <span class="text-red-400">*</span></label>
                <select name="institution_id" :required="category === 'study'"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                    <option value="">— Select Institution —</option>
                    @foreach($institutions as $inst)
                        <option value="{{ $inst->id }}" {{ old('institution_id', $program->institution_id) == $inst->id ? 'selected' : '' }}>
                            {{ $inst->name }}{{ $inst->destination ? ' — '.$inst->destination->name : '' }}
                        </option>
                    @endforeach
                </select>
                @error('institution_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- WORK: Destination (Country) --}}
            <div x-show="category === 'work'" x-cloak>
                <label class="block text-sm font-semibold text-navy mb-1.5">Target Country <span class="text-red-400">*</span></label>
                <select name="destination_id" :required="category === 'work'"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none">
                    <option value="">— Select Country —</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id', $program->destination_id) == $dest->id ? 'selected' : '' }}>
                            {{ $dest->flag_emoji ?? '' }} {{ $dest->name }}
                        </option>
                    @endforeach
                </select>
                @error('destination_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Name / Title --}}
            <div>
                <label class="block text-sm font-semibold text-navy mb-1.5">
                    <span x-text="category === 'work' ? 'Job Title / Role' : 'Program Name'"></span>
                    <span class="text-red-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $program->name) }}" required
                    :placeholder="category === 'work' ? 'e.g. Software Engineer Intern' : 'e.g. BSc Computer Science'"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Level / Contract Type --}}
            <div>
                <label class="block text-sm font-semibold text-navy mb-1.5">
                    <span x-text="category === 'work' ? 'Contract Type' : 'Level'"></span>
                </label>
                <input type="text" name="level" value="{{ old('level', $program->level) }}"
                    :placeholder="category === 'work' ? 'e.g. Full-Time, Part-Time, Internship' : 'e.g. Bachelor\'s, Master\'s, Certificate'"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
            </div>

            {{-- Fees / Salary --}}
            <div>
                <label class="block text-sm font-semibold text-navy mb-1.5">
                    <span x-text="category === 'work' ? 'Salary / Compensation' : 'Tuition Fees'"></span>
                </label>
                <input type="text" name="fees" value="{{ old('fees', $program->fees) }}"
                    :placeholder="category === 'work' ? 'e.g. $3,500/month or Employer Sponsored' : 'e.g. $10,000/year'"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
            </div>

            {{-- WORK: Criteria / Requirements --}}
            <div x-show="category === 'work'" x-cloak>
                <label class="block text-sm font-semibold text-navy mb-1.5">Eligibility & Requirements</label>
                <p class="text-xs text-gray-400 mb-2">One requirement per line — shown as a checklist on the site.</p>
                <textarea name="criteria" rows="5"
                    placeholder="e.g.&#10;Valid passport&#10;Age 18–35&#10;No criminal record&#10;Basic English proficiency"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none resize-none font-mono">{{ old('criteria', $program->criteria) }}</textarea>
            </div>

            {{-- Active --}}
            <div class="flex items-center gap-3 pt-1">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $program->is_active ? '1' : '0') == '1' ? 'checked' : '' }}
                    class="w-4 h-4 accent-teal rounded cursor-pointer">
                <label for="is_active" class="text-sm font-semibold text-navy cursor-pointer">Show this publicly</label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                :class="category === 'work' ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-teal hover:bg-teal-light'"
                class="text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                Update <span x-text="category === 'work' ? 'Work Opportunity' : 'Study Program'"></span>
            </button>
            <a href="{{ route('admin.programs.index') }}" class="text-sm text-gray-400 hover:text-navy px-4 py-2.5 transition">Cancel</a>
        </div>

    </form>

</x-admin.layouts.app>


