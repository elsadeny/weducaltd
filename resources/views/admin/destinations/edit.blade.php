<x-admin.layouts.app title="Edit Destination">

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-navy transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to destinations
            </a>
        </div>

        <form method="POST" action="{{ route('admin.destinations.update', $destination) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.destinations._form')
        </form>
    </div>

</x-admin.layouts.app>
