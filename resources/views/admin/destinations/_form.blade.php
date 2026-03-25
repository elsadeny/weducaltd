{{-- Shared form for create/edit --}}

@if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
        @foreach($errors->all() as $error)
            <p>• {{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="bg-navy px-6 py-5">
        <h2 class="text-xl font-bold text-white">{{ isset($destination) ? 'Edit Destination' : 'New Destination' }}</h2>
        <p class="text-gray-300 text-sm">Fill in the details below. The image will be shown on the website.</p>
    </div>

    <div class="p-6 space-y-6">

        {{-- Name & Category --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Country / Destination Name <span class="text-red-500">*</span>
                </label>
                <input name="name" type="text" value="{{ old('name', $destination->name ?? '') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                    placeholder="e.g. United Kingdom">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Category <span class="text-red-500">*</span>
                </label>
                <select name="category" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                    <option value="study" {{ old('category', $destination->category ?? '') === 'study' ? 'selected' : '' }}>Study Destination</option>
                    <option value="work"  {{ old('category', $destination->category ?? '') === 'work'  ? 'selected' : '' }}>Work Destination</option>
                </select>
            </div>
        </div>

        {{-- Flag emoji --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Flag Emoji</label>
            <input name="flag_emoji" type="text" value="{{ old('flag_emoji', $destination->flag_emoji ?? '') }}"
                class="w-40 px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-2xl text-center"
                placeholder="🇬🇧" maxlength="10">
            <p class="text-gray-400 text-xs mt-1">Paste the flag emoji for the country (e.g. 🇬🇧 🇺🇸 🇨🇦)</p>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
            <textarea name="description" rows="4"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm resize-none"
                placeholder="Describe what makes this destination great for students or workers...">{{ old('description', $destination->description ?? '') }}</textarea>
        </div>

        {{-- Required Documents --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                Required Documents
                <span class="text-gray-400 font-normal text-xs ml-1">(shown to applicants when they select this destination)</span>
            </label>
            <textarea name="required_documents" rows="5"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                placeholder="List the documents required for this destination. E.g.:&#10;• Valid Passport (min. 6 months validity)&#10;• Recent bank statement&#10;• Language certificate (IELTS/TOEFL)&#10;• Medical certificate&#10;• Passport-size photos">{{ old('required_documents', $destination->required_documents ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">This information will be displayed on the application form when a student selects this destination.</p>
        </div>

        {{-- Image upload --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Cover Image</label>

            @if(isset($destination) && $destination->image)
                <div class="mb-3">
                    <img src="{{ Str::startsWith($destination->image, 'http') ? $destination->image : Storage::url($destination->image) }}"
                         alt="{{ $destination->name }}"
                         class="h-40 w-full object-cover rounded-xl border border-gray-200">
                    <p class="text-gray-400 text-xs mt-1">Current image — upload a new one to replace it</p>
                </div>
            @endif

            <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-teal transition-colors"
                 id="drop-zone">
                <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm text-gray-400 mb-2">Click to upload or drag & drop</p>
                <p class="text-xs text-gray-300">JPG, PNG, WEBP · max 3 MB</p>
                <input type="file" name="image" id="image-input" accept=".jpg,.jpeg,.png,.webp"
                    class="mt-3 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal/10 file:text-teal hover:file:bg-teal/20 cursor-pointer">
            </div>

            {{-- Preview --}}
            <div id="image-preview" class="hidden mt-3">
                <img id="preview-img" src="" alt="Preview" class="h-40 w-full object-cover rounded-xl border border-gray-200">
                <p class="text-xs text-gray-400 mt-1">New image preview</p>
            </div>
        </div>

    </div>

    <div class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-100 bg-gray-50/50">
        <a href="{{ route('admin.destinations.index') }}"
           class="px-5 py-2.5 rounded-full border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
            Cancel
        </a>
        <button type="submit" class="bg-teal text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-teal-light transition shadow-sm">
            {{ isset($destination) ? 'Save Changes' : 'Create Destination' }}
        </button>
    </div>
</div>

<script>
    document.getElementById('image-input').addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('preview-img').src = ev.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
