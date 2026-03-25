<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account — WeducaApply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex items-center justify-center">

<div class="flex min-h-screen w-full">

    {{-- Left branding panel --}}
    <div class="hidden lg:flex lg:w-1/2 bg-navy flex-col justify-between p-12 relative overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/students-campus.jpg" alt="" class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-teal text-white rounded-lg flex justify-center items-center font-bold text-xl">W</div>
                <span class="font-bold text-2xl text-white tracking-tight">Weduca<span class="text-teal">Apply</span></span>
            </a>
        </div>
        <div class="relative z-10 text-white">
            <h2 class="text-4xl font-extrabold leading-tight mb-4">Start Your<br><span class="text-teal">Global Journey</span></h2>
            <p class="text-gray-300 text-lg mb-8 font-light">Create a free account to apply to top universities worldwide and track every step of your application.</p>
            <ul class="space-y-3 text-gray-300">
                <li class="flex items-center"><span class="w-6 h-6 rounded-full bg-teal/20 text-teal flex items-center justify-center mr-3 shrink-0">✓</span> Apply to 1500+ institutions</li>
                <li class="flex items-center"><span class="w-6 h-6 rounded-full bg-teal/20 text-teal flex items-center justify-center mr-3 shrink-0">✓</span> Track your application status in real-time</li>
                <li class="flex items-center"><span class="w-6 h-6 rounded-full bg-teal/20 text-teal flex items-center justify-center mr-3 shrink-0">✓</span> Upload documents securely</li>
            </ul>
        </div>
        <div class="relative z-10 text-gray-500 text-sm">© {{ date('Y') }} WeducaApply. All rights reserved.</div>
    </div>

    {{-- Right form panel --}}
    <div class="flex flex-col justify-center w-full lg:w-1/2 px-8 py-12 sm:px-12 lg:px-16 xl:px-24 overflow-y-auto">
        <div class="max-w-md w-full mx-auto">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                    <div class="w-10 h-10 bg-navy text-white rounded-lg flex justify-center items-center font-bold text-xl">W</div>
                    <span class="font-bold text-2xl text-navy">Weduca<span class="text-teal">Apply</span></span>
                </a>
            </div>

            <h1 class="text-3xl font-bold text-navy mb-2">Create your account</h1>
            <p class="text-gray-500 mb-8">Free to join. No credit card required.</p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input name="name" type="text" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                            placeholder="John Doe">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                        <input name="email" type="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                            placeholder="you@example.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Phone</label>
                            <input name="phone" type="tel" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                                placeholder="+250 700 000 000">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nationality</label>
                            <input name="nationality" type="text" value="{{ old('nationality') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                                placeholder="Rwandan">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                        <input name="password" type="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                            placeholder="Minimum 8 characters">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password <span class="text-red-500">*</span></label>
                        <input name="password_confirmation" type="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal focus:border-transparent transition text-gray-800"
                            placeholder="Repeat password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-teal text-white font-semibold py-3.5 rounded-xl hover:bg-teal-light transition-all duration-300 shadow-md hover:shadow-lg mt-2">
                    Create Account
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-teal font-semibold hover:underline">Sign in</a>
            </p>
        </div>
    </div>

</div>
</body>
</html>
