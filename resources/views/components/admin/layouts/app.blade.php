<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} — WeducaApply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50 flex min-h-screen">

{{-- Admin Sidebar --}}
<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-navy flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    {{-- Logo --}}
    <div class="flex items-center space-x-3 px-6 py-5 border-b border-white/10">
        <img src="{{ asset('images/logo.png') }}" alt="Weduca Apply Ltd" class="h-10 w-auto object-contain shrink-0">
        <div>
            <span class="font-bold text-white text-base tracking-tight">Weduca Apply Ltd</span>
            <div class="text-xs text-teal font-semibold uppercase tracking-wider">Admin Panel</div>
        </div>
    </div>

    {{-- Admin badge --}}
    <div class="px-4 py-4 border-b border-white/10">
        <div class="flex items-center space-x-3 bg-white/5 rounded-xl px-3 py-3">
            <div class="w-9 h-9 rounded-full bg-teal flex items-center justify-center text-white font-bold text-sm shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <div class="text-white text-sm font-semibold truncate">{{ Auth::user()->name }}</div>
                <div class="text-teal text-xs font-semibold uppercase tracking-wider">Administrator</div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
        @php
            $navItems = [
                ['route' => 'admin.dashboard',          'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Dashboard'],
                ['route' => 'admin.applications.index', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'Applications'],
                ['route' => 'admin.students.index',     'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Students'],
                ['route' => 'admin.destinations.index',  'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Destinations'],
                ['route' => 'admin.institutions.index', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'label' => 'Institutions'],
                ['route' => 'admin.programs.index',     'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5', 'label' => 'Programs'],
                ['route' => 'admin.settings.index',      'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Settings'],
            ];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                      {{ request()->routeIs($item['route']) || request()->routeIs(str_replace('.index', '.*', $item['route'])) ? 'bg-teal text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                </svg>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    {{-- Sidebar footer --}}
    <div class="px-4 py-4 border-t border-white/10 space-y-1">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-gray-300 hover:bg-white/10 hover:text-white transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Website</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm text-gray-300 hover:bg-red-500/20 hover:text-red-300 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</aside>

{{-- Mobile overlay --}}
<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 hidden lg:hidden!" onclick="toggleSidebar()"></div>

{{-- Main content --}}
<div class="flex-1 flex flex-col lg:ml-64 min-h-screen">

    {{-- Top header --}}
    <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
        <div class="flex items-center space-x-4">
            <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-navy">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div>
                <h1 class="text-xl font-bold text-navy">{{ $title ?? 'Admin Panel' }}</h1>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <span class="bg-teal/10 text-teal text-xs font-bold px-3 py-1 rounded-full">Admin</span>
        </div>
    </header>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <strong>Done!</strong> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Page content --}}
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>

</body>
</html>
