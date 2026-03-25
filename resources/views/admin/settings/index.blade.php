<x-admin.layouts.app title="Settings">

    <div class="max-w-3xl mx-auto">

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-navy">Website Settings</h2>
            <p class="text-gray-400 text-sm mt-1">Manage your site identity, contact info, SMTP and more.</p>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                @foreach($errors->all() as $error)<p>• {{ $error }}</p>@endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- ═══ Site Identity ═══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center space-x-3">
                    <div class="w-8 h-8 bg-navy/10 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-navy">Site Identity</h3>
                </div>
                <div class="p-6 space-y-5">
                    {{-- Logo --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Logo</label>
                        @php $logoPath = \App\Models\Setting::get('logo_path'); @endphp
                        @if($logoPath)
                            <div class="mb-3">
                                <img src="{{ Storage::url($logoPath) }}" alt="Logo" class="h-14 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                                <p class="text-xs text-gray-400 mt-1">Current logo — upload a new file to replace it</p>
                            </div>
                        @endif
                        <input type="file" name="logo" accept=".png,.jpg,.jpeg,.svg,.webp"
                            class="text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal/10 file:text-teal hover:file:bg-teal/20 cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1">PNG, JPG, SVG, WEBP · max 2 MB</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Site Name</label>
                            <input type="text" name="site_name" value="{{ \App\Models\Setting::get('site_name', 'WeducaApply') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="WeducaApply">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Contact Email</label>
                            <input type="email" name="contact_email" value="{{ \App\Models\Setting::get('contact_email') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="info@weducaapply.com">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone / WhatsApp Number</label>
                            <input type="text" name="contact_phone" value="{{ \App\Models\Setting::get('contact_phone') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="+1 234 567 8900">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">WhatsApp Business Number</label>
                            <input type="text" name="whatsapp_number" value="{{ \App\Models\Setting::get('whatsapp_number') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="+1234567890 (with country code)">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Office Address</label>
                        <textarea name="contact_address" rows="2"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm resize-none"
                            placeholder="123 Main Street, City, Country">{{ \App\Models\Setting::get('contact_address') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ═══ Social Media ═══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-navy">Social Media Links</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Facebook Page URL</label>
                        <input type="url" name="facebook_url" value="{{ \App\Models\Setting::get('facebook_url') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                            placeholder="https://facebook.com/yourpage">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram Profile URL</label>
                        <input type="url" name="instagram_url" value="{{ \App\Models\Setting::get('instagram_url') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                            placeholder="https://instagram.com/yourprofile">
                    </div>
                </div>
            </div>

            {{-- ═══ SMTP / Mail Settings ═══ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center space-x-3">
                    <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-navy">Email / SMTP Settings</h3>
                        <p class="text-gray-400 text-xs">These are used to send status update emails to applicants.</p>
                    </div>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">From Name</label>
                            <input type="text" name="mail_from_name" value="{{ \App\Models\Setting::get('mail_from_name', 'WeducaApply') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="WeducaApply">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">From Email Address</label>
                            <input type="email" name="mail_from_address" value="{{ \App\Models\Setting::get('mail_from_address') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="noreply@weducaapply.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">SMTP Host</label>
                            <input type="text" name="smtp_host" value="{{ \App\Models\Setting::get('smtp_host') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="smtp.gmail.com">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">SMTP Port</label>
                            <input type="number" name="smtp_port" value="{{ \App\Models\Setting::get('smtp_port', 587) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="587">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Encryption</label>
                            <select name="smtp_encryption"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal text-sm">
                                <option value="tls" {{ \App\Models\Setting::get('smtp_encryption', 'tls') === 'tls' ? 'selected' : '' }}>TLS (recommended)</option>
                                <option value="ssl" {{ \App\Models\Setting::get('smtp_encryption') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value=""   {{ \App\Models\Setting::get('smtp_encryption') === ''    ? 'selected' : '' }}>None</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">SMTP Username</label>
                            <input type="text" name="smtp_username" value="{{ \App\Models\Setting::get('smtp_username') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="your@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">SMTP Password / App Password</label>
                            <input type="password" name="smtp_password" value="{{ \App\Models\Setting::get('smtp_password') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal text-sm"
                                placeholder="Leave blank to keep current">
                        </div>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl px-4 py-3 text-xs text-blue-700">
                        <strong>Tip:</strong> For Gmail, create an <em>App Password</em> at myaccount.google.com &rarr; Security &rarr; 2-Step Verification &rarr; App Passwords.
                        Use port <strong>587</strong> with <strong>TLS</strong>, or port <strong>465</strong> with <strong>SSL</strong>.
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-teal text-white font-semibold px-8 py-3 rounded-full hover:bg-teal-light transition shadow-sm text-sm">
                    Save Settings
                </button>
            </div>
        </form>
    </div>

</x-admin.layouts.app>
