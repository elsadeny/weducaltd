<x-layout title="Sign In">

<div class="flex w-full min-h-[calc(100vh-220px)]">

    {{-- Left branding panel --}}
    <div class="hidden lg:flex lg:w-1/2 bg-navy flex-col justify-between p-12 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/students-campus.jpg" alt="" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Weduca Apply Ltd" class="h-12 w-auto object-contain">
            </a>
        </div>
        <div class="relative z-10 text-white">
            <h2 class="text-4xl font-extrabold leading-tight mb-4">Your Gateway to<br><span class="text-teal">Global Education</span></h2>
            <p class="text-gray-300 text-lg mb-10 font-light">Track your application, upload documents and stay updated — all in one place.</p>
            <div class="flex space-x-10">
                <div><div class="text-3xl font-black text-teal">1M+</div><div class="text-gray-400 text-sm uppercase tracking-wider">Students</div></div>
                <div><div class="text-3xl font-black text-teal">1500+</div><div class="text-gray-400 text-sm uppercase tracking-wider">Institutions</div></div>
                <div><div class="text-3xl font-black text-teal">95%</div><div class="text-gray-400 text-sm uppercase tracking-wider">Success</div></div>
            </div>
        </div>
        <div class="relative z-10 text-gray-500 text-sm">
            © {{ date('Y') }} WeducaApply. All rights reserved.
        </div>
    </div>

    {{-- Right login form --}}
    <div class="flex flex-col justify-center w-full lg:w-1/2 px-8 py-12 sm:px-12 lg:px-16 xl:px-24">
        <div class="max-w-md w-full mx-auto">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Weduca Apply Ltd" class="h-12 w-auto object-contain">
                </a>
            </div>

            <h1 class="text-3xl font-bold text-navy mb-2">Welcome back</h1>
            <p class="text-gray-500 mb-8">Sign in to your account to continue</p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="email">Email address</label>
                    <input
                        id="email" name="email" type="email"
                        value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                        placeholder="you@example.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-sm font-semibold text-gray-700" for="password">Password</label>
                    </div>
                    <input
                        id="password" name="password" type="password"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                        placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-teal border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full bg-teal text-white font-semibold py-3.5 rounded-xl hover:bg-teal-light transition-all duration-300 shadow-md hover:shadow-lg">
                    Sign In
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-8">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-teal font-semibold hover:underline">Create one</a>
            </p>
        </div>
    </div>

</div>

</x-layout>
