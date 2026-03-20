<x-layout>
    <div class="bg-navy py-12 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Apply Now</h1>
        <p class="text-teal-light text-lg">Start your application to your dream university.</p>
    </div>

    <section class="py-16 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold">Application Received!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                <!-- For now we'll capture inquiry but styled as an application form -->
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    
                    <div class="mb-8 border-b pb-4">
                        <h3 class="text-xl font-bold text-navy">Personal Details</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent" id="name" name="name" type="text" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent" id="email" name="email" type="email" placeholder="john@example.com" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent" id="phone" name="phone" type="tel" placeholder="+1234567890" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nationality">
                                Nationality 
                            </label>
                            <input class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent" id="nationality" type="text" placeholder="e.g. Rwandan">
                        </div>
                    </div>

                    <div class="mb-8 border-b pb-4">
                        <h3 class="text-xl font-bold text-navy">Academic Interests</h3>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                            Desired Program / Destination / Notes <span class="text-red-500">*</span>
                        </label>
                        <p class="text-xs text-gray-500 mb-2">Tell us which country and course you are interested in applying for.</p>
                        <textarea class="shadow-sm appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent" id="message" name="message" rows="5" placeholder="I am interested in pursuing a Master's in Computer Science in Canada..." required></textarea>
                    </div>

                    <div class="flex items-center justify-center mt-8">
                        <button class="btn-primary w-full justify-center" type="submit">
                            Submit Application request
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="text-center text-gray-500 mt-8 text-sm">
                By submitting this form, you agree to our privacy policy. One of our advisors will contact you within 24 hours to proceed with the official documentation required for the application.
            </p>
        </div>
    </section>
</x-layout>
