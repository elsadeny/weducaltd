<x-layout>
    <x-slot name="title">Privacy Policy</x-slot>

    <!-- Hero Banner -->
    <section class="bg-navy text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover">
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="text-teal font-bold tracking-wider uppercase text-sm mb-4 block">Legal</span>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Privacy Policy</h1>
            <div class="w-24 h-1.5 bg-teal mx-auto mt-6 rounded-full"></div>
            <p class="text-gray-300 mt-6 text-lg">Last updated: {{ date('F d, Y') }}</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">

                <!-- Intro -->
                <div class="bg-teal/5 border border-teal/20 rounded-2xl p-6 mb-10">
                    <p class="text-gray-700 leading-relaxed text-lg m-0">
                        At <strong class="text-navy">WeducaApply Ltd</strong>, we are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services.
                    </p>
                </div>

                @php
                $sections = [
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                        'title' => '1. Information We Collect',
                        'content' => '<p>We collect information you provide directly to us when you:</p><ul><li>Register for an account or fill in our application form</li><li>Contact us via email, phone, or the contact form</li><li>Subscribe to our newsletter or communications</li></ul><p>This may include your <strong>name, email address, phone number, nationality, and academic interests</strong>.</p><p>We also collect certain information automatically when you visit our website, including your IP address, browser type, operating system, referring URLs, and pages viewed.</p>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>',
                        'title' => '2. How We Use Your Information',
                        'content' => '<p>We use the information we collect to:</p><ul><li>Process your application and provide our consultancy services</li><li>Contact you regarding your inquiry or registration</li><li>Send administrative information such as updates to our terms</li><li>Respond to comments and questions and provide customer support</li><li>Improve our website and services</li><li>Comply with legal obligations</li></ul>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>',
                        'title' => '3. Sharing Your Information',
                        'content' => '<p>We do <strong>not sell, trade, or rent</strong> your personal information to third parties. We may share your information only in the following circumstances:</p><ul><li><strong>Partner Institutions:</strong> With universities and colleges relevant to your application, with your consent.</li><li><strong>Service Providers:</strong> With trusted vendors who assist us in operating our website and conducting our business (e.g., email providers), subject to confidentiality agreements.</li><li><strong>Legal Compliance:</strong> When required by law or to protect the rights, property, or safety of WeducaApply, our clients, or others.</li></ul>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>',
                        'title' => '4. Data Security',
                        'content' => '<p>We implement appropriate technical and organisational security measures designed to protect your personal information against accidental or unlawful destruction, loss, alteration, unauthorised disclosure or access.</p><p>However, please note that no method of transmission over the Internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your personal information, we cannot guarantee its absolute security.</p>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                        'title' => '5. Data Retention',
                        'content' => '<p>We retain your personal data only for as long as necessary to fulfil the purposes for which it was collected, including for the purposes of satisfying any legal, accounting, or reporting requirements.</p><p>In general, application and inquiry data is retained for up to <strong>3 years</strong> from the date of last contact, unless you request earlier deletion.</p>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                        'title' => '6. Your Rights',
                        'content' => '<p>Depending on your location, you may have the following rights regarding your personal data:</p><ul><li><strong>Access</strong> — You have the right to request a copy of the information we hold about you.</li><li><strong>Correction</strong> — You have the right to correct inaccurate or incomplete data.</li><li><strong>Deletion</strong> — You may request that we delete your personal data.</li><li><strong>Objection</strong> — You may object to the processing of your personal data for certain purposes.</li><li><strong>Portability</strong> — You may request a copy of your data in a structured, machine-readable format.</li></ul><p>To exercise any of these rights, please contact us at <a href="mailto:info@weducaapplyltd.com" class="text-teal font-semibold hover:text-navy">info@weducaapplyltd.com</a>.</p>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>',
                        'title' => '7. Cookies',
                        'content' => '<p>Our website uses cookies — small text files placed on your device — to enhance your browsing experience. Cookies help us understand how visitors interact with our website.</p><p>You can set your browser to refuse all or some browser cookies, or to alert you when websites set or access cookies. If you disable or refuse cookies, please note that some parts of our website may become inaccessible or not function properly.</p>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>',
                        'title' => '8. Third-Party Links',
                        'content' => '<p>Our website may contain links to third-party websites, including university portals and partner organisation sites. We have no control over the content and practices of those sites and cannot accept responsibility or liability for their respective privacy policies.</p>'
                    ],
                    [
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
                        'title' => '9. Changes to This Policy',
                        'content' => '<p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page with the updated date at the top.</p><p>We encourage you to review this Privacy Policy periodically for any changes. Changes are effective when they are posted on this page.</p>'
                    ],
                ];
                @endphp

                @foreach($sections as $index => $section)
                <div class="mb-10 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-8 animate-on-scroll" style="transition-delay: {{ $index * 50 }}ms">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-teal/10 text-teal rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $section['icon'] !!}</svg>
                        </div>
                        <h2 class="text-2xl font-bold text-navy mt-2">{{ $section['title'] }}</h2>
                    </div>
                    <div class="text-gray-600 leading-relaxed space-y-3 ml-16 [&_ul]:list-disc [&_ul]:ml-6 [&_ul]:space-y-2 [&_strong]:text-navy [&_a]:text-teal">
                        {!! $section['content'] !!}
                    </div>
                </div>
                @endforeach

                <!-- Contact box -->
                <div class="mt-12 bg-navy rounded-3xl p-10 text-center text-white animate-on-scroll">
                    <h3 class="text-2xl font-bold mb-3">Questions About This Policy?</h3>
                    <p class="text-gray-300 mb-6">If you have any questions or concerns about our Privacy Policy, please reach out to us.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="mailto:info@weducaapplyltd.com" class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email Us
                        </a>
                        <a href="{{ route('home') }}#contact" class="btn-outline border-white text-white hover:bg-white hover:text-navy">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Contact Us
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
