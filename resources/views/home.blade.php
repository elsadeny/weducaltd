<x-layout>
    <!-- Hero Section -->
    <section id="home" class="relative bg-navy text-white overflow-hidden min-h-screen flex flex-col justify-center">
        <div class="absolute inset-0 opacity-30">
            <img src="/images/students-campus.jpg" alt="Students on campus" class="w-full h-full object-cover">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-32">
            <div class="max-w-3xl animate-on-scroll">
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 mt-12 leading-tight">
                    Your Gateway to <br><span class="text-teal">Global Education & Careers</span>
                </h1>
                <p
                    class="text-xl md:text-2xl text-gray-300 mb-10 leading-relaxed font-light animate-on-scroll delay-100">
                    Join over 1 million students from 150+ nationalities who have trusted WeducaApply to secure
                    admissions at top universities worldwide.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6 animate-on-scroll delay-200">
                    <a href="#apply"
                        class="btn-primary text-lg px-10 py-4 justify-center shadow-teal/30 shadow-lg">Start Your
                        Application</a>
                    <a href="#destinations"
                        class="btn-outline border-white text-white hover:bg-white hover:text-navy text-lg px-10 py-4 justify-center backdrop-blur-sm bg-white/5">Explore
                        Destinations</a>
                </div>
            </div>
        </div>

        <!-- Stats Banner -->
        <div class="bg-teal py-10 w-full border-b-4 border-teal-light animate-on-scroll delay-300 absolute bottom-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                    <div class="animate-on-scroll">
                        <div class="text-5xl font-black mb-1">1M+</div>
                        <div class="text-teal-900 font-bold uppercase tracking-wider text-sm">Students Helped</div>
                    </div>
                    <div class="animate-on-scroll delay-100">
                        <div class="text-5xl font-black mb-1">1500+</div>
                        <div class="text-teal-900 font-bold uppercase tracking-wider text-sm">Partner Institutions</div>
                    </div>
                    <div class="animate-on-scroll delay-200">
                        <div class="text-5xl font-black mb-1">95%</div>
                        <div class="text-teal-900 font-bold uppercase tracking-wider text-sm">Success Rate</div>
                    </div>
                    <div class="animate-on-scroll delay-300">
                        <div class="text-5xl font-black mb-1">150+</div>
                        <div class="text-teal-900 font-bold uppercase tracking-wider text-sm">Nationalities</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-white scroll-mt-20 relative overflow-hidden">
        <!-- Decorative background blobs -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-teal/5 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-72 h-72 bg-navy/5 rounded-full translate-y-1/2 -translate-x-1/4 blur-3xl pointer-events-none">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="lg:w-1/2">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-teal/20 rounded-3xl transform rotate-3"></div>
                        <!-- About Image Carousel -->
                        <div id="about-carousel" class="relative rounded-2xl shadow-2xl overflow-hidden h-64 sm:h-96 lg:h-[500px]">
                            <img data-slide="0" src="/images/diverse-students.jpg"
                                class="carousel-slide about-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                                alt="Diverse students">
                            <img data-slide="1" src="/images/about/students-2.jpg"
                                class="carousel-slide about-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0"
                                alt="Students studying">
                            <img data-slide="2" src="/images/about/students-3.jpg"
                                class="carousel-slide about-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0"
                                alt="Campus life">
                            <img data-slide="3" src="/images/about/students-4.jpg"
                                class="carousel-slide about-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0"
                                alt="Students learning">
                            <!-- Dot indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                                <button data-carousel="about" data-index="0"
                                    class="about-dot w-6 h-2 bg-white rounded-full transition-all duration-300 focus:outline-none"></button>
                                <button data-carousel="about" data-index="1"
                                    class="about-dot w-2 h-2 bg-white/50 rounded-full transition-all duration-300 focus:outline-none"></button>
                                <button data-carousel="about" data-index="2"
                                    class="about-dot w-2 h-2 bg-white/50 rounded-full transition-all duration-300 focus:outline-none"></button>
                                <button data-carousel="about" data-index="3"
                                    class="about-dot w-2 h-2 bg-white/50 rounded-full transition-all duration-300 focus:outline-none"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 animate-on-scroll delay-200">
                    <span class="text-teal font-bold tracking-wider uppercase text-sm mb-2 block">Who We Are</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-navy mb-8">Our Mission</h2>

                    <!-- Mission Text Carousel -->
                    <div id="mission-text" class="relative min-h-[220px] mb-12">
                        <div data-mission="0"
                            class="mission-panel bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
                            <h3 class="text-xl font-bold text-navy mb-3 flex items-center"><svg
                                    class="w-5 h-5 mr-2 text-teal" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg> Our Goal</h3>
                            <p class="text-gray-600 text-lg leading-relaxed">At <span
                                    class="font-bold text-navy">WeducaApply Ltd</span>, we believe that education spans
                                beyond borders. Our mission is to facilitate seamless international study experiences
                                for ambitious students globally. Whether you are aiming for the UK, US, Canada,
                                Australia, or anywhere in Europe, we connect you with the right opportunities.</p>
                        </div>
                        <div data-mission="1"
                            class="mission-panel hidden bg-teal/5 rounded-2xl p-6 border border-teal/20">
                            <h3 class="text-xl font-bold text-navy mb-3 flex items-center"><svg
                                    class="w-5 h-5 mr-2 text-teal" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg> Our Track Record</h3>
                            <p class="text-gray-600 text-lg leading-relaxed">With physical offices in <span
                                    class="text-teal font-semibold">Kigali (Rwanda)</span> and <span
                                    class="text-teal font-semibold">Bujumbura (Burundi)</span>, and a robust online
                                platform, we've guided over a million students. Our 95% visa success rate and
                                partnerships with 1500+ global institutions stand as a testament to our commitment.</p>
                        </div>
                        <!-- Dots -->
                        <div class="absolute -bottom-8 left-0 flex space-x-2">
                            <button data-mission-dot="0"
                                class="mission-dot w-6 h-2 bg-teal rounded-full transition-all duration-300 focus:outline-none"></button>
                            <button data-mission-dot="1"
                                class="mission-dot w-2 h-2 bg-gray-300 rounded-full transition-all duration-300 focus:outline-none"></button>
                        </div>
                    </div>
                    <a href="#team"
                        class="text-teal font-bold hover:text-navy inline-flex items-center text-lg group transition-colors">
                        Meet Our Experts
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section id="services" class="py-24 bg-gray-50 scroll-mt-20 relative overflow-hidden">
        <!-- Section shadow separator from above -->
        <div class="absolute top-0 inset-x-0 h-16 bg-gradient-to-b from-white to-transparent pointer-events-none"></div>
        <!-- Decorative circle -->
        <div
            class="absolute right-0 top-1/3 w-80 h-80 bg-teal/5 rounded-full translate-x-1/2 blur-2xl pointer-events-none">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-20 animate-on-scroll">
                <span class="text-teal font-bold tracking-wider uppercase text-sm">What We Do</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-navy mt-2">Comprehensive Services</h2>
                <div class="w-24 h-1.5 bg-teal mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
                <!-- Service 1 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100 group animate-on-scroll">
                    <div
                        class="w-16 h-16 bg-teal/10 rounded-2xl flex items-center justify-center text-teal mb-8 group-hover:bg-teal group-hover:text-white transition-colors duration-300 group-hover:-translate-y-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy mb-4">University Admissions</h3>
                    <p class="text-gray-600 leading-relaxed">Expert guidance to match you with top universities and
                        programs globally based on your academic profile and career aspirations.</p>
                </div>

                <!-- Service 2 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100 group animate-on-scroll delay-100">
                    <div
                        class="w-16 h-16 bg-teal/10 rounded-2xl flex items-center justify-center text-teal mb-8 group-hover:bg-teal group-hover:text-white transition-colors duration-300 group-hover:-translate-y-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy mb-4">Visa Processing</h3>
                    <p class="text-gray-600 leading-relaxed">Comprehensive support for student visas, study permits, and
                        rigorous interview preparation boasting a 95% success rate.</p>
                </div>

                <!-- Service 3 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100 group animate-on-scroll delay-200">
                    <div
                        class="w-16 h-16 bg-teal/10 rounded-2xl flex items-center justify-center text-teal mb-8 group-hover:bg-teal group-hover:text-white transition-colors duration-300 group-hover:-translate-y-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy mb-4">Scholarship Help</h3>
                    <p class="text-gray-600 leading-relaxed">Assistance in finding and applying for lucrative
                        scholarships, grants, and financial aid to make your education more affordable.</p>
                </div>

                <!-- Service 4 -->
                <div
                    class="bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100 group animate-on-scroll delay-300">
                    <div
                        class="w-16 h-16 bg-teal/10 rounded-2xl flex items-center justify-center text-teal mb-8 group-hover:bg-teal group-hover:text-white transition-colors duration-300 group-hover:-translate-y-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy mb-4">Accommodation</h3>
                    <p class="text-gray-600 leading-relaxed">We provide assistance in securing safe, comfortable, and
                        affordable student accommodation near your chosen university campus.</p>
                </div>

                <!-- Service 5 -->
                <div class="bg-white p-10 rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 border border-gray-100 group animate-on-scroll delay-400">
                    <div class="w-16 h-16 bg-teal/10 rounded-2xl flex items-center justify-center text-teal mb-8 group-hover:bg-teal group-hover:text-white transition-colors duration-300 group-hover:-translate-y-2">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-navy mb-4">Work Abroad</h3>
                    <p class="text-gray-600 leading-relaxed">Securing career placements and navigating global employment pathways to ensure a smooth transition into your international future.</p>
                </div>
            </div>
        </div>
        <!-- Bottom fade into navy destinations -->
        <div class="absolute bottom-0 inset-x-0 h-16 bg-gradient-to-t from-navy/10 to-transparent pointer-events-none">
        </div>
    </section>

    @include('partials.programs-section')

    <!-- Destinations -->
    <section id="destinations" class="py-24 bg-navy text-white scroll-mt-20 relative overflow-hidden">
        <!-- Background decorative gradient orbs -->
        <div class="absolute top-10 left-10 w-96 h-96 bg-teal/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-teal/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <span class="text-teal font-bold tracking-wider uppercase text-sm">Where To?</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mt-2">Top Destinations</h2>
                <div class="w-24 h-1.5 bg-teal mx-auto mt-6 rounded-full mb-8"></div>
                
                <div class="flex justify-center mb-10 animate-on-scroll">
                    <div class="inline-flex bg-gray-800 rounded-full p-1 relative border border-gray-700">
                        <div id="dest-tab-pill" class="absolute inset-y-1 left-1 w-[calc(50%-4px)] bg-teal rounded-full transition-all duration-300 ease-in-out"></div>
                        <button type="button" onclick="switchDestTab('study')" id="tab-study-btn" class="relative z-10 px-6 py-3 text-sm font-bold text-white transition-colors duration-200 focus:outline-none w-40 sm:w-48 text-center">Study Abroad</button>
                        <button type="button" onclick="switchDestTab('work')" id="tab-work-btn" class="relative z-10 px-6 py-3 text-sm font-bold text-gray-400 hover:text-white transition-colors duration-200 focus:outline-none w-40 sm:w-48 text-center">Work Abroad</button>
                    </div>
                </div>
            </div>

            <!-- Panel: Study -->
            <div id="panel-study-dest" class="dest-panel block">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if(isset($studyDestinations) && $studyDestinations->count() > 0)
                        @foreach($studyDestinations->take(6) as $index => $destination)
                        <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl hover:shadow-teal/20 hover:shadow-3xl transition-all duration-300 border border-gray-700 flex flex-col group animate-on-scroll"
                            style="transition-delay: {{ $index * 100 }}ms">
                            @if($destination->image)
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent z-10"></div>
                                    <img src="{{ Storage::url($destination->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="{{ $destination->name }}">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">{{ $destination->flag_emoji }}</span>
                                </div>
                            @else
                                <div
                                    class="h-56 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center relative">
                                    <span class="text-7xl">{{ $destination->flag_emoji }}</span>
                                </div>
                            @endif
                            <div class="p-8 flex-1 flex flex-col">
                                <h3 class="text-2xl font-bold text-white mb-4">
                                    {{ $destination->name }}
                                </h3>
                                <p class="text-gray-400 mb-8 flex-1 leading-relaxed">{{ $destination->description }}</p>
                                <a href="#apply"
                                    onclick="document.getElementById('message').value = 'I want to study in {{ $destination->name }}';"
                                    class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">
                                    Apply for {{ $destination->name }}
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    
                    @if($studyDestinations->count() > 6)
                        <a href="{{ route('destinations') }}" class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl hover:shadow-teal/20 hover:shadow-3xl transition-all duration-300 border border-gray-700 flex flex-col items-center justify-center group animate-on-scroll min-h-[300px]">
                            <span class="text-6xl text-teal mb-4 group-hover:scale-125 transition-transform duration-500">+{{ $studyDestinations->count() - 6 }}</span>
                            <h3 class="text-2xl font-bold text-white group-hover:text-teal transition-colors">More Study Options</h3>
                            <p class="text-gray-400 mt-2 flex items-center">Explore All <svg class="w-5 h-5 ml-1 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></p>
                        </a>
                    @endif
                @else
                            <!-- Fallback data - 6 destinations with full photos -->
                            <!-- United Kingdom -->
                            <div
                                class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll">
                                <div class="h-56 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent z-10">
                                    </div>
                                    <img src="/images/destinations/uk.jpg"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="United Kingdom">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">🇬🇧</span>
                                </div>
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-3">United Kingdom</h3>
                                    <p class="text-gray-400 mb-6 flex-1 leading-relaxed">Experience world-class education rooted in
                                        centuries of tradition. The UK boasts a diverse, vibrant culture and globally recognized
                                        degrees from institutions like Oxford, Cambridge, and Imperial.</p>
                                    <a href="#apply"
                                        class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply
                                        for UK <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg></a>
                                </div>
                            </div>

                            <!-- United States -->
                            <div
                                class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll delay-100">
                                <div class="h-56 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent z-10">
                                    </div>
                                    <img src="/images/destinations/usa.jpg"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="United States">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">🇺🇸</span>
                                </div>
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-3">United States</h3>
                                    <p class="text-gray-400 mb-6 flex-1 leading-relaxed">The land of opportunity hosts the world's
                                        most prestigious Ivy League institutions. Expect cutting-edge research facilities, limitless
                                        networking, and a vibrant campus life.</p>
                                    <a href="#apply"
                                        class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply
                                        for US <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg></a>
                                </div>
                            </div>

                            <!-- Canada -->
                            <div
                                class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll delay-200">
                                <div class="h-56 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent z-10">
                                    </div>
                                    <img src="/images/destinations/canada.jpg"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="Canada">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">🇨🇦</span>
                                </div>
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-3">Canada</h3>
                                    <p class="text-gray-400 mb-6 flex-1 leading-relaxed">Known for its welcoming environment and
                                        multicultural cities. Canada provides exceptional education and attractive post-graduation
                                        work opportunities in a safe society.</p>
                                    <a href="#apply"
                                        class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply
                                        for Canada <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg></a>
                                </div>
                            </div>

                            <!-- Australia -->
                            <div
                                class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll delay-300">
                                <div class="h-56 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent z-10">
                                    </div>
                                    <img src="/images/destinations/australia.jpg"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="Australia">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">🇦🇺</span>
                                </div>
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-3">Australia</h3>
                                    <p class="text-gray-400 mb-6 flex-1 leading-relaxed">Study in a country synonymous with
                                        innovation and natural beauty. Australian universities are renowned for their focus on
                                        practical learning and laid-back lifestyle.</p>
                                    <a href="#apply"
                                        class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply
                                        for Australia <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg></a>
                                </div>
                            </div>

                            <!-- Germany -->
                            <div
                                class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll">
                                <div class="h-56 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent z-10">
                                    </div>
                                    <img src="/images/destinations/germany.jpg"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="Germany">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">🇩🇪</span>
                                </div>
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-3">Germany</h3>
                                    <p class="text-gray-400 mb-6 flex-1 leading-relaxed">Germany offers tuition-free education at
                                        public universities and is a leader in engineering and technology — ideal for ambitious
                                        international students.</p>
                                    <a href="#apply"
                                        class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply
                                        for Germany <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg></a>
                                </div>
                            </div>

                            <!-- France -->
                            <div
                                class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll delay-300">
                                <div class="h-56 overflow-hidden relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/30 to-transparent z-10">
                                    </div>
                                    <img src="/images/destinations/france.jpg"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                                        alt="France">
                                    <span class="absolute bottom-4 right-4 text-4xl z-20">🇫🇷</span>
                                </div>
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-3">France</h3>
                                    <p class="text-gray-400 mb-6 flex-1 leading-relaxed">France combines academic excellence with
                                        unrivalled art, culture and cuisine. Home to grandes écoles and top-ranked universities with
                                        affordable tuition.</p>
                                    <a href="#apply"
                                        class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply
                                        for France <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Panel: Work -->
            <div id="panel-work-dest" class="dest-panel hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if(isset($workDestinations) && $workDestinations->count() > 0)
                        @foreach($workDestinations->take(6) as $index => $destination)
                            <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl hover:shadow-teal/20 hover:shadow-3xl transition-all duration-300 border border-gray-700 flex flex-col group animate-on-scroll" style="transition-delay: {{ min($index * 50, 500) }}ms">
                                @if($destination->image)
                                    <div class="h-56 overflow-hidden relative">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent z-10"></div>
                                        <img src="{{ Storage::url($destination->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $destination->name }}">
                                        <span class="absolute bottom-4 right-4 text-4xl z-20">{{ $destination->flag_emoji }}</span>
                                    </div>
                                @else
                                    <div class="h-56 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center relative">
                                        <span class="text-7xl">{{ $destination->flag_emoji }}</span>
                                    </div>
                                @endif
                                <div class="p-8 flex-1 flex flex-col">
                                    <h3 class="text-2xl font-bold text-white mb-4">{{ $destination->name }}</h3>
                                    <p class="text-gray-400 mb-8 flex-1 leading-relaxed">{{ $destination->description }}</p>
                                    <a href="#apply" onclick="document.getElementById('message').value = 'I want to work in {{ $destination->name }}';" class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">
                                        Apply for Work <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($workDestinations->count() > 6)
                            <a href="{{ route('destinations') }}" class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl hover:shadow-teal/20 hover:shadow-3xl transition-all duration-300 border border-gray-700 flex flex-col items-center justify-center group animate-on-scroll min-h-[300px]">
                                <span class="text-6xl text-teal mb-4 group-hover:scale-125 transition-transform duration-500">+{{ $workDestinations->count() - 6 }}</span>
                                <h3 class="text-2xl font-bold text-white group-hover:text-teal transition-colors">More Work Options</h3>
                                <p class="text-gray-400 mt-2 flex items-center">Explore All <svg class="w-5 h-5 ml-1 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></p>
                            </a>
                        @endif
                    @else
                        <!-- Fallback data - 3 work destinations -->
                        <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll">
                            <div class="h-56 bg-gradient-to-br from-indigo-700 to-gray-900 flex items-center justify-center relative">
                                <span class="text-7xl">🇵🇱</span>
                            </div>
                            <div class="p-8 flex-1 flex flex-col">
                                <h3 class="text-2xl font-bold text-white mb-3">Poland</h3>
                                <p class="text-gray-400 mb-6 flex-1 leading-relaxed">A growing hub in Europe offering immense career prospects in tech, healthcare, and engineering with a high standard of living.</p>
                                <a href="#apply" class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply for Poland <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll delay-100">
                            <div class="h-56 bg-gradient-to-br from-teal-700 to-gray-900 flex items-center justify-center relative">
                                <span class="text-7xl">🇩🇪</span>
                            </div>
                            <div class="p-8 flex-1 flex flex-col">
                                <h3 class="text-2xl font-bold text-white mb-3">Germany</h3>
                                <p class="text-gray-400 mb-6 flex-1 leading-relaxed">Europe's largest economy is actively seeking skilled professionals to join their dynamic workforce in diverse industries.</p>
                                <a href="#apply" class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply for Germany <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
                            </div>
                        </div>

                        <div class="bg-gray-800 rounded-3xl overflow-hidden shadow-2xl border border-gray-700 flex flex-col group animate-on-scroll delay-200">
                            <div class="h-56 bg-gradient-to-br from-red-700 to-gray-900 flex items-center justify-center relative">
                                <span class="text-7xl">🇨🇦</span>
                            </div>
                            <div class="p-8 flex-1 flex flex-col">
                                <h3 class="text-2xl font-bold text-white mb-3">Canada</h3>
                                <p class="text-gray-400 mb-6 flex-1 leading-relaxed">Embrace exceptional work-life balance and progressive immigration pathways in one of the most welcoming nations globally.</p>
                                <a href="#apply" class="text-teal font-bold hover:text-white mt-auto inline-flex items-center group-hover:translate-x-2 transition-transform">Apply for Canada <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
    </section>

    <!-- Support / Contact Section -->
    <section id="contact" class="py-24 bg-white scroll-mt-20 relative overflow-hidden">
        <!-- Top shadow from navy section -->
        <div class="absolute top-0 inset-x-0 h-20 bg-gradient-to-b from-navy/8 to-transparent pointer-events-none">
        </div>
        <!-- Background decorative elements -->
        <div
            class="absolute top-1/4 left-0 w-72 h-72 bg-teal/5 rounded-full -translate-x-1/2 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-1/4 w-56 h-56 bg-navy/5 rounded-full translate-y-1/3 blur-2xl pointer-events-none">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="lg:w-1/2">
                    <div class="relative">
                        <!-- Decorative border frame -->
                        <div class="absolute -inset-3 bg-gradient-to-br from-teal/20 to-navy/10 rounded-3xl -rotate-1">
                        </div>
                        <!-- Contact Image Carousel -->
                        <div id="contact-carousel" class="relative rounded-3xl shadow-xl overflow-hidden h-64 sm:h-96 lg:h-[600px]">
                            <img data-slide="0" src="/images/customer-support.jpg"
                                class="carousel-slide contact-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                                alt="Customer Support">
                            <img data-slide="1" src="/images/contact/support-2.jpg"
                                class="carousel-slide contact-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0"
                                alt="Support Team">
                            <img data-slide="2" src="/images/contact/support-3.jpg"
                                class="carousel-slide contact-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0"
                                alt="Office Environment">
                            <img data-slide="3" src="/images/contact/support-4.jpg"
                                class="carousel-slide contact-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-700 opacity-0"
                                alt="Team Collaboration">
                            <!-- Dot indicators -->
                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                                <button data-carousel="contact" data-index="0"
                                    class="contact-dot w-6 h-2 bg-white rounded-full transition-all duration-300 focus:outline-none"></button>
                                <button data-carousel="contact" data-index="1"
                                    class="contact-dot w-2 h-2 bg-white/50 rounded-full transition-all duration-300 focus:outline-none"></button>
                                <button data-carousel="contact" data-index="2"
                                    class="contact-dot w-2 h-2 bg-white/50 rounded-full transition-all duration-300 focus:outline-none"></button>
                                <button data-carousel="contact" data-index="3"
                                    class="contact-dot w-2 h-2 bg-white/50 rounded-full transition-all duration-300 focus:outline-none"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 animate-on-scroll delay-200">
                    <span class="text-teal font-bold tracking-wider uppercase text-sm mb-2 block">We're Here For
                        You</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-navy mb-8">Get in Touch</h2>

                    <div class="bg-gray-50 rounded-3xl p-8 shadow-sm border border-gray-100 space-y-8">
                        <!-- Founder Info -->
                        <div class="flex items-start group">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-14 h-14 bg-teal/10 text-teal rounded-2xl flex items-center justify-center group-hover:bg-teal group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-bold text-navy">EMMANUEL KANAMUGIRE</h4>
                                <p class="text-gray-600 mt-2 text-lg">Founder & Managing Director</p>
                            </div>
                        </div>

                        <div class="flex items-start group border-t border-gray-200 pt-8">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-14 h-14 bg-teal/10 text-teal rounded-2xl flex items-center justify-center group-hover:bg-teal group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-bold text-navy">Our Offices</h4>
                                <p class="text-gray-600 mt-2 text-lg">Rubirizi, KK 225 Street<br>Kigali, Rwanda</p>
                            </div>
                        </div>

                        <div class="flex items-start group border-t border-gray-200 pt-8">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-14 h-14 bg-teal/10 text-teal rounded-2xl flex items-center justify-center group-hover:bg-teal group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-bold text-navy">Phone Support</h4>
                                <p class="text-gray-600 mt-2 text-lg">+250 789 000 213<br>Mon-Fri, 9am - 5pm</p>
                            </div>
                        </div>

                        <div class="flex items-start group border-t border-gray-200 pt-8">
                            <div class="flex-shrink-0 mt-1">
                                <div
                                    class="w-14 h-14 bg-teal/10 text-teal rounded-2xl flex items-center justify-center group-hover:bg-teal group-hover:text-white transition-colors shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-xl font-bold text-navy">Email Address</h4>
                                <p class="text-gray-600 mt-2 text-lg">admissions.weducaapply@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Apply / Auth Section -->
    <section id="apply" class="py-24 scroll-mt-20 relative overflow-hidden"
        style="background: linear-gradient(160deg, #f0fdfc 0%, #f8faff 40%, #f1f5f9 100%);">
        <!-- Background decorative elements -->
        <div class="absolute top-0 inset-x-0 h-20 bg-gradient-to-b from-white/60 to-transparent pointer-events-none">
        </div>
        <div
            class="absolute top-1/2 left-0 w-64 h-64 bg-teal/8 rounded-full -translate-y-1/2 -translate-x-1/2 blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute top-1/2 right-0 w-64 h-64 bg-navy/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-14 animate-on-scroll">
                <span class="text-teal font-bold tracking-wider uppercase text-sm">Get Started</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-navy mt-2">Your Account, Your Journey</h2>
                <div class="w-24 h-1.5 bg-teal mx-auto mt-6 rounded-full mb-6"></div>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">New here? Create an account. Already a member? Log
                    right in.</p>
            </div>

            @if(session('success'))
                <div class="bg-teal/10 border border-teal text-teal-900 px-6 py-4 rounded-xl relative mb-8 flex items-center max-w-2xl mx-auto"
                    role="alert">
                    <svg class="w-6 h-6 mr-3 text-teal flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- ── Single Auth Card ── -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">

                    <!-- ── Tab Header ── -->
                    <div class="relative flex border-b border-gray-100">
                        <!-- Sliding teal underline -->
                        <div id="auth-tab-pill"
                            class="absolute bottom-0 h-0.5 w-1/2 bg-teal transition-all duration-300 ease-in-out"
                            style="left: 0;"></div>
                        <!-- Sign In (left, default active) -->
                        <button type="button" id="tab-login" onclick="switchAuthTab('login')"
                            class="auth-tab flex-1 flex items-center justify-center gap-2 py-4 font-bold text-sm focus:outline-none text-teal transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Sign In
                        </button>
                        <!-- Create Account (right) -->
                        <button type="button" id="tab-register" onclick="switchAuthTab('register')"
                            class="auth-tab flex-1 flex items-center justify-center gap-2 py-4 font-bold text-sm focus:outline-none text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Create Account
                        </button>
                    </div>

                    <!-- ── Card Body ── -->
                    <div class="p-8 md:p-10">


                        <!-- Register Form -->
                        <div id="panel-register" class="auth-panel hidden">

                            <p class="text-gray-500 text-sm mb-7">Start your application — it's free and takes just a
                                minute.</p>

                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="mb-7">
                                    <h4
                                        class="text-xs font-bold text-navy mb-4 pb-2 border-b border-gray-100 flex items-center uppercase tracking-wider">
                                        <span
                                            class="bg-teal text-white w-5 h-5 rounded-full flex items-center justify-center text-xs mr-2">1</span>
                                        Personal Details
                                    </h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                                for="reg_name">Full Name <span class="text-teal">*</span></label>
                                            <input
                                                class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                                id="reg_name" name="name" type="text" placeholder="John Doe" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                                for="reg_email">Email <span class="text-teal">*</span></label>
                                            <input
                                                class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                                id="reg_email" name="email" type="email" placeholder="john@example.com"
                                                required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                                for="reg_password">Password <span class="text-teal">*</span></label>
                                            <input
                                                class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                                id="reg_password" name="password" type="password"
                                                placeholder="Create a password" required>
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                                for="reg_password_confirmation">Confirm Password <span
                                                    class="text-teal">*</span></label>
                                            <input
                                                class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                                id="reg_password_confirmation" name="password_confirmation"
                                                type="password" placeholder="Repeat your password" required>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                                for="reg_nationality">Nationality</label>
                                            <input
                                                class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                                id="reg_nationality" name="nationality" type="text"
                                                placeholder="e.g. Rwandan">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-7">
                                    <h4
                                        class="text-xs font-bold text-navy mb-4 pb-2 border-b border-gray-100 flex items-center uppercase tracking-wider">
                                        <span
                                            class="bg-teal text-white w-5 h-5 rounded-full flex items-center justify-center text-xs mr-2">2</span>
                                        Academic Interests
                                    </h4>
                                    <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                        for="message">Desired Program & Notes <span class="text-teal">*</span></label>
                                    <textarea
                                        class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                        id="message" name="message" rows="3"
                                        placeholder="I am interested in pursuing a Master's in Computer Science in Canada..."
                                        required></textarea>
                                </div>

                                <button
                                    class="btn-primary w-full py-3.5 justify-center shadow-teal/30 shadow-md text-base"
                                    type="submit">
                                    Create Account
                                </button>
                                <p class="text-gray-400 text-xs text-center mt-4">
                                    By registering, you agree to our <a href="{{ route('privacy') }}"
                                        class="text-teal hover:underline">privacy policy</a>.
                                </p>
                            </form>
                        </div>

                        <!-- Login Form -->
                        <div id="panel-login" class="auth-panel">

                            <p class="text-gray-500 text-sm mb-7">Welcome back! Access your student dashboard.</p>

                            <form action="/login" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                        for="login_email">Email Address</label>
                                    <input
                                        class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                        id="login_email" name="email" type="email" placeholder="john@example.com"
                                        required>
                                </div>
                                <div class="mb-5">
                                    <label class="block text-gray-700 font-semibold mb-1.5 text-sm"
                                        for="login_password">Password</label>
                                    <input
                                        class="bg-gray-50 border border-gray-200 rounded-xl w-full py-3 px-4 text-gray-700 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-teal focus:border-transparent transition-all"
                                        id="login_password" name="password" type="password" placeholder="••••••••"
                                        required>
                                </div>
                                <div class="flex items-center justify-between mb-8">
                                    <label class="flex items-center text-gray-600 cursor-pointer text-sm">
                                        <input type="checkbox" name="remember"
                                            class="form-checkbox h-4 w-4 text-teal rounded border-gray-300 focus:ring-teal">
                                        <span class="ml-2">Remember me</span>
                                    </label>
                                    <a href="#" class="text-sm text-teal font-semibold hover:text-navy">Forgot
                                        Password?</a>
                                </div>
                                <button
                                    class="btn-primary w-full py-3.5 flex justify-center shadow-teal/30 shadow-md text-base"
                                    type="submit">
                                    Secure Login
                                </button>
                                <p class="text-gray-400 text-xs text-center mt-4">
                                    Access is restricted to registered students and applicants.
                                </p>
                            </form>
                        </div>

                    </div><!-- /Card Body -->
                </div><!-- /Card -->
            </div><!-- /Auth wrapper -->

        </div>
    </section>

    <script>
        function switchDestTab(tab) {
            const studyBtn = document.getElementById('tab-study-btn');
            const workBtn = document.getElementById('tab-work-btn');
            const studyPanel = document.getElementById('panel-study-dest');
            const workPanel = document.getElementById('panel-work-dest');
            const pill = document.getElementById('dest-tab-pill');

            if (tab === 'study') {
                studyBtn.classList.replace('text-gray-400', 'text-white');
                studyBtn.classList.remove('hover:text-white');
                workBtn.classList.replace('text-white', 'text-gray-400');
                workBtn.classList.add('hover:text-white');
                pill.style.left = '4px';
                
                studyPanel.classList.remove('hidden');
                studyPanel.classList.add('block');
                workPanel.classList.add('hidden');
                workPanel.classList.remove('block');
            } else {
                workBtn.classList.replace('text-gray-400', 'text-white');
                workBtn.classList.remove('hover:text-white');
                studyBtn.classList.replace('text-white', 'text-gray-400');
                studyBtn.classList.add('hover:text-white');
                pill.style.left = 'calc(50% - 4px)';

                workPanel.classList.remove('hidden');
                workPanel.classList.add('block');
                studyPanel.classList.add('hidden');
                studyPanel.classList.remove('block');
            }
        }
    </script>
</x-layout>