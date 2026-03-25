<x-student.layouts.app title="Dashboard">

    {{-- Welcome banner --}}
    <div class="bg-navy rounded-2xl p-6 mb-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200" fill="none">
                <circle cx="350" cy="50" r="120" fill="white"/>
                <circle cx="80" cy="180" r="80" fill="white"/>
            </svg>
        </div>
        <div class="relative z-10">
            <p class="text-teal text-sm font-semibold uppercase tracking-wider mb-1">Welcome back 👋</p>
            <h2 class="text-2xl font-bold text-white mb-1">{{ Auth::user()->name }}</h2>
            <p class="text-gray-300 text-sm">Here's an overview of your applications</p>
        </div>
    </div>

    {{-- Stats cards --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        @php
            $cards = [
                ['label' => 'Total',     'count' => $stats['total'],     'color' => 'bg-navy',    'text' => 'text-white'],
                ['label' => 'Pending',   'count' => $stats['pending'],   'color' => 'bg-amber-50','text' => 'text-amber-700'],
                ['label' => 'Reviewing', 'count' => $stats['reviewing'], 'color' => 'bg-blue-50', 'text' => 'text-blue-700'],
                ['label' => 'Approved',  'count' => $stats['approved'],  'color' => 'bg-green-50','text' => 'text-green-700'],
                ['label' => 'Rejected',  'count' => $stats['rejected'],  'color' => 'bg-red-50',  'text' => 'text-red-700'],
            ];
        @endphp
        @foreach($cards as $card)
            <div class="{{ $card['color'] }} rounded-2xl p-5 shadow-sm">
                <div class="text-3xl font-extrabold {{ $card['text'] }}">{{ $card['count'] }}</div>
                <div class="text-xs font-semibold {{ $card['text'] }} opacity-70 uppercase tracking-wider mt-1">{{ $card['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Recent applications --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-navy text-lg">Recent Applications</h3>
            <a href="{{ route('student.applications.index') }}" class="text-teal text-sm font-semibold hover:underline">View all →</a>
        </div>

        @if($applications->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-center px-6">
                <div class="w-16 h-16 bg-teal/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h4 class="text-navy font-bold text-xl mb-2">No applications yet</h4>
                <p class="text-gray-400 mb-6">Start your journey by applying to your dream institution.</p>
                <a href="{{ route('student.applications.create') }}" class="btn-primary">Apply Now</a>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($applications->take(5) as $app)
                    <a href="{{ route('student.applications.show', $app) }}"
                       class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition group">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-xl bg-navy/5 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-navy text-sm">{{ $app->program }}</div>
                                <div class="text-gray-400 text-xs">{{ $app->institution->name ?? '—' }} · {{ $app->destination->name ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            @php
                                $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
                                $c = $colors[$app->status] ?? 'gray';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">
                                {{ $app->status_label }}
                            </span>
                            <svg class="w-4 h-4 text-gray-300 group-hover:text-teal transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

</x-student.layouts.app>
