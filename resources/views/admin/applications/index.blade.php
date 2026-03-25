<x-admin.layouts.app title="All Applications">

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6 space-y-3">
        {{-- Row 1: search + status + type --}}
        <div class="flex flex-col sm:flex-row gap-3 items-center">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by student name or email..."
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal">
            </div>
            <select name="status" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal bg-white">
                <option value="">All statuses</option>
                <option value="pending"            {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="reviewing"          {{ request('status') === 'reviewing' ? 'selected' : '' }}>Under Review</option>
                <option value="documents_required" {{ request('status') === 'documents_required' ? 'selected' : '' }}>Docs Required</option>
                <option value="approved"           {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected"           {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <select name="type" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal bg-white">
                <option value="">All types</option>
                <option value="study" {{ request('type') === 'study' ? 'selected' : '' }}>Study</option>
                <option value="work"  {{ request('type') === 'work'  ? 'selected' : '' }}>Work</option>
            </select>
        </div>

        {{-- Row 2: time period + custom date range --}}
        <div class="flex flex-col sm:flex-row gap-3 items-center">
            <select name="period" id="period-select" class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal bg-white">
                <option value="">All time</option>
                <option value="today" {{ request('period') === 'today' ? 'selected' : '' }}>Today</option>
                <option value="week"  {{ request('period') === 'week'  ? 'selected' : '' }}>This week</option>
                <option value="month" {{ request('period') === 'month' ? 'selected' : '' }}>This month</option>
                <option value="year"  {{ request('period') === 'year'  ? 'selected' : '' }}>This year</option>
                <option value="custom" {{ request('period') === 'custom' ? 'selected' : '' }}>Custom range</option>
            </select>
            <div id="custom-range" class="flex gap-2 items-center {{ request('period') === 'custom' ? '' : 'hidden' }}">
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                    class="px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal">
                <span class="text-gray-400 text-sm">to</span>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                    class="px-3 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal">
            </div>
            <button type="submit" class="bg-teal text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-teal-light transition whitespace-nowrap">
                Filter
            </button>
            @if(request()->hasAny(['search','status','type','period','date_from','date_to']))
                <a href="{{ route('admin.applications.index') }}" class="text-gray-400 text-sm hover:text-navy transition whitespace-nowrap">Clear</a>
            @endif
        </div>
    </form>

    <script>
        document.getElementById('period-select').addEventListener('change', function () {
            document.getElementById('custom-range').classList.toggle('hidden', this.value !== 'custom');
        });
    </script>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-navy">Applications <span class="text-gray-400 font-normal text-sm">({{ $applications->total() }})</span></h3>
        </div>

        @if($applications->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                No applications found.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-3">Student</th>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Program</th>
                            <th class="px-6 py-3">Institution</th>
                            <th class="px-6 py-3">Docs</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Submitted</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($applications as $app)
                            @php
                                $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
                                $c = $colors[$app->status] ?? 'gray';
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-navy flex items-center justify-center text-white font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($app->student->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-navy">{{ $app->student->name ?? '—' }}</div>
                                            <div class="text-gray-400 text-xs">{{ $app->student->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if(($app->application_type ?? 'study') === 'work')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">Work</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-teal/10 text-teal">Study</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-700 font-medium">{{ $app->program }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $app->institution->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center space-x-1 text-gray-500">
                                        <svg class="w-4 h-4 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                        <span>{{ $app->documents->count() }}</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">
                                        {{ $app->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">{{ $app->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.applications.show', $app) }}"
                                       class="bg-navy text-white text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-teal transition">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

</x-admin.layouts.app>
