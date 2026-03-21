<x-layout>
    <div class="bg-navy py-12 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Contact Us</h1>
        <p class="text-teal-light text-lg">We're here to answer all your questions.</p>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16">

                <!-- Contact Info -->
                <div class="lg:w-1/3">
                    <h2 class="text-3xl font-bold text-navy mb-8">Get in Touch</h2>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-10 h-10 bg-teal/10 text-teal rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-navy">Our Offices</h4>
                                <p class="text-gray-600 mt-1">Rubirizi, KK 225 Street<br>Kigali, Rwanda</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-10 h-10 bg-teal/10 text-teal rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-navy">Phone Support</h4>
                                <p class="text-gray-600 mt-1">+250 789 000 213<br>Mon-Fri, 9am - 5pm</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-10 h-10 bg-teal/10 text-teal rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-navy">Email Address</h4>
                                <p class="text-gray-600 mt-1">admissions.weducaapply@gmail.com<br>weducaapplyltd@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:w-2/3">
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100">
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                                role="alert">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Your
                                        Name</label>
                                    <input
                                        class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent"
                                        id="name" name="name" type="text" required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Your
                                        Email</label>
                                    <input
                                        class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent"
                                        id="email" name="email" type="email" required>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone Number
                                    (Optional)</label>
                                <input
                                    class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent"
                                    id="phone" name="phone" type="tel">
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Message</label>
                                <textarea
                                    class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent"
                                    id="message" name="message" rows="5" required></textarea>
                            </div>

                            <button class="btn-primary" type="submit">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>