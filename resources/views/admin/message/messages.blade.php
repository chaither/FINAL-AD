<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin • Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: '#8a4813ff', secondary: '#944403ff', accent: '#8b4d05ff' }
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
        
        .hover-lift { 
            transition: transform .25s ease, box-shadow .25s ease; 
        }
        
        .hover-lift:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 10px 25px rgba(0,0,0,.1); 
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
        
        /* Message-specific styles */
        .message-card {
            transition: all 0.3s ease;
        }
        
        .message-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,.1);
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
<body class="bg-gray-50">
        <!-- Figma-style SVG Parallax Background -->
        <div class="absolute inset-0 -z-20 pointer-events-none select-none">
            <svg width="100%" height="100%" viewBox="0 0 1440 900" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <defs>
                    <linearGradient id="msg-grad1" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#ffe5b4"/>
                        <stop offset="100%" stop-color="#fff7e6"/>
                    </linearGradient>
                    <linearGradient id="msg-grad2" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#f7c873"/>
                        <stop offset="100%" stop-color="#fbeee0"/>
                    </linearGradient>
                </defs>
                <ellipse cx="350" cy="180" rx="320" ry="140" fill="url(#msg-grad1)" opacity="0.7" class="parallax-ell1"/>
                <ellipse cx="1200" cy="120" rx="200" ry="90" fill="url(#msg-grad2)" opacity="0.5" class="parallax-ell2"/>
                <ellipse cx="900" cy="700" rx="350" ry="120" fill="#fff7e6" opacity="0.4" class="parallax-ell3"/>
            </svg>
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
                        <span class="hidden sm:block text-lg font-semibold text-gray-800">Messages</span>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center gap-4 text-sm">
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50 transition-colors">Back to dashboard</a>
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
    
    <!-- Mobile Sidebar -->
    <aside id="sidebar" class="mobile-menu fixed left-0 top-0 h-full w-80 bg-white shadow-xl z-50 md:hidden">
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary text-sm">AD</div>
                    <span class="font-semibold text-gray-900">Menu</span>
                </div>
                <button id="menuClose" class="p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Close menu">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="p-4">
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg></span>
                    Dashboard
                </a>
                <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg></span>
                    Messages
                </a>
                <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/></svg></span>
                    Packages
                </a>
                <a href="{{ route('photos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg></span>
                    Photos
                </a>
                <a href="{{ route('feedback.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg></span>
                    Feedback
                </a>
            </nav>
        </div>
    </aside>
                
               
        </aside>

        <div class="relative max-w-6xl mx-auto p-6">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif
            
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-primary drop-shadow-sm flex items-center gap-2">
                    <svg class="w-6 h-6 md:w-7 md:h-7 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 10.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 10.5l-9 5-9-5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Messages
                </h1>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <button id="openSearchModal" class="px-4 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white shadow hover:scale-105 transition text-center w-full sm:w-auto">Search</button>
                    <div class="text-sm text-gray-500 bg-white/80 px-4 py-2 rounded-xl shadow border border-gray-200 text-center w-full sm:w-auto">Total: {{ $messages->total() }}</div>
                </div>
        <!-- Search Modal -->
        <div id="searchModal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close-search></div>
            <div class="relative max-w-md mx-auto mt-24 bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl ring-1 ring-primary/10 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-primary/20 to-secondary/30 rounded-full blur-2xl z-0 parallax-float" data-speed="0.18"></div>
                <div class="relative p-6 z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-primary">Search Messages</h2>
                        <button class="text-gray-500 hover:text-gray-700" data-close-search aria-label="Close">✕</button>
                    </div>
                    <form method="GET" action="" class="space-y-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1" for="search_name">Name</label>
                            <input type="text" id="search_name" name="name" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" placeholder="Enter name">
                        </div>
                        <div class="relative">
                            <label class="block text-xs text-gray-500 mb-1" for="search_event">Event</label>
                            <input type="text" id="search_event" name="event" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" placeholder="Select event type" autocomplete="off">
                            <div id="eventOptions" class="absolute left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-20 hidden">
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Wedding">Wedding</div>
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Corporate">Corporate</div>
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Birthday">Birthday</div>
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Other">Other</div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1" for="search_date">Date</label>
                            <input type="date" id="search_date" name="date" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                        </div>
                        <div class="flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white">Search</button>
                            <button type="button" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50" data-close-search>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>

            <div class="relative bg-white/95 backdrop-blur-xl ring-1 ring-primary/10 rounded-3xl shadow-2xl overflow-hidden px-2 py-6 md:p-8" style="box-shadow:0 8px 40px 0 rgba(140,80,20,0.10);">
                <!-- Show current search criteria and Clear All button -->
                @if(request('name') || request('event') || request('date'))
                    <div class="flex flex-wrap items-center justify-between mb-4 gap-2 bg-primary/5 px-4 py-3 rounded-xl border border-primary/10">
                        <div class="text-sm text-primary flex flex-wrap gap-3 items-center">
                            <span class="font-semibold">Search:</span>
                            @if(request('name'))
                                <span class="inline-flex items-center bg-primary/10 rounded px-2 py-1 mr-1">
                                    Name: <span class="font-bold ml-1">{{ request('name') }}</span>
                                    <a href="{{ route('messages.index', array_filter(request()->except('name'))) }}" class="ml-2 text-xs text-primary hover:text-red-600 font-bold" title="Remove name filter">×</a>
                                </span>
                            @endif
                            @if(request('event'))
                                <span class="inline-flex items-center bg-primary/10 rounded px-2 py-1 mr-1">
                                    Event: <span class="font-bold ml-1">{{ request('event') }}</span>
                                    <a href="{{ route('messages.index', array_filter(request()->except('event'))) }}" class="ml-2 text-xs text-primary hover:text-red-600 font-bold" title="Remove event filter">×</a>
                                </span>
                            @endif
                            @if(request('date'))
                                <span class="inline-flex items-center bg-primary/10 rounded px-2 py-1 mr-1">
                                    Date: <span class="font-bold ml-1">{{ request('date') }}</span>
                                    <a href="{{ route('messages.index', array_filter(request()->except('date'))) }}" class="ml-2 text-xs text-primary hover:text-red-600 font-bold" title="Remove date filter">×</a>
                                </span>
                            @endif
                        </div>
                        <a href="{{ route('messages.index') }}" class="ml-auto px-3 py-1.5 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white text-xs font-semibold shadow hover:scale-105 transition">Clear All</a>
                    </div>
                @endif
                <!-- Parallax floating shapes -->
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-br from-primary/20 to-secondary/30 rounded-full blur-2xl z-0 parallax-float" data-speed="0.2"></div>
                <div class="absolute -bottom-16 right-10 w-56 h-56 bg-gradient-to-br from-accent/20 to-primary/10 rounded-full blur-3xl z-0 parallax-float" data-speed="0.3"></div>
                <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-gradient-to-br from-secondary/20 to-accent/20 rounded-full blur-2xl z-0 parallax-float" data-speed="0.15"></div>

                <div class="relative z-10 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-primary/10 to-secondary/10">
                            <tr>
                                <th class="px-2 md:px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Name</th>
                                <th class="hidden sm:table-cell px-2 md:px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Email</th>
                                <th class="hidden md:table-cell px-2 md:px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Phone</th>
                                <th class="px-2 md:px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Event</th>
                                <th class="hidden lg:table-cell px-2 md:px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Created</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($messages as $msg)
                                <tr class="hover:bg-primary/5 transition message-card">
                                    <td class="px-2 md:px-4 py-3 whitespace-nowrap">
                                        <button type="button"
                                            class="open-message text-black hover:underline font-semibold text-sm md:text-base"
                                            data-id="{{ $msg->id }}"
                                            data-name="{{ $msg->first_name }} {{ $msg->last_name }}"
                                            data-email="{{ $msg->email }}"
                                            data-phone="{{ $msg->phone }}"
                                            data-event="{{ $msg->event_type }}"
                                            data-message="{{ e($msg->message) }}"
                                            data-created="{{ $msg->created_at->format('Y-m-d H:i') }}">
                                            {{ $msg->first_name }} {{ $msg->last_name }}
                                        </button>
                                        <!-- Mobile: Show email below name -->
                                        <div class="sm:hidden text-xs text-gray-500 mt-1">
                                            <a href="mailto:{{ $msg->email }}" class="text-primary hover:underline">{{ $msg->email }}</a>
                                        </div>
                                    </td>
                                    <td class="hidden sm:table-cell px-2 md:px-4 py-3 whitespace-nowrap">
                                        <a href="mailto:{{ $msg->email }}" class="text-primary hover:underline text-sm">{{ $msg->email }}</a>
                                    </td>
                                    <td class="hidden md:table-cell px-2 md:px-4 py-3 whitespace-nowrap text-sm">{{ $msg->phone }}</td>
                                    <td class="px-2 md:px-4 py-3 whitespace-nowrap">
                                        <span class="text-sm">{{ $msg->event_type }}</span>
                                        <!-- Mobile: Show created date below event -->
                                        <div class="lg:hidden text-xs text-gray-500 mt-1">{{ $msg->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="hidden lg:table-cell px-2 md:px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $msg->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                                        <div class="mx-auto w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.94 6.34A2 2 0 014.6 5h10.8a2 2 0 011.66.94L10 11.5 2.94 6.34zM2 7.92V14a2 2 0 002 2h12a2 2 0 002-2V7.92l-7.4 4.93a2 2 0 01-2.2 0L2 7.92z"/></svg>
                                        </div>
                                        No messages yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">{{ $messages->links() }}</div>
        </div>

        <!-- Message Modal -->
        <div id="messageModal" class="fixed inset-0 z-[70] hidden">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close-modal></div>
            <div class="relative max-w-2xl mx-auto mt-20 bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl ring-1 ring-primary/10 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-primary/20 to-secondary/30 rounded-full blur-2xl z-0 parallax-float" data-speed="0.18"></div>
                <div class="relative p-6 z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-xs uppercase tracking-wider text-gray-500">Message from</div>
                            <h3 class="text-2xl font-bold text-gray-800" id="modalName">Name</h3>
                        </div>
                        <button class="text-gray-500 hover:text-gray-700" data-close-modal aria-label="Close">✕</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Email</div>
                            <div class="font-medium"><a id="modalEmail" class="text-primary hover:underline" href="#"></a></div>
                        </div>
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Phone</div>
                            <div class="font-medium" id="modalPhone">—</div>
                        </div>
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Event</div>
                            <div class="font-medium" id="modalEvent">—</div>
                        </div>
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Received</div>
                            <div class="font-medium" id="modalCreated">—</div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-5 ring-1 ring-gray-200 max-h-[60vh] overflow-y-auto">
                        <div class="text-xs text-gray-500 mb-2">Message</div>
                        <p class="leading-relaxed text-gray-800 whitespace-pre-wrap break-words select-text" id="modalMessage"></p>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <!-- Delete Button -->
                        <button id="modalDelete" type="button" class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition-colors">Delete Message</button>
                        <!-- Save Note Button -->
                        <button id="modalSaveNote" type="button" class="px-4 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white">Save Note</button>
                        <a id="modalReply" href="#"></a>
                        <button class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50" data-close-modal>Close</button>
                        <!-- Hidden form for saving pin -->
                        <form id="saveNoteForm" action="{{ route('pins.store') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="title" id="pinTitle">
                            <input type="hidden" name="note" id="pinNote">
                        </form>
                        <!-- Hidden form for deleting message -->
                        <form id="deleteMessageForm" action="" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Mobile Menu Elements
                const sidebar = document.getElementById('sidebar');
                const sidebarOverlay = document.getElementById('sidebarOverlay');
                const menuToggle = document.getElementById('menuToggle');
                const menuClose = document.getElementById('menuClose');
                
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
            });

            // Search Modal logic and event dropdown
            document.addEventListener('DOMContentLoaded', () => {
                const searchModal = document.getElementById('searchModal');
                const openSearchBtn = document.getElementById('openSearchModal');
                const closeSearchEls = searchModal.querySelectorAll('[data-close-search]');
                openSearchBtn.addEventListener('click', () => {
                    searchModal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
                const closeSearch = () => { searchModal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); };
                closeSearchEls.forEach(el => el.addEventListener('click', closeSearch));
                window.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !searchModal.classList.contains('hidden')) closeSearch(); });

                // Event dropdown logic
                const eventInput = document.getElementById('search_event');
                const eventOptions = document.getElementById('eventOptions');
                let eventDropdownOpen = false;

                function showEventOptions() {
                    eventOptions.classList.remove('hidden');
                    eventDropdownOpen = true;
                }
                function hideEventOptions() {
                    setTimeout(() => {
                        eventOptions.classList.add('hidden');
                        eventDropdownOpen = false;
                    }, 120); // Delay to allow click
                }
                eventInput.addEventListener('focus', showEventOptions);
                eventInput.addEventListener('input', showEventOptions);
                eventInput.addEventListener('blur', hideEventOptions);
                eventInput.addEventListener('mouseenter', showEventOptions);
                eventInput.addEventListener('mouseleave', () => { if (!eventDropdownOpen) hideEventOptions(); });
                eventOptions.addEventListener('mouseenter', showEventOptions);
                eventOptions.addEventListener('mouseleave', hideEventOptions);
                eventOptions.querySelectorAll('[data-value]').forEach(opt => {
                    opt.addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        eventInput.value = this.dataset.value;
                        eventOptions.classList.add('hidden');
                        eventDropdownOpen = false;
                    });
                });
            });
            // Parallax effect for floating shapes
            document.addEventListener('mousemove', function(e) {
                document.querySelectorAll('.parallax-float').forEach(function(el) {
                    const speed = parseFloat(el.dataset.speed || 0.2);
                    const x = (window.innerWidth / 2 - e.clientX) * speed;
                    const y = (window.innerHeight / 2 - e.clientY) * speed;
                    el.style.transform = `translate(${x}px, ${y}px)`;
                });
            });

            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('messageModal');
                const openButtons = document.querySelectorAll('.open-message');
                const closeEls = modal.querySelectorAll('[data-close-modal]');
                const nameEl = document.getElementById('modalName');
                const emailEl = document.getElementById('modalEmail');
                const phoneEl = document.getElementById('modalPhone');
                const eventEl = document.getElementById('modalEvent');
                const createdEl = document.getElementById('modalCreated');
                const messageEl = document.getElementById('modalMessage');
                const replyEl = document.getElementById('modalReply');
                const saveNoteBtn = document.getElementById('modalSaveNote');
                const deleteBtn = document.getElementById('modalDelete');
                const saveNoteForm = document.getElementById('saveNoteForm');
                const deleteMessageForm = document.getElementById('deleteMessageForm');
                const pinTitleInput = document.getElementById('pinTitle');
                const pinNoteInput = document.getElementById('pinNote');

                const openModal = (data) => {
                    nameEl.textContent = data.name || 'Unknown';
                    emailEl.textContent = data.email || '—';
                    emailEl.href = data.email ? `mailto:${data.email}` : '#';
                    phoneEl.textContent = data.phone || '—';
                    eventEl.textContent = data.event || '—';
                    createdEl.textContent = data.created || '—';
                    messageEl.textContent = data.message || '';
                    if (data.email) replyEl.href = `mailto:${data.email}`; else replyEl.removeAttribute('href');
                    try { window.scrollTo({ top: 0, behavior: 'instant' }); } catch(_) { window.scrollTo(0, 0); }
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    
                    // Store current modal data for Save Note
                    // Title: Name (Event)
                    // Note: Message content
                    saveNoteBtn.dataset.title = data.name ? `${data.name} (${data.event || ''})` : 'Note';
                    // Combine message for display in pin note
                    saveNoteBtn.dataset.note = (data.message ? data.message : '') + (data.email ? `\nEmail: ${data.email}` : '') + (data.phone ? `\nPhone: ${data.phone}` : '');
                    
                    // Set up delete form action
                    if (data.id) {
                        deleteMessageForm.action = `/admin/messages/${data.id}`;
                        deleteBtn.dataset.messageId = data.id;
                    }
                };

                openButtons.forEach(btn => btn.addEventListener('click', () => {
                    openModal({
                        id: btn.dataset.id,
                        name: btn.dataset.name,
                        email: btn.dataset.email,
                        phone: btn.dataset.phone,
                        event: btn.dataset.event,
                        message: btn.dataset.message,
                        created: btn.dataset.created,
                    });
                }));

                const closeModal = () => { modal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); };
                closeEls.forEach(el => el.addEventListener('click', closeModal));
                window.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });

                // Save Note logic
                saveNoteBtn.addEventListener('click', function() {
                    // Fill hidden form with modal data
                    pinTitleInput.value = this.dataset.title || nameEl.textContent;
                    pinNoteInput.value = this.dataset.note || messageEl.textContent;
                    saveNoteForm.submit();
                });
                
                // Delete Message logic
                deleteBtn.addEventListener('click', function() {
                    const messageId = this.dataset.messageId;
                    const messageName = nameEl.textContent;
                    
                    if (confirm(`Are you sure you want to delete the message from ${messageName}? This action cannot be undone.`)) {
                        deleteMessageForm.submit();
                    }
                });
            });
        </script>
</body>
</html>


