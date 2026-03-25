<x-admin.layouts.app title="Edit Program">

    <div class="mb-6">
        <a href="{{ route('admin.programs.index') }}" class="text-sm text-gray-400 hover:text-navy transition">← Back to Programs</a>
        <h2 class="text-xl font-bold text-navy mt-1">Edit Program</h2>
    </div>

    <form method="POST" action="{{ route('admin.programs.update', $program) }}" class="max-w-2xl space-y-6">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-5">

            {{-- Institution --}}
            <div>
                <label class="block text-sm font-semibold text-navy mb-1.5">Institution <span class="text-red-400">*</span></label>
                <select name="institution_id" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                    <option value="">— Select Institution —</option>
                    @foreach($institutions as $inst)
                        <option value="{{ $inst->id }}" {{ old('institution_id', $program->institution_id) == $inst->id ? 'selected' : '' }}>
                            {{ $inst->name }}{{ $inst->destination ? ' — '.$inst->destination->name : '' }}
                        </option>
                    @endforeach
                </select>
                @error('institution_id')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Name --}}
            <div>
                <label class="block text-sm font-semibold text-navy mb-1.5">Program Name <span class="text-red-400">*</span></label>
                <input type="text" name="name" value="{{ old('name', $program->name) }}" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold text-navy mb-1.5">Description</label>
                <textarea name="description" rows="3"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none resize-none">{{ old('description', $program->description) }}</textarea>
            </div>

            {{-- Level + Category --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Level</label>
                    <input type="text" name="level" value="{{ old('level', $program->level) }}" placeholder="e.g. Bachelor's, Master's"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Category <span class="text-red-400">*</span></label>
                    <select name="category" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                        <option value="study" {{ old('category', $program->category) === 'study' ? 'selected' : '' }}>Study</option>
                        <option value="work" {{ old('category', $program->category) === 'work' ? 'selected' : '' }}>Work</option>
                    </select>
                </div>
            </div>

            {{-- Duration + Fees --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $program->duration) }}" placeholder="e.g. 4 years"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-navy mb-1.5">Fees</label>
                    <input type="text" name="fees" value="{{ old('fees', $program->fees) }}" placeholder="e.g. $10,000/year"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-teal/50 focus:border-teal outline-none">
                </div>
            </div>

            {{-- Active --}}
            <div class="flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $program->is_active ? '1' : '0') == '1' ? 'checked' : '' }}
                    class="w-4 h-4 accent-teal rounded cursor-pointer">
                <label for="is_active" class="text-sm font-semibold text-navy cursor-pointer">Show this program publicly</label>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-teal text-white text-sm font-semibold px-6 py-2.5 rounded-xl hover:bg-teal-light transition">Update Program</button>
            <a href="{{ route('admin.programs.index') }}" class="text-sm text-gray-400 hover:text-navy px-4 py-2.5 transition">Cancel</a>
        </div>

    </form>

</x-admin.layouts.app>
