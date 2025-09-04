<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package - Admin Dashboard</title>
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
        body { font-family: 'Inter', sans-serif; }
        .parallax { background-image: linear-gradient(to bottom right, #fff7ed, #fffbeb); }
        .parallax::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(600px 200px at 10% 10%, rgba(138, 72, 19, 0.08), transparent),
                        radial-gradient(700px 250px at 90% 20%, rgba(148, 68, 3, 0.07), transparent),
                        radial-gradient(800px 300px at 40% 80%, rgba(139, 77, 5, 0.06), transparent);
            z-index: -1;
        }
        .parallax-element { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden; }
        .hover-lift { transition: transform .25s ease, box-shadow .25s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,.1); }
        
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
        .hamburger {
            transition: transform 0.3s ease;
        }
        .hamburger.open {
            transform: rotate(90deg);
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .packages-container {
                flex-direction: column;
            }
            .packages-sidebar {
                order: 2;
                width: 100%;
            }
            .packages-main {
                order: 1;
                width: 100%;
            }
        }
    </style>
</head>
<body class="parallax min-h-screen">
    <div class="parallax-element">
        <div class="absolute top-24 left-10 w-40 h-40 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 blur-2xl" data-speed=".25"></div>
        <div class="absolute bottom-24 right-20 w-56 h-56 rounded-full bg-gradient-to-br from-accent/20 to-primary/20 blur-3xl" data-speed=".15"></div>
    </div>
    
    <header class="sticky top-0 z-40 bg-white/70 backdrop-blur supports-[backdrop-filter]:bg-white/60 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="hidden md:block text-lg font-semibold text-gray-900">Edit Package</span>
            </div>

            <!-- Right side: Desktop user info + Mobile menu button -->
            <div class="flex items-center gap-2">
                <!-- Desktop User Info -->
                <div class="hidden md:flex items-center gap-4 text-sm">
                    <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Logout</button>
                    </form>
                </div>

                <!-- Mobile Menu Button -->
                <button id="menuToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Toggle menu" aria-expanded="false">
                    <div class="hamburger w-6 h-6 flex flex-col justify-center items-center">
                        <span class="block w-5 h-0.5 bg-gray-700 mb-1 transition-all"></span>
                        <span class="block w-5 h-0.5 bg-gray-700 mb-1 transition-all"></span>
                        <span class="block w-5 h-0.5 bg-gray-700 transition-all"></span>
                    </div>
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
            <div class="mb-4 pb-4 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">A</div>
                    <div>
                        <div class="font-medium text-gray-900">{{ auth()->user()->name }}</div>
                        <div class="text-sm text-gray-500">Administrator</div>
                    </div>
                </div>
            </div>
            
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg></span>
                    Dashboard
                </a>
                <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg></span>
                    Messages
                </a>
                <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium text-sm">
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
                <a href="{{ route('pins.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 012 0v5h4a1 1 0 010 2h-4v5a1 1 0 11-2 0V9H5a1 1 0 010-2h4V2z"/></svg></span>
                    Pins
                </a>
            </nav>
            
            <div class="mt-6 pt-4 border-t border-gray-200">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-50 text-red-600 text-sm">
                        <span class="inline-flex w-5"><svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/></svg></span>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Desktop Sidebar -->
    <aside class="hidden md:block w-64 shrink-0 packages-sidebar">
        <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-2xl p-3 sticky top-24">
            <a href="{{ route('admin.dashboard') }}" class="w-full mb-2 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-primary via-secondary to-accent block text-center">Dashboard</a>
            <nav class="text-sm">
                <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 6.34A2 2 0 014.6 5h10.8a2 2 0 011.66.94L10 11.5 2.94 6.34zM2 7.92V14a2 2 0 002 2h12a2 2 0 002-2V7.92l-7.4 4.93a2 2 0 01-2.2 0L2 7.92z"/></svg></span>
                    Inbox
                </a>
                <a href="{{ route('pins.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-accent" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 012 0v5h4a1 1 0 010 2h-4v5a1 1 0 11-2 0V9H5a1 1 0 010-2h4V2z"/></svg></span>
                    Pins
                </a>
                <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/></svg></span>
                    Packages
                </a>
            </nav>
        </div>
    </aside>

    <div class="max-w-7xl mx-auto px-4 py-6 flex gap-6 packages-container">
        <main class="packages-main flex-1">
            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-2xl p-8 hover-lift">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Package</h1>
                        <p class="text-gray-600 mt-1">Update the details for "{{ $package->name }}"</p>
                    </div>
                    <a href="{{ route('packages.index') }}" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Back to Packages
                    </a>
                </div>

                <form action="{{ route('packages.update', $package) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Package Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $package->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                placeholder="e.g., Basic Wedding Package">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">₱</span>
                                <input type="number" id="price" name="price" value="{{ old('price', $package->price) }}" step="0.01" min="0" required
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                    placeholder="299.99">
                            </div>
                            @error('price')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                            placeholder="Describe what's included in this package...">{{ old('description', $package->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                        <input type="text" id="duration" name="duration" value="{{ old('duration', $package->duration) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                            placeholder="e.g., 2 hours, Full day, Weekend">
                        @error('duration')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                        <div id="features-container" class="space-y-2">
                            @if($package->features && count($package->features) > 0)
                                @foreach($package->features as $feature)
                                    <div class="flex gap-2">
                                        <input type="text" name="features[]" value="{{ $feature }}"
                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                            placeholder="e.g., Unlimited photos, Custom backdrop, Props included">
                                        <button type="button" onclick="removeFeature(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex gap-2">
                                    <input type="text" name="features[]" 
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                        placeholder="e.g., Unlimited photos, Custom backdrop, Props included">
                                    <button type="button" onclick="removeFeature(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" onclick="addFeature()" class="mt-2 px-3 py-2 text-sm text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Add Feature
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $package->sort_order) }}" min="0"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                                placeholder="0">
                            <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary/20">
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Package is active and visible to clients</label>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary via-secondary to-accent text-white rounded-lg hover:shadow-lg transition-all duration-200 hover-lift">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Update Package
                        </button>
                        <a href="{{ route('packages.index') }}" class="px-6 py-3 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Functionality
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const menuToggle = document.getElementById('menuToggle');
            const menuClose = document.getElementById('menuClose');

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

            // Event listeners
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

            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeMobileMenu();
                }
            });

            // Close on window resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    closeMobileMenu();
                }
            });

            // Parallax Effect
            const elements = Array.from(document.querySelectorAll('.parallax-element > div'));
            const update = () => {
                const y = window.scrollY || window.pageYOffset;
                elements.forEach(el => {
                    const speed = parseFloat(el.dataset.speed || 0.2);
                    el.style.transform = `translateY(${-(y * speed)}px)`;
                });
                requestAnimationFrame(update);
            };
            update();
        });

        function addFeature() {
            const container = document.getElementById('features-container');
            const featureDiv = document.createElement('div');
            featureDiv.className = 'flex gap-2';
            featureDiv.innerHTML = `
                <input type="text" name="features[]" 
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors"
                    placeholder="e.g., Unlimited photos, Custom backdrop, Props included">
                <button type="button" onclick="removeFeature(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            `;
            container.appendChild(featureDiv);
        }

        function removeFeature(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>
