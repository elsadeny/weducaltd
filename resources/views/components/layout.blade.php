<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'WeducaApply' }} - International Education Consultancy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 flex flex-col min-h-screen">
@php
    $siteLogo      = \App\Models\Setting::get('logo');
    $siteName      = \App\Models\Setting::get('site_name', 'WeducaApply');
    $contactEmail  = \App\Models\Setting::get('contact_email', 'admissions.weducaapply@gmail.com');
    $contactPhone  = \App\Models\Setting::get('contact_phone', '+250 789 000 213');
    $contactAddr   = \App\Models\Setting::get('contact_address', 'Rubirizi, KK 225 Street, Kigali, Rwanda');
    $facebookUrl   = \App\Models\Setting::get('facebook_url', '#');
    $instagramUrl  = \App\Models\Setting::get('instagram_url', '#');
    $whatsappNum   = \App\Models\Setting::get('whatsapp_number', '250789000213');
    $whatsappNum   = preg_replace('/[^0-9]/', '', $whatsappNum);
@endphp

    <!-- Top Bar -->
    <div class="bg-navy text-white text-sm py-2 px-6 flex justify-between items-center hidden md:flex">
        <div class="flex items-center space-x-6">
            <span class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg> {{ $contactEmail }}</span>
            <span class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                    </path>
                </svg> {{ $contactPhone }}</span>
        </div>
        <div>
            <span class="opacity-80">{{ $contactAddr }}</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 shrink-0">
                        @if($siteLogo)
                            <img src="{{ Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="h-12 w-auto object-contain">
                        @else
                            <div
                                class="w-10 h-10 bg-navy text-white rounded-lg flex justify-center items-center font-bold text-xl relative overflow-hidden">
                                W
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-teal rounded-tl-full"></div>
                            </div>
                            <span class="font-bold text-2xl text-navy tracking-tight">Weduca<span
                                    class="text-teal">Apply</span></span>
                        @endif
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-teal font-medium transition duration-150">Home</a>
                    <a href="/#about" class="text-gray-600 hover:text-teal font-medium transition duration-150">About
                        Us</a>
                    <a href="/#services"
                        class="text-gray-600 hover:text-teal font-medium transition duration-150">Services</a>
                    <a href="/#destinations"
                        class="text-gray-600 hover:text-teal font-medium transition duration-150">Destinations</a>
                    <a href="/#contact"
                        class="text-gray-600 hover:text-teal font-medium transition duration-150">Contact</a>
                    @auth
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}"
                           class="text-gray-600 hover:text-teal font-medium transition duration-150 flex items-center space-x-1">
                            <span>My Portal</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline text-sm py-2.5">Sign In</a>
                    @endauth
                    <a href="{{ auth()->check() ? route('student.applications.create') : route('register') }}" class="btn-primary">Apply Now</a>
                </div>

                <!-- Mobile button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-btn" onclick="toggleMobileMenu()"
                        class="text-gray-500 hover:text-navy focus:outline-none p-2 rounded-lg transition-colors">
                        <svg id="menu-icon-open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="menu-icon-close" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white shadow-lg">
            <div class="px-4 py-4 space-y-1">
                <a href="/" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">Home</a>
                <a href="/#about" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">About Us</a>
                <a href="/#services" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">Services</a>
                <a href="/#destinations" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">Destinations</a>
                <a href="/#contact" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">Contact</a>
                @auth
                    <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">My Portal</a>
                @else
                    <a href="{{ route('login') }}" onclick="closeMobileMenu()" class="flex items-center px-4 py-3 rounded-xl text-gray-700 font-medium hover:bg-teal/5 hover:text-teal transition-colors">Sign In</a>
                @endauth
                <a href="{{ auth()->check() ? route('student.applications.create') : route('register') }}" onclick="closeMobileMenu()" class="btn-primary w-full justify-center mt-2">Apply Now</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-navy text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 shrink-0 mb-6">
                        <span class="font-bold text-2xl text-white tracking-tight">Weduca<span
                                class="text-teal">Apply</span></span>
                    </a>
                    <p class="text-gray-300 mb-6 text-sm">Empowering students to achieve their international education
                        dreams. We connect you with 1500+ universities worldwide.</p>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-white border-b border-gray-700 pb-2 inline-block">Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> Home</a></li>
                        <li><a href="/#about"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> About Us</a></li>
                        <li><a href="/#services"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> Services</a></li>
                        <li><a href="/#destinations"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> Destinations</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-white border-b border-gray-700 pb-2 inline-block">Services
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="/#services"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> University Admission</a></li>
                        <li><a href="/#services"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> Visa Processing</a></li>
                        <li><a href="/#services"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> Scholarship Help</a></li>
                        <li><a href="/#services"
                                class="text-gray-300 hover:text-teal transition-colors flex items-center"><span
                                    class="mr-2">&rsaquo;</span> Housing Support</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6 text-white border-b border-gray-700 pb-2 inline-block">Contact Us
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-start text-gray-300">
                            <svg class="h-6 w-6 text-teal mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $contactAddr }}</span>
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="h-5 w-5 text-teal mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{ $contactPhone }}</span>
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="h-5 w-5 text-teal mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $contactEmail }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} WeducaApply Ltd. All rights reserved. Powered by <a href="https://aphezis.com" target="_blank" class="text-teal hover:text-white transition-colors">aphezis.com</a></p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <a href="{{ route('privacy') }}"
                        class="text-gray-400 hover:text-teal text-sm transition-colors">Privacy Policy</a>
                    <a href="{{ $facebookUrl ?: '#' }}" class="text-gray-400 hover:text-teal"><span class="sr-only">Facebook</span><svg
                            class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg></a>
                    <a href="{{ $instagramUrl ?: '#' }}" class="text-gray-400 hover:text-teal"><span class="sr-only">Instagram</span><svg
                            class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg></a>
                    <a href="#" class="text-gray-400 hover:text-teal"><span class="sr-only">Twitter</span><svg
                            class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ $whatsappNum }}" target="_blank" rel="noopener noreferrer" class="whatsapp-float"
        aria-label="Chat with us on WhatsApp">
        <span class="whatsapp-tooltip">Chat with us!</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="whatsapp-icon">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
    </a>

    <style>
        /* ── Carousel heights (guaranteed, bypasses Tailwind build) ── */
        #about-carousel,
        #contact-carousel {
            height: 260px;   /* mobile */
        }
        @media (min-width: 640px) {
            #about-carousel,
            #contact-carousel {
                height: 380px; /* sm */
            }
        }
        @media (min-width: 1024px) {
            #about-carousel  { height: 500px; }
            #contact-carousel { height: 600px; }
        }

        [x-cloak] {
            display: none !important;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 32px;
            right: 32px;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: #25D366;
            color: #fff;
            border-radius: 50%;
            box-shadow: 0 6px 24px rgba(37, 211, 102, 0.45);
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 32px rgba(37, 211, 102, 0.6);
        }

        .whatsapp-float::before {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(37, 211, 102, 0.4);
            animation: wa-pulse 2s ease-out infinite;
        }

        /* ── Carousel slide visibility ──────────────────────────── */
        .carousel-slide {
            opacity: 1;
            transition: opacity 0.8s ease;
        }
        .carousel-slide.opacity-0 {
            opacity: 0;
        }

        @keyframes wa-pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        .whatsapp-icon {
            width: 32px;
            height: 32px;
            position: relative;
            z-index: 1;
        }

        .whatsapp-tooltip {
            position: absolute;
            right: 72px;
            background: #111;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            padding: 6px 14px;
            border-radius: 20px;
            opacity: 0;
            pointer-events: none;
            transform: translateX(8px);
            transition: opacity 0.2s, transform 0.2s;
        }

        .whatsapp-float:hover .whatsapp-tooltip {
            opacity: 1;
            transform: translateX(0);
        }
    </style>

    <script>
        // ── Auth Tabs ──────────────────────────────────────────────
        function switchAuthTab(tab) {
            const panels  = document.querySelectorAll('.auth-panel');
            const tabBtns = document.querySelectorAll('.auth-tab');
            const pill    = document.getElementById('auth-tab-pill');

            panels.forEach(p => p.classList.add('hidden'));

            tabBtns.forEach(b => {
                b.classList.remove('text-teal');
                b.classList.add('text-gray-400');
            });

            document.getElementById('panel-' + tab)?.classList.remove('hidden');

            const btn = document.getElementById('tab-' + tab);
            if (btn) {
                btn.classList.remove('text-gray-400');
                btn.classList.add('text-teal');
            }

            if (pill) pill.style.left = (tab === 'register') ? '50%' : '0';
        }

        // ── Generic image carousel factory ────────────────────────
        function makeCarousel(slideClass, dotClass, interval) {
            const slides = document.querySelectorAll('.' + slideClass);
            const dots = document.querySelectorAll('.' + dotClass);
            if (!slides.length) return;
            let current = 0;

            function goTo(idx) {
                slides[current].classList.add('opacity-0');
                dots[current].classList.remove('w-6', 'bg-white', 'bg-teal');
                dots[current].classList.add('w-2', 'bg-white/50');

                current = (idx + slides.length) % slides.length;

                slides[current].classList.remove('opacity-0');
                dots[current].classList.remove('w-2', 'bg-white/50');
                dots[current].classList.add('w-6', 'bg-white');
            }

            dots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));
            setInterval(() => goTo(current + 1), interval);
        }

        // ── Mission text rotation ──────────────────────────────────
        function makeMissionCarousel() {
            const panels = document.querySelectorAll('.mission-panel');
            const dots = document.querySelectorAll('.mission-dot');
            if (!panels.length) return;
            let current = 0;

            function goTo(idx) {
                panels[current].classList.add('hidden');
                dots[current].classList.remove('w-6', 'bg-teal');
                dots[current].classList.add('w-2', 'bg-gray-300');
                current = (idx + panels.length) % panels.length;
                panels[current].classList.remove('hidden');
                dots[current].classList.remove('w-2', 'bg-gray-300');
                dots[current].classList.add('w-6', 'bg-teal');
            }

            dots.forEach((d, i) => d.addEventListener('click', () => goTo(i)));
            setInterval(() => goTo(current + 1), 6000);
        }

        // ── Scroll-reveal ──────────────────────────────────────────
        document.addEventListener("DOMContentLoaded", function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

            document.querySelectorAll('.animate-on-scroll').forEach((el) => {
                observer.observe(el);
            });

            // Boot carousels
            makeCarousel('about-slide', 'about-dot', 5000);
            makeCarousel('contact-slide', 'contact-dot', 4000);
            makeMissionCarousel();
        });

        // ── Mobile menu ────────────────────────────────────────────
        function toggleMobileMenu() {
            const menu  = document.getElementById('mobile-menu');
            const open  = document.getElementById('menu-icon-open');
            const close = document.getElementById('menu-icon-close');
            const isHidden = menu.classList.contains('hidden');
            menu.classList.toggle('hidden', !isHidden);
            open.classList.toggle('hidden', isHidden);
            close.classList.toggle('hidden', !isHidden);
        }
        function closeMobileMenu() {
            document.getElementById('mobile-menu').classList.add('hidden');
            document.getElementById('menu-icon-open').classList.remove('hidden');
            document.getElementById('menu-icon-close').classList.add('hidden');
        }
    </script>
</body>

</html>