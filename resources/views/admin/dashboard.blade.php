<x-admin.layouts.app title="Dashboard">

    {{-- Welcome banner --}}
    <div class="bg-navy rounded-2xl p-6 mb-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200" fill="none">
                <circle cx="350" cy="50" r="120" fill="white"/>
                <circle cx="80" cy="180" r="80" fill="white"/>
            </svg>
        </div>
        <div class="relative z-10">
            <p class="text-amber-400 text-sm font-semibold uppercase tracking-wider mb-1">Admin Overview</p>
            <h2 class="text-2xl font-bold text-white mb-1">Welcome, {{ Auth::user()->name }}</h2>
            <p class="text-gray-300 text-sm">Here's a real-time snapshot of all applications and students.</p>
        </div>
    </div>

    {{-- Stats grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
        @php
            $cards = [
                ['label'=>'Total',       'count'=>$stats['total_applications'], 'bg'=>'bg-navy',     'fg'=>'text-white'],
                ['label'=>'Pending',     'count'=>$stats['pending'],            'bg'=>'bg-amber-50', 'fg'=>'text-amber-700'],
                ['label'=>'Reviewing',   'count'=>$stats['reviewing'],          'bg'=>'bg-blue-50',  'fg'=>'text-blue-700'],
                ['label'=>'Approved',    'count'=>$stats['approved'],           'bg'=>'bg-green-50', 'fg'=>'text-green-700'],
                ['label'=>'Rejected',    'count'=>$stats['rejected'],           'bg'=>'bg-red-50',   'fg'=>'text-red-700'],
                ['label'=>'Students',    'count'=>$stats['total_students'],     'bg'=>'bg-teal/10',  'fg'=>'text-teal'],
            ];
        @endphp
        @foreach($cards as $card)
            <div class="{{ $card['bg'] }} rounded-2xl p-5 shadow-sm">
                <div class="text-3xl font-extrabold {{ $card['fg'] }}">{{ $card['count'] }}</div>
                <div class="text-xs font-semibold {{ $card['fg'] }} opacity-70 uppercase tracking-wider mt-1">{{ $card['label'] }}</div>
            </div>
        @endforeach
    </div>

    {{-- Recent applications table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-navy text-lg">Recent Applications</h3>
            <a href="{{ route('admin.applications.index') }}" class="text-teal text-sm font-semibold hover:underline">View all →</a>
        </div>

        @if($recent->isEmpty())
            <div class="text-center py-12 text-gray-400">No applications yet.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-3">Student</th>
                            <th class="px-6 py-3">Program</th>
                            <th class="px-6 py-3">Institution</th>
                            <th class="px-6 py-3">Destination</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recent as $app)
                            @php
                                $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
                                $c = $colors[$app->status] ?? 'gray';
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-navy">{{ $app->student->name ?? '—' }}</div>
                                    <div class="text-gray-400 text-xs">{{ $app->student->email ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $app->program }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $app->institution->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $app->destination->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">
                                        {{ $app->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">{{ $app->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.applications.show', $app) }}"
                                       class="text-teal text-xs font-semibold hover:underline">Review →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</x-admin.layouts.app>
