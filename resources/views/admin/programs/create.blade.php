<x-admin.layouts.app title="Add Program">

    <div class="mb-6">
        <a href="{{ route('admin.programs.index') }}" class="text-sm text-gray-400 hover:text-navy transition">← Back to Programs</a>
        <h2 class="text-xl font-bold text-navy mt-1">Add Program</h2>
    </div>

    <form method="POST" action="{{ route('admin.programs.store') }}" class="max-w-2xl"
          x-data="{ category: '{{ old('category', '') }}' }">
        @csrf
        <input type="hidden" name="category" :value="category">

        {{-- Step 1: Category Picker --}}
        <div x-show="category === ''" class="space-y-4">
            <p class="text-sm text-gray-500 mb-6">What type of program are you adding?</p>
            <div class="grid grid-cols-2 gap-5">
                <button type="button" @click="category = 'study'"
                    class="group flex flex-col items-center justify-center gap-4 bg-white border-2 border-teal/30 hover:border-teal rounded-2xl p-8 shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none">
                    <span class="text-5xl">📚</span>
                    <div class="text-center">
                        <div class="text-lg font-bold text-navy group-hover:text-teal transition">Study Program</div>
                        <div class="text-xs text-gray-400 mt-1">Degrees, diplomas, certificates</div>
                    </div>
                </button>
                <button type="button" @click="category = 'work'"
                    class="group flex flex-col items-center justify-center gap-4 bg-white border-2 border-indigo-200 hover:border-indigo-500 rounded-2xl p-8 shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none">
                    <span class="text-5xl">💼</span>
                    <div class="text-center">
                        <div class="text-lg font-bold text-navy group-hover:text-indigo-600 transition">Work Opportunity</div>
                        <div class="text-xs text-gray-400 mt-1">Jobs, internships, placements</div>
                    </div>
                </button>
            </div>
        </div>

        {{-- Step 2: Fields --}}
        <div x-show="category !== ''" class="space-y-6" x-cloak>

            {{-- Category badge --}}
            <div class="flex items-center justify-between bg-white rounded-2xl border border-gray-100 shadow-sm px-5 py-3">
                <div class="flex items-center gap-3">
                    <span x-text="category === 'study' ? '📚' : '💼'" class="text-2xl"></span>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wider font-semibold">Category</div>
                        <div class="font-bold text-navy" x-text="category === 'study' ? 'Study Program' : 'Work Opportunity'"></div>
                    </div>
                </div>
                <button type="button" @click="category = ''" class="text-xs text-gray-400 hover:text-navy underline focus:outline-none">Change</button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">

                {{-- STUDY: Institution --}}
                <div x-show="category === 'study'">
                    <label class="block text-sm font-semibold text-navy mb-1.5">Institution <span class="text-red-400">*</span></label>
                    <select name="institution_id" :required="category === 'study'"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                        <option value="">— Select Institution —</option>
                        @foreach($institutions as $inst)
                            <option value="{{ $inst->id }}" {{ old('institution_id') == $inst->id ? 'selected' : '' }}>
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
                            <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>
                                {{ $dest->flag_emoji ?? '' }} {{ $dest->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('destination_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Job/Program Name --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">
                        <span x-text="category === 'work' ? 'Job Title / Role' : 'Program Name'"></span>
                        <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        :placeholder="category === 'work' ? 'e.g. Software Engineer Intern' : 'e.g. BSc Computer Science'"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                    @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Level / Contract Type --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">
                        <span x-text="category === 'work' ? 'Contract Type' : 'Level'"></span>
                    </label>
                    <input type="text" name="level" value="{{ old('level') }}"
                        :placeholder="category === 'work' ? 'e.g. Full-Time, Part-Time, Internship' : 'e.g. Bachelor\'s, Master\'s, Certificate'"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                </div>

                {{-- Fees / Salary --}}
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">
                        <span x-text="category === 'work' ? 'Salary / Compensation' : 'Tuition Fees'"></span>
                    </label>
                    <input type="text" name="fees" value="{{ old('fees') }}"
                        :placeholder="category === 'work' ? 'e.g. $3,500/month or Employer Sponsored' : 'e.g. $10,000/year'"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                </div>

                {{-- WORK: Criteria / Requirements --}}
                <div x-show="category === 'work'" x-cloak>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Eligibility & Requirements</label>
                    <p class="text-xs text-gray-400 mb-2">One requirement per line — shown as a checklist on the site.</p>
                    <textarea name="criteria" rows="5"
                        placeholder="e.g.&#10;Valid passport&#10;Age 18–35&#10;No criminal record&#10;Basic English proficiency"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none resize-none font-mono">{{ old('criteria') }}</textarea>
                </div>

                {{-- Active --}}
                <div class="flex items-center gap-3 pt-1">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                        class="w-4 h-4 accent-teal rounded cursor-pointer">
                    <label for="is_active" class="text-sm font-semibold text-navy cursor-pointer">Show this publicly</label>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    :class="category === 'work' ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-teal hover:bg-teal-light'"
                    class="text-white text-sm font-semibold px-6 py-2.5 rounded-xl transition">
                    Save <span x-text="category === 'work' ? 'Work Opportunity' : 'Study Program'"></span>
                </button>
                <a href="{{ route('admin.programs.index') }}" class="text-sm text-gray-400 hover:text-navy px-4 py-2.5 transition">Cancel</a>
            </div>
        </div>

    </form>

</x-admin.layouts.app>


