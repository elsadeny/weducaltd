<x-admin.layouts.app title="Institutions">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-navy">Institutions</h2>
            <p class="text-sm text-gray-400">Manage partner institutions tied to destinations</p>
        </div>
        <a href="{{ route('admin.institutions.create') }}" class="bg-teal text-white text-sm font-semibold px-5 py-2.5 rounded-xl hover:bg-teal-light transition">
            + Add Institution
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        @if($institutions->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                No institutions yet. <a href="{{ route('admin.institutions.create') }}" class="text-teal hover:underline">Add one →</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-3">Institution</th>
                            <th class="px-6 py-3">Destination</th>
                            <th class="px-6 py-3">Programs</th>
                            <th class="px-6 py-3">Website</th>
                            <th class="px-6 py-3">Accredited</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($institutions as $inst)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        @if($inst->logo)
                                            <img src="{{ Storage::url($inst->logo) }}" class="w-9 h-9 rounded-lg object-contain bg-gray-50 border border-gray-100">
                                        @else
                                            <div class="w-9 h-9 rounded-lg bg-navy/10 flex items-center justify-center text-navy font-bold text-sm shrink-0">
                                                {{ strtoupper(substr($inst->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <span class="font-semibold text-navy">{{ $inst->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if($inst->destination)
                                        {{ $inst->destination->flag_emoji }} {{ $inst->destination->name }}
                                    @elseif($inst->country)
                                        {{ $inst->country }}
                                    @else
                                        <span class="text-gray-300">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-teal/10 text-teal">
                                        {{ $inst->programs()->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($inst->website)
                                        <a href="{{ $inst->website }}" target="_blank" class="text-teal text-xs hover:underline truncate max-w-32 block">{{ $inst->website }}</a>
                                    @else
                                        <span class="text-gray-300">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($inst->accreditation)
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Yes</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.institutions.edit', $inst) }}" class="text-xs text-navy font-semibold hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('admin.institutions.destroy', $inst) }}" class="inline" onsubmit="return confirm('Delete this institution?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs text-red-400 hover:text-red-600 font-semibold">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100">{{ $institutions->links() }}</div>
        @endif
    </div>

</x-admin.layouts.app>
