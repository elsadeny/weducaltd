<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'User Portal' }} — WeducaApply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 flex min-h-screen">

{{-- Sidebar --}}
<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-navy flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    {{-- Logo --}}
    <div class="flex items-center space-x-3 px-6 py-5 border-b border-white/10">
        <img src="{{ asset('images/logo.png') }}" alt="Weduca Apply Ltd" class="h-10 w-auto object-contain shrink-0">
        <span class="font-bold text-white text-base tracking-tight">Weduca Apply Ltd</span>
    </div>

    {{-- User badge --}}
    <div class="px-4 py-4 border-b border-white/10">
        <div class="flex items-center space-x-3 bg-white/5 rounded-xl px-3 py-3">
            <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <div class="text-white text-sm font-semibold truncate">{{ Auth::user()->name }}</div>
                <div class="text-gray-400 text-xs truncate">User</div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
        @php
            $navItems = [
                ['route' => 'student.dashboard',            'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',  'label' => 'Dashboard'],
                ['route' => 'student.applications.index',   'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',    'label' => 'My Applications'],
                ['route' => 'student.applications.create',  'icon' => 'M12 4v16m8-8H4',                                                                                                                                         'label' => 'Apply Now'],
            ];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150
                      {{ request()->routeIs($item['route']) ? 'bg-indigo-600 text-white shadow-sm' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
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
            <h1 class="text-xl font-bold text-navy">{{ $title ?? 'User Portal' }}</h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('student.applications.create') }}"
               class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-full hover:bg-indigo-700 transition shadow-sm">
                + New Application
            </a>
        </div>
    </header>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <strong>Success!</strong> {{ session('success') }}
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
