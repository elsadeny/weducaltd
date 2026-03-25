<x-admin.layouts.app title="Programs">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-navy">Programs</h2>
            <p class="text-sm text-gray-400">Programs available at each institution</p>
        </div>
        <a href="{{ route('admin.programs.create') }}" class="bg-teal text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-teal-light transition">
            + Add Program
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        @if($programs->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/>
                </svg>
                No programs yet. <a href="{{ route('admin.programs.create') }}" class="text-teal hover:underline">Add one →</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-3">Program</th>
                            <th class="px-6 py-3">Institution</th>
                            <th class="px-6 py-3">Destination</th>
                            <th class="px-6 py-3">Level</th>
                            <th class="px-6 py-3">Duration</th>
                            <th class="px-6 py-3">Fees</th>
                            <th class="px-6 py-3">Type</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($programs as $prog)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-semibold text-navy">{{ $prog->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $prog->institution->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if($prog->institution->destination ?? null)
                                        {{ $prog->institution->destination->flag_emoji }} {{ $prog->institution->destination->name }}
                                    @else
                                        <span class="text-gray-300">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $prog->level ?: '—' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $prog->duration ?: '—' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $prog->fees ?: '—' }}</td>
                                <td class="px-6 py-4">
                                    @if($prog->category === 'work')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">Work</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-teal/10 text-teal">Study</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($prog->is_active)
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Active</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Hidden</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.programs.edit', $prog) }}" class="text-xs text-navy font-semibold hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('admin.programs.destroy', $prog) }}" class="inline" onsubmit="return confirm('Delete this program?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-semibold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">{{ $programs->links() }}</div>
        @endif
    </div>

</x-admin.layouts.app>
