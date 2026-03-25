<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">

    {{-- Image --}}
    <div class="relative h-40 bg-gray-100 overflow-hidden">
        @if($dest->image)
            <img src="{{ Str::startsWith($dest->image, 'http') ? $dest->image : Storage::url($dest->image) }}"
                 alt="{{ $dest->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-navy/10 to-teal/10">
                <span class="text-5xl">{{ $dest->flag_emoji ?? '🌍' }}</span>
            </div>
        @endif

        {{-- Category badge --}}
        <span class="absolute top-2 right-2 text-xs font-bold uppercase tracking-wider px-2 py-1 rounded-full
                     {{ $dest->category === 'study' ? 'bg-teal text-white' : 'bg-amber-500 text-white' }}">
            {{ $dest->category }}
        </span>
    </div>

    <div class="p-4">
        <div class="flex items-center space-x-2 mb-1">
            @if($dest->flag_emoji)
                <span class="text-xl">{{ $dest->flag_emoji }}</span>
            @endif
            <h4 class="font-bold text-navy">{{ $dest->name }}</h4>
        </div>
        @if($dest->description)
            <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 mb-3">{{ $dest->description }}</p>
        @endif

        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.destinations.edit', $dest) }}"
               class="flex-1 text-center text-sm font-semibold text-navy bg-gray-50 hover:bg-teal hover:text-white py-2 rounded-xl transition">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.destinations.destroy', $dest) }}"
                  onsubmit="return confirm('Delete {{ $dest->name }}? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="px-3 py-2 rounded-xl text-red-400 hover:bg-red-50 hover:text-red-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
