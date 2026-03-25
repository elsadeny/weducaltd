<x-admin.layouts.app title="Edit Institution">

    <div class="mb-6">
        <a href="{{ route('admin.institutions.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-navy transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to institutions
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-navy mb-6">Edit Institution</h2>

            @if($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    @foreach($errors->all() as $e) <p>• {{ $e }}</p> @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.institutions.update', $institution) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Institution Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $institution->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Destination (Country)</label>
                    <select name="destination_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                        <option value="">— Not linked to a destination —</option>
                        @foreach($destinations as $d)
                            <option value="{{ $d->id }}" {{ old('destination_id', $institution->destination_id) == $d->id ? 'selected' : '' }}>
                                {{ $d->flag_emoji }} {{ $d->name }} ({{ ucfirst($d->category) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Country / City</label>
                    <input type="text" name="country" value="{{ old('country', $institution->country) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Website</label>
                    <input type="url" name="website" value="{{ old('website', $institution->website) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Logo</label>
                    @if($institution->logo)
                        <div class="mb-2 flex items-center space-x-3">
                            <img src="{{ Storage::url($institution->logo) }}" class="h-14 w-auto rounded-lg object-contain border border-gray-100 bg-gray-50 p-1">
                            <span class="text-xs text-gray-400">Current logo</span>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*"
                        class="w-full px-3 py-2 rounded-xl border border-gray-200 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                </div>

                <div class="flex items-center space-x-3">
                    <input type="hidden" name="accreditation" value="0">
                    <input type="checkbox" name="accreditation" id="accreditation" value="1"
                        {{ old('accreditation', $institution->accreditation) ? 'checked' : '' }}
                        class="w-4 h-4 rounded text-teal focus:ring-teal">
                    <label for="accreditation" class="text-sm font-semibold text-gray-700">Accredited institution</label>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-2">
                    <a href="{{ route('admin.institutions.index') }}" class="px-5 py-2.5 rounded-full border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">Cancel</a>
                    <button type="submit" class="bg-teal text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-teal-light transition">Update Institution</button>
                </div>
            </form>
        </div>
    </div>

</x-admin.layouts.app>
