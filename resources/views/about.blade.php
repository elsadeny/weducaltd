<x-layout>
    <div class="bg-navy py-16 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">About WeducaApply</h1>
        <p class="text-teal-light text-lg">Empowering global education journeys.</p>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-16 items-center">
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop" class="rounded-2xl shadow-xl w-full" alt="Team meeting">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold text-navy mb-6">Our Mission</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        At WeducaApply Ltd, we believe that education spans beyond borders. Our mission is to facilitate seamless international study experiences for ambitious students globally. Whether you are aiming for the UK, US, Canada, Australia, or anywhere in Europe, we connect you with the right opportunities.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        With physical offices in Kigali (Rwanda) and Bujumbura (Burundi), and a robust online platform, we've guided over a million students. Our 95% visa success rate and partnerships with 1500+ global institutions stand as a testament to our commitment.
                    </p>
                    <div class="grid grid-cols-2 gap-6 border-t border-gray-100 pt-8">
                        <div>
                            <h4 class="text-teal font-bold text-2xl mb-1">1500+</h4>
                            <p class="text-gray-500">Partner Universities</p>
                        </div>
                        <div>
                            <h4 class="text-teal font-bold text-2xl mb-1">140k+</h4>
                            <p class="text-gray-500">Available Programs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    @php
        $team = \App\Models\TeamMember::all();
    @endphp
    @if($team->count() > 0)
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-navy">Meet Our Experts</h2>
                <div class="w-20 h-1 bg-teal mx-auto mt-4 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Founder Profile -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden text-center hover:shadow-md transition">
                    <div class="w-full h-64 bg-navy flex items-center justify-center text-teal-light">
                        <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-navy">EMMANUEL KANAMUGIRE</h3>
                        <p class="text-teal font-medium">Founder & Managing Director</p>
                        <div class="mt-4 space-y-2 text-sm text-gray-500 text-left">
                            <p class="flex items-center justify-center gap-2"><svg class="w-4 h-4 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +250 789 000 213</p>
                            <p class="flex items-center justify-center gap-2"><svg class="w-4 h-4 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> admissions.weducaapply@gmail.com</p>
                        </div>
                    </div>
                </div>
                @foreach($team as $member)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden text-center hover:shadow-md transition">
                    @if($member->photo)
                        <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg class="h-24 w-24" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-navy">{{ $member->name }}</h3>
                        <p class="text-teal">{{ $member->role }}</p>
                        @if($member->bio)
                            <p class="text-gray-500 mt-3 text-sm line-clamp-3">{{ $member->bio }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-layout>
