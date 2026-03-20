<x-layout>
    <div class="bg-navy py-16 text-center">
        <h1 class="text-4xl font-bold text-white mb-2">Our Destinations</h1>
        <p class="text-teal-light text-lg">Top countries for international students.</p>
    </div>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <p class="text-gray-600 text-lg">
                    We offer counseling and admission assistance to top study destinations. Explore educational powerhouses across Europe, the Americas, and Oceania.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($destinations) && $destinations->count() > 0)
                    @foreach($destinations as $destination)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition border border-gray-100 flex flex-col">
                        @if($destination->image)
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ Storage::url($destination->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="{{ $destination->name }}">
                            </div>
                        @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-4xl">{{ $destination->flag_emoji }}</span>
                            </div>
                        @endif
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-2xl font-bold text-navy mb-3 flex items-center gap-2">
                                {{ $destination->name }} 
                                <span class="text-2xl">{{ $destination->flag_emoji }}</span>
                            </h3>
                            <p class="text-gray-600 mb-6 flex-1">{{ $destination->description }}</p>
                            <a href="{{ route('apply') }}?destination={{ $destination->id }}" class="text-teal font-medium hover:text-navy mt-auto">Apply for {{ $destination->name }} &rarr;</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback data -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-4xl">🇬🇧</div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-navy mb-3 flex items-center gap-2">United Kingdom 🇬🇧</h3>
                            <p class="text-gray-600 mb-6 flex-1">Home to prestigious universities and a rich cultural heritage, the UK is a top choice for international students offering world-class research facilities.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-4xl">🇺🇸</div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-navy mb-3 flex items-center gap-2">United States 🇺🇸</h3>
                            <p class="text-gray-600 mb-6 flex-1">With the largest number of international students globally, the USA provides unparalleled academic choices and career opportunities post-graduation.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl overflow-hidden shadow border border-gray-100">
                        <div class="h-48 bg-gray-200 flex items-center justify-center text-4xl">🇨🇦</div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-navy mb-3 flex items-center gap-2">Canada 🇨🇦</h3>
                            <p class="text-gray-600 mb-6 flex-1">Renowned for its high quality of life, friendly environment, and excellent educational institutions with clear pathways to permanent residency.</p>
                        </div>
                    </div>
                @endif
            </div>
            
            <div class="mt-16 text-center">
                <a href="{{ route('contact') }}" class="btn-outline">Can't find your destination? Contact Us</a>
            </div>
        </div>
    </section>
</x-layout>
