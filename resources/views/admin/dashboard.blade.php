<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#8a4813ff',
              secondary: '#944403ff',
              accent: '#8b4d05ff',
            },
          }
        }
      }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Base Styles */
        body { 
            font-family: 'Inter', sans-serif; 
            perspective: 1200px; 
            perspective-origin: 50% 30%; 
        }
        
        /* Background & Parallax */
        .parallax { 
            background-image: linear-gradient(to bottom right, #fff7ed, #fffbeb); 
        }
        
        .parallax::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(600px 200px at 10% 10%, rgba(138, 72, 19, 0.08), transparent),
                        radial-gradient(700px 250px at 90% 20%, rgba(148, 68, 3, 0.07), transparent),
                        radial-gradient(800px 300px at 40% 80%, rgba(139, 77, 5, 0.06), transparent);
            z-index: -1;
        }
        
        .parallax-layer { 
            position: fixed; 
            inset: 0; 
            z-index: -1; 
            pointer-events: none; 
            overflow: hidden; 
        }
        
        /* Animations */
        .animate-on-scroll { 
            opacity: 0; 
            transform: translateY(16px); 
            transition: all .6s cubic-bezier(.2,.8,.2,1); 
        }
        
        .animate-on-scroll.animate-in { 
            opacity: 1; 
            transform: translateY(0); 
        }
        
        .mouse-parallax { 
            will-change: transform; 
        }
        
        .tilt { 
            will-change: transform; 
            transform-style: preserve-3d; 
            transition: transform .2s ease; 
        }
        
        .tilt:hover { 
            transition: transform .08s ease; 
        }
        
        .glow { 
            box-shadow: 0 10px 30px rgba(148, 68, 3, 0.08); 
        }
        
        /* Mobile Menu Styles */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .mobile-menu.open {
            transform: translateX(0);
        }
        
        .mobile-overlay {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .mobile-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        
        /* Hamburger Animation */
        .hamburger {
            transition: transform 0.3s ease;
        }
        
        .hamburger.open {
            transform: rotate(90deg);
        }
        
        /* Grid and Effects */
        .grid-overlay { 
            position: absolute; 
            inset: -10%; 
            background-image:
                linear-gradient(to right, rgba(148, 68, 3, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 68, 3, 0.04) 1px, transparent 1px);
            background-size: 48px 48px, 48px 48px; 
            opacity: .5; 
        }
        
        .noise-overlay { 
            position: absolute; 
            inset: 0; 
            background-image: radial-gradient(rgba(0,0,0,.06) 1px, transparent 1px); 
            background-size: 3px 3px; 
            mix-blend-mode: multiply; 
            opacity: .03; 
        }
        
        /* Keyframes */
        @keyframes floatSlow { 
            0%, 100% { transform: translateY(0) } 
            50% { transform: translateY(-8px) } 
        }
        
        @keyframes rotate3d { 
            from { transform: rotate(0deg) } 
            to { transform: rotate(360deg) } 
        }
        
        @keyframes gradientShift {
          0% { background-position: 0% 50%; }
          50% { background-position: 100% 50%; }
          100% { background-position: 0% 50%; }
        }
        
        /* Responsive Improvements */
        @media (max-width: 768px) {
            .mobile-stack {
                flex-direction: column;
            }
            
            .mobile-full {
                width: 100%;
            }
            
            .mobile-p-4 {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="parallax min-h-screen">
    <div class="parallax-layer">
        <div class="parallax-element absolute top-20 left-10 w-40 h-40 rounded-full bg-gradient-to-br from-primary to-secondary opacity-20 blur-2xl" data-speed="0.2"></div>
        <div class="parallax-element absolute top-1/3 right-20 w-32 h-32 rounded-full bg-gradient-to-br from-accent to-primary opacity-15 blur-2xl" data-speed="0.35"></div>
        <div class="parallax-element absolute bottom-24 left-1/3 w-56 h-56 rounded-full bg-gradient-to-br from-secondary to-accent opacity-10 blur-3xl" data-speed="0.15"></div>
        <div class="mouse-parallax absolute top-28 right-10 w-24 h-24 rounded-xl bg-gradient-to-br from-primary/30 to-accent/30 blur-xl" data-mouse-speed="18" style="animation: floatSlow 8s ease-in-out infinite"></div>
        <div class="mouse-parallax absolute bottom-10 left-10 w-20 h-20 rounded-full bg-gradient-to-br from-secondary/25 to-primary/25 blur-xl" data-mouse-speed="24" style="animation: floatSlow 10s ease-in-out infinite"></div>
        <svg class="parallax-element absolute top-10 right-1/3 w-24 h-24 opacity-10" viewBox="0 0 64 64" fill="none" data-speed="0.25" style="animation: rotate3d 24s linear infinite">
            <circle cx="32" cy="32" r="20" stroke="currentColor" class="text-primary" stroke-width="3" />
            <circle cx="32" cy="32" r="28" stroke="currentColor" class="text-secondary" stroke-width="2" />
        </svg>
        <div class="parallax-element grid-overlay" data-speed="0.05"></div>
        <div class="noise-overlay"></div>
        <div class="parallax-element absolute -top-16 left-1/2 -translate-x-1/2 w-[44rem] h-[44rem] rounded-full bg-gradient-to-tr from-primary/10 via-secondary/10 to-accent/10 blur-3xl opacity-70" data-speed="0.08"></div>
    </div>
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">
                        AD
                    </div>
                    <span class="hidden sm:block text-lg font-semibold text-gray-800">Admin Dashboard</span>
                </div>
                
                <!-- Desktop User Info -->
                <div class="hidden md:flex items-center gap-4 text-sm">
                <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                        <button class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 transition-colors">
                            Logout
                        </button>
                </form>
                </div>
                
                <!-- Mobile Menu Toggle -->
                <button id="menuToggle" class="md:hidden inline-flex items-center justify-center p-2 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 transition-colors hamburger" aria-label="Toggle menu" aria-expanded="false">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 4a1 1 0 100 2h12a1 1 0 100-2H4z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="mobile-overlay fixed inset-0 bg-black/50 z-40 md:hidden"></div>
    
    <!-- Main Layout -->
    <div class="max-w-7xl mx-auto px-4 py-6 flex gap-6">
        <!-- Sidebar -->
        <aside id="sidebar" class="mobile-menu fixed md:static md:translate-x-0 top-0 bottom-0 left-0 w-64 z-50 md:z-auto bg-white/95 md:bg-transparent backdrop-blur-md md:backdrop-blur-0 md:block">
            <div class="bg-white/90 md:bg-white/80 backdrop-blur-md ring-1 ring-gray-200 rounded-2xl p-4 md:p-3 h-full md:h-auto md:sticky md:top-24">
                <!-- Mobile Header -->
                <div class="md:hidden mb-4 flex items-center justify-between border-b border-gray-200 pb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary text-sm">
                            AD
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">Administrator</div>
                        </div>
                    </div>
                    <button id="menuClose" class="inline-flex items-center justify-center p-2 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 transition-colors" aria-label="Close menu">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Notifications Button -->
                <button class="w-full mb-4 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-primary via-secondary to-accent hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        Notifications
                    </div>
                </button>
                
                <!-- Navigation -->
                <nav class="space-y-1">
                    <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/5 text-gray-700 transition-colors group">
                        <span class="inline-flex w-5">
                            <svg class="w-5 h-5 text-primary group-hover:text-primary/80" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.94 6.34A2 2 0 014.6 5h10.8a2 2 0 011.66.94L10 11.5 2.94 6.34zM2 7.92V14a2 2 0 002 2h12a2 2 0 002-2V7.92l-7.4 4.93a2 2 0 01-2.2 0L2 7.92z"/>
                            </svg>
                        </span>
                        <span class="font-medium">Inbox</span>
                    </a>
                    
                    <a href="{{ route('pins.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/5 text-gray-700 transition-colors group">
                        <span class="inline-flex w-5">
                            <svg class="w-5 h-5 text-accent group-hover:text-accent/80" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 012 0v5h4a1 1 0 010 2h-4v5a1 1 0 11-2 0V9H5a1 1 0 010-2h4V2z"/>
                            </svg>
                        </span>
                        <span class="font-medium">Pins</span>
                    </a>
                    
                    <a href="{{ route('stats.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/5 text-gray-700 transition-colors group">
                        <span class="inline-flex w-5">
                            <svg class="w-5 h-5 text-secondary group-hover:text-secondary/80" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 10a1 1 0 011-1h2v6H4a1 1 0 01-1-1v-4zm6-4a1 1 0 00-1 1v10h4V7a1 1 0 00-1-1H9zm6 6a1 1 0 00-1 1v4h2a1 1 0 001-1v-3a1 1 0 00-1-1h-1z"/>
                            </svg>
                        </span>
                        <span class="font-medium">Status</span>
                    </a>
                    
                    <a href="{{ route('contact-info.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/5 text-gray-700 transition-colors group">
                        <span class="inline-flex w-5">
                            <svg class="w-5 h-5 text-secondary group-hover:text-secondary/80" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zM20 8h-4v2h4V8zm0 4h-4v2h4v-2z"/>
                            </svg>
                        </span>
                        <span class="font-medium">Contact Information</span>
                    </a>
                </nav>
                
                <!-- Mobile Logout -->
                <div class="md:hidden mt-6 pt-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="w-full px-3 py-2.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 text-sm font-medium transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 space-y-6 md:space-y-8">
            <!-- Welcome Hero Section -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-white/90 via-amber-50/70 to-orange-50/70 ring-1 ring-primary/10 shadow-xl p-6 md:p-8 animate-on-scroll">
                <!-- Background Effects -->
            <div class="pointer-events-none select-none">
                    <div class="parallax-element absolute -top-8 -left-8 w-32 h-32 md:w-40 md:h-40 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 blur-3xl opacity-70" data-speed="0.08"></div>
                    <div class="parallax-element absolute -bottom-10 -right-10 w-40 h-40 md:w-56 md:h-56 rounded-full bg-gradient-to-br from-accent/20 to-primary/20 blur-3xl opacity-60" data-speed="0.12"></div>
                    <div class="mouse-parallax absolute top-8 right-8 w-12 h-12 md:w-16 md:h-16 rounded-xl bg-gradient-to-br from-secondary/20 to-accent/20 blur-xl" data-mouse-speed="18"></div>
            </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-4 md:gap-6">
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-xl md:text-2xl lg:text-3xl font-extrabold bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent">
                        Welcome back, {{ auth()->user()->name }}
                    </h1>
                        <p class="mt-2 text-sm md:text-base text-gray-600">Here's what's happening with your mirror photo booth business today.</p>
                        <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-2 text-xs">
                        <span class="px-3 py-1 rounded-full bg-primary/10 text-primary ring-1 ring-primary/20">Dashboard</span>
                        <span class="px-3 py-1 rounded-full bg-secondary/10 text-secondary ring-1 ring-secondary/20">Analytics</span>
                        <span class="px-3 py-1 rounded-full bg-accent/10 text-accent ring-1 ring-accent/20">Operations</span>
                    </div>
                </div>
                <div class="shrink-0 relative">
                        <div class="relative w-24 h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 rounded-2xl bg-white/70 backdrop-blur ring-1 ring-gray-200 flex items-center justify-center shadow-lg">
                            <img src="/image/nalbu.png" alt="AD Logo" class="w-16 h-16 md:w-20 md:h-20 object-contain">
                            <div class="absolute -top-2 -right-2 w-5 h-5 md:w-6 md:h-6 rounded-full bg-gradient-to-br from-primary to-secondary animate-pulse"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Stats Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                <div class="bg-white/80 backdrop-blur ring-1 ring-primary/10 rounded-xl shadow-xl p-4 md:p-6 flex items-center gap-3 md:gap-4 tilt glow animate-on-scroll">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-2 2H7l-4 3v-3H4a2 2 0 01-2-2V5z"/>
                        </svg>
            </div>
                    <div class="min-w-0">
                        <div class="text-xs md:text-sm text-gray-500">Total Messages</div>
                        <div class="text-lg md:text-2xl font-bold">{{ $totalMessages }}</div>
                </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur ring-1 ring-secondary/10 rounded-xl shadow-xl p-4 md:p-6 flex items-center gap-3 md:gap-4 tilt glow animate-on-scroll">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9V5h2v4H9zm0 2h2v2H9v-2z"/>
                        </svg>
            </div>
                    <div class="min-w-0">
                        <div class="text-xs md:text-sm text-gray-500">Today's Messages</div>
                        <div class="text-lg md:text-2xl font-bold">{{ $todaysMessages }}</div>
                </div>
                </div>
                
                <div class="bg-white/80 backdrop-blur ring-1 ring-accent/10 rounded-xl shadow-xl p-4 md:p-6 flex items-center gap-3 md:gap-4 tilt glow animate-on-scroll sm:col-span-2 lg:col-span-1">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-accent/10 text-accent flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 2a1 1 0 000 2h8a1 1 0 100-2H6zM3 6a1 1 0 000 2h14a1 1 0 100-2H3zm3 4a1 1 0 000 2h8a1 1 0 100-2H6zm-3 4a1 1 0 000 2h14a1 1 0 100-2H3z"/>
                        </svg>
            </div>
                    <div class="min-w-0">
                        <div class="text-xs md:text-sm text-gray-500">This Week</div>
                        <div class="text-lg md:text-2xl font-bold">{{ $weeksMessages }}</div>
                </div>
            </div>
        </div>

            <!-- Photobooth Hub Section -->
            <section class="bg-white/80 backdrop-blur-xl ring-1 ring-primary/5 rounded-2xl shadow-xl p-6 md:p-8 animate-on-scroll">
                <div class="mb-6">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-900">Photobooth Hub</h2>
                    <p class="text-sm md:text-base text-gray-500 mt-1">Quick access to your photobooth business tools and assets.</p>
            </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                    <!-- Feedback & Rates Card -->
                    <div class="rounded-xl ring-1 ring-gray-200 p-4 md:p-5 bg-gradient-to-br from-white to-primary/5 tilt hover:shadow-lg transition-shadow">
                    <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h5.5a.5.5 0 00.5-.5V13a2 2 0 012-2h3.5a.5.5 0 00.5-.5V5a2 2 0 00-2-2H4z"/>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900">Feedbacks & Rates</div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Manage client feedback, ratings, and service rates.</p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('feedback.index') }}" class="px-3 py-2 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 text-sm text-center transition-colors">
                                Manage Feedback
                            </a>
                            <a href="/" target="_blank" class="px-3 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white text-sm text-center hover:shadow-md transition-shadow">
                                View Public Feedback
                            </a>
                        </div>
                    </div>
                    
                    <!-- Packages & Pricing Card -->
                    <div class="rounded-xl ring-1 ring-gray-200 p-4 md:p-5 bg-gradient-to-br from-white to-secondary/5 tilt hover:shadow-lg transition-shadow">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/>
                                </svg>
                    </div>
                            <div class="font-medium text-gray-900">Packages & Pricing</div>
                </div>
                        <p class="text-sm text-gray-600 mb-4">Standardize your photobooth packages and share quotes fast.</p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('packages.index') }}" class="px-3 py-2 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 text-sm text-center transition-colors">
                                Manage Packages
                            </a>
                            <a href="{{ route('packages.create') }}" class="px-3 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white text-sm text-center hover:shadow-md transition-shadow">
                                Add New Package
                            </a>
                        </div>
                    </div>
                    
                    <!-- Marketing & Gallery Card -->
                    <div class="rounded-xl ring-1 ring-gray-200 p-4 md:p-5 bg-gradient-to-br from-white to-accent/5 tilt hover:shadow-lg transition-shadow lg:col-span-1">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-lg bg-accent/10 text-accent flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 3a2 2 0 00-2 2v10l4-2 4 2 4-2 4 2V5a2 2 0 00-2-2H4z"/>
                                </svg>
                    </div>
                            <div class="font-medium text-gray-900">Marketing & Gallery</div>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">Keep your portfolio fresh and share highlights with clients.</p>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('photos.index') }}" class="px-3 py-2 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 text-sm text-center transition-colors">
                                Manage Photos
                            </a>
                            <a href="/" target="_blank" class="px-3 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white text-sm text-center hover:shadow-md transition-shadow">
                                View Public Page
                            </a>
                    </div>
                    </div>
                </div>
        </section>

        </main>
    </div>
    <script>
      document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Elements
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const menuToggle = document.getElementById('menuToggle');
        const menuClose = document.getElementById('menuClose');
            
            // Animation Elements
            const parallaxElements = Array.from(document.querySelectorAll('.parallax-element'));
            const mouseParallaxElements = Array.from(document.querySelectorAll('.mouse-parallax'));
            const tiltElements = Array.from(document.querySelectorAll('.tilt'));
            
            // Mouse tracking
        let mouseX = 0, mouseY = 0;
            
            // Mobile Menu Functions
            const openMobileMenu = () => {
                if (!sidebar || !sidebarOverlay || !menuToggle) return;
                
                sidebar.classList.add('open');
                sidebarOverlay.classList.add('open');
                menuToggle.classList.add('open');
                menuToggle.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            };
            
            const closeMobileMenu = () => {
                if (!sidebar || !sidebarOverlay || !menuToggle) return;
                
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
                menuToggle.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            };
            
            // Mobile Menu Event Listeners
            if (menuToggle) {
                menuToggle.addEventListener('click', (e) => {
                    e.preventDefault();
                    openMobileMenu();
                });
            }
            
            if (menuClose) {
                menuClose.addEventListener('click', (e) => {
                    e.preventDefault();
                    closeMobileMenu();
                });
            }
            
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeMobileMenu);
            }
            
            // Close menu on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeMobileMenu();
                }
            });
            
            // Close menu on window resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    closeMobileMenu();
                }
            });
            
            // Parallax Animation
            const updateParallax = () => {
                const scrollY = window.scrollY || window.pageYOffset;
                
                parallaxElements.forEach(element => {
                    const speed = parseFloat(element.dataset.speed || 0.2);
                    element.style.transform = `translateY(${-(scrollY * speed)}px)`;
                });
                
                mouseParallaxElements.forEach(element => {
                    const mouseSpeed = parseFloat(element.dataset.mouseSpeed || 20);
                    element.style.transform = `translate(${mouseX / mouseSpeed}px, ${mouseY / mouseSpeed}px)`;
                });
                
                requestAnimationFrame(updateParallax);
            };
            
            // Start parallax animation
            updateParallax();
            
            // Mouse tracking for parallax and tilt effects
            window.addEventListener('mousemove', (e) => {
                const centerX = window.innerWidth / 2;
                const centerY = window.innerHeight / 2;
                mouseX = e.clientX - centerX;
                mouseY = e.clientY - centerY;
                
                // Tilt effect for cards
                const maxTilt = 8;
                tiltElements.forEach(element => {
                    const rect = element.getBoundingClientRect();
                    const elementCenterX = rect.left + rect.width / 2;
                    const elementCenterY = rect.top + rect.height / 2;
                    
                    const deltaX = e.clientX - elementCenterX;
                    const deltaY = e.clientY - elementCenterY;
                    
                    const tiltX = (deltaY / rect.height) * maxTilt;
                    const tiltY = (deltaX / rect.width) * -maxTilt;
                    
                    if (Math.abs(deltaX) < rect.width && Math.abs(deltaY) < rect.height) {
                        element.style.transform = `rotateX(${tiltX}deg) rotateY(${tiltY}deg) scale3d(1.02, 1.02, 1.02)`;
                    }
                });
            });
            
            // Reset tilt on mouse leave
            tiltElements.forEach(element => {
                element.addEventListener('mouseleave', () => {
                    element.style.transform = 'rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
                });
            });
            
            // Intersection Observer for scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            };

        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('animate-in');
              observer.unobserve(entry.target);
            }
          });
            }, observerOptions);
            
            // Observe all elements with animate-on-scroll class
            document.querySelectorAll('.animate-on-scroll').forEach(element => {
                observer.observe(element);
            });
            
            // Performance optimization: Reduce animations on mobile
            const isMobile = window.innerWidth < 768;
            if (isMobile) {
                // Disable some heavy animations on mobile
                tiltElements.forEach(element => {
                    element.style.willChange = 'auto';
                });
            }
      });
    </script>
</body>
</html>


