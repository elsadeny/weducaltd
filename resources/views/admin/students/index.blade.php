<x-admin.layouts.app title="Students">

    {{-- Search --}}
    <form method="GET" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6 flex gap-3 items-center">
        <div class="flex-1 relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by name or email..."
                class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-teal">
        </div>
        <button type="submit" class="bg-teal text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-teal-light transition">
            Search
        </button>
        @if(request('search'))
            <a href="{{ route('admin.students.index') }}" class="text-gray-400 text-sm hover:text-navy">Clear</a>
        @endif
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-navy">All Students <span class="text-gray-400 font-normal text-sm">({{ $students->total() }})</span></h3>
        </div>

        @if($students->isEmpty())
            <div class="text-center py-16 text-gray-400">No students found.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-3">Student</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">Nationality</th>
                            <th class="px-6 py-3">Applications</th>
                            <th class="px-6 py-3">Joined</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($students as $student)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-navy flex items-center justify-center text-white font-bold text-sm shrink-0">
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-navy">{{ $student->name }}</div>
                                            <div class="text-gray-400 text-xs">{{ $student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $student->phone ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $student->nationality ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-navy/10 text-navy font-semibold text-xs px-2.5 py-1 rounded-full">
                                        {{ $student->applications->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs whitespace-nowrap">{{ $student->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.students.show', $student) }}"
                                       class="text-teal text-xs font-semibold hover:underline">View →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $students->links() }}
            </div>
        @endif
    </div>

</x-admin.layouts.app>
