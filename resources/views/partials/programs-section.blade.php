<!-- Programs -->
@if(isset($programs) && $programs->count() > 0)
<section id="programs" class="py-24 bg-gray-50 scroll-mt-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 animate-on-scroll">
            <span class="text-teal font-bold tracking-wider uppercase text-sm">Explore Courses</span>
            <h2 class="text-4xl md:text-5xl font-extrabold mt-2 text-navy">Featured Programs</h2>
            <div class="w-24 h-1.5 bg-teal mx-auto mt-6 rounded-full"></div>
        </div>

        {{-- Filter Tabs --}}
        <div x-data="{ filter: 'all' }">
            <div class="flex items-center justify-center gap-3 mb-10">
                <button
                    @click="filter = 'all'"
                    :class="filter === 'all'
                        ? 'bg-navy text-white shadow-md'
                        : 'bg-white text-navy border border-gray-200 hover:border-navy hover:text-navy'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-200 focus:outline-none">
                    All Programs
                </button>
                <button
                    @click="filter = 'study'"
                    :class="filter === 'study'
                        ? 'bg-teal text-white shadow-md'
                        : 'bg-white text-teal border border-teal/30 hover:border-teal hover:bg-teal/5'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-200 focus:outline-none">
                    📚 Study
                </button>
                <button
                    @click="filter = 'work'"
                    :class="filter === 'work'
                        ? 'bg-indigo-600 text-white shadow-md'
                        : 'bg-white text-indigo-600 border border-indigo-200 hover:border-indigo-400 hover:bg-indigo-50'"
                    class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-200 focus:outline-none">
                    💼 Work
                </button>
            </div>

            <div class="relative group">
                <div id="programs-slider" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-8 pt-4 px-4 -mx-4 hide-scrollbar scroll-smooth">
                    @foreach($programs as $prog)
                        <div
                            x-show="filter === 'all' || filter === '{{ $prog->category }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="snap-center shrink-0 w-80 bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 flex flex-col hover:border-teal/30 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                            <div class="px-6 py-5 {{ $prog->category === 'work' ? 'bg-indigo-50 border-b border-indigo-100' : 'bg-teal/5 border-b border-teal/10' }}">
                                <div class="flex justify-between items-start">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $prog->category === 'work' ? 'bg-indigo-100 text-indigo-700' : 'bg-teal/20 text-teal' }}">
                                        {{ $prog->category === 'work' ? '💼 Work' : '📚 Study' }}
                                    </span>
                                    @if($prog->institution && $prog->institution->destination)
                                        <span class="text-2xl" title="{{ $prog->institution->destination->name }}">{{ $prog->institution->destination->flag_emoji }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-navy mt-4 line-clamp-2" title="{{ $prog->name }}">{{ $prog->name }}</h3>
                            </div>

                            <div class="p-6 flex-1 flex flex-col text-sm">
                                <div class="mb-4">
                                    <h4 class="font-bold text-gray-700 mb-1">Institution</h4>
                                    <p class="text-gray-500 truncate" title="{{ $prog->institution->name ?? 'N/A' }}">{{ $prog->institution->name ?? 'N/A' }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    @if($prog->level)
                                    <div>
                                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Level</span>
                                        <span class="font-medium text-navy">{{ $prog->level }}</span>
                                    </div>
                                    @endif
                                    @if($prog->fees)
                                    <div>
                                        <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Fees</span>
                                        <span class="font-medium text-navy">{{ $prog->fees }}</span>
                                    </div>
                                    @endif
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <a href="{{ route('register') }}" class="block w-full py-3 px-4 bg-navy hover:bg-teal text-white text-center font-bold rounded-xl transition-colors duration-300">
                                        Apply for this {{ $prog->category === 'work' ? 'role' : 'program' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button onclick="document.getElementById('programs-slider').scrollBy({left: -320, behavior: 'smooth'})" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white/90 shadow-lg border border-gray-100 w-12 h-12 rounded-full flex items-center justify-center text-navy hover:text-teal hover:bg-white transition-all opacity-0 group-hover:opacity-100 max-md:opacity-0 max-md:pointer-events-none backdrop-blur-sm z-10 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="document.getElementById('programs-slider').scrollBy({left: 320, behavior: 'smooth'})" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white/90 shadow-lg border border-gray-100 w-12 h-12 rounded-full flex items-center justify-center text-navy hover:text-teal hover:bg-white transition-all opacity-0 group-hover:opacity-100 max-md:opacity-0 max-md:pointer-events-none backdrop-blur-sm z-10 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {{-- Empty state when a filter has no results --}}
            <div
                x-show="filter !== 'all' && document.querySelectorAll('#programs-slider [x-show]').length === 0"
                class="text-center py-12 text-gray-400 text-sm">
                No programs found for this category.
            </div>
        </div>

        <style>
            .hide-scrollbar::-webkit-scrollbar { display: none; }
            .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
    </div>
</section>
@endif
