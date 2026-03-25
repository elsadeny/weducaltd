<x-admin.layouts.app title="Destinations">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-navy">Destinations</h2>
            <p class="text-gray-400 text-sm">Manage study and work destinations shown to applicants.</p>
        </div>
        <a href="{{ route('admin.destinations.create') }}" class="btn-primary">+ Add Destination</a>
    </div>

    {{-- Study Destinations --}}
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <span class="bg-teal/10 text-teal text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full">Study</span>
            <span class="text-gray-400 text-sm">{{ $study->count() }} destination(s)</span>
        </div>

        @if($study->isEmpty())
            <div class="bg-white rounded-2xl border border-dashed border-gray-200 flex flex-col items-center justify-center py-12 text-gray-400">
                <p class="text-sm">No study destinations yet.</p>
                <a href="{{ route('admin.destinations.create') }}" class="mt-2 text-teal text-sm font-semibold hover:underline">Add one →</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($study as $dest)
                    @include('admin.destinations._card', ['dest' => $dest])
                @endforeach
            </div>
        @endif
    </div>

    {{-- Work Destinations --}}
    <div>
        <div class="flex items-center space-x-3 mb-4">
            <span class="bg-amber-100 text-amber-700 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full">Work</span>
            <span class="text-gray-400 text-sm">{{ $work->count() }} destination(s)</span>
        </div>

        @if($work->isEmpty())
            <div class="bg-white rounded-2xl border border-dashed border-gray-200 flex flex-col items-center justify-center py-12 text-gray-400">
                <p class="text-sm">No work destinations yet.</p>
                <a href="{{ route('admin.destinations.create') }}" class="mt-2 text-teal text-sm font-semibold hover:underline">Add one →</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($work as $dest)
                    @include('admin.destinations._card', ['dest' => $dest])
                @endforeach
            </div>
        @endif
    </div>

</x-admin.layouts.app>
