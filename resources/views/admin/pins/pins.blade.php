<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin • Pins</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: '#8a4813ff', secondary: '#944403ff', accent: '#8b4d05ff' },
          }
        }
      }
    </script>
    <style>
        body { font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Helvetica, Arial, Noto Sans, sans-serif; }
        .parallax { background-image: linear-gradient(to bottom right, #fff7ed, #fffbeb); }
        .parallax::before {
            content: ""; position: fixed; inset: 0; z-index: -1;
            background: radial-gradient(600px 200px at 10% 10%, rgba(138,72,19,.08), transparent),
                        radial-gradient(700px 250px at 90% 20%, rgba(148,68,3,.07), transparent),
                        radial-gradient(800px 300px at 40% 80%, rgba(139,77,5,.06), transparent);
        }
        .parallax-element { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden; }
        .note { transform: rotate(var(--tilt, -1deg)); transition: transform .2s ease, box-shadow .2s ease; }
        .note:hover { transform: rotate(0deg) translateY(-2px); box-shadow: 0 20px 35px rgba(0,0,0,.08); }
        .tape::before { content: ""; position: absolute; inset: -12px auto auto 50%; translate: -50% 0; width: 80px; height: 24px; background: rgba(255,255,255,.8); box-shadow: 0 4px 8px rgba(0,0,0,.08); transform: rotate(-3deg); }
        .paper { background: #fff; background-image: linear-gradient(#f5f5f4 1px, transparent 1px); background-size: 100% 28px; }
        
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
            .pins-container {
                flex-direction: column;
            }
            .pins-form {
                order: 2;
                width: 100%;
            }
            .pins-notes {
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
    <header class="sticky top-0 z-40 bg-white/70 backdrop-blur border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="hidden md:block text-lg font-semibold text-gray-900">Sticky Pins</span>
            </div>

            <!-- Right side: Desktop nav + Mobile menu button -->
            <div class="flex items-center gap-2">
                <!-- Desktop Navigation -->
                <div class="hidden md:flex text-sm items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Dashboard</a>
                    <a href="{{ route('messages.index') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Messages</a>
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

    <main class="max-w-7xl mx-auto px-4 py-8 flex gap-8 pins-container">
        <!-- Sticky Pins Form (left) -->
        <aside class="pins-form w-full md:w-80 shrink-0">
            <div class="sticky top-24 z-10">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold">Sticky Pins</h1>
                    <p class="text-sm text-gray-500">Create quick notes and reminders. They appear here as sticky notes.</p>
                </div>
                <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-2xl p-4 mb-6 shadow-lg">
                    <form method="POST" action="{{ route('pins.store') }}" class="flex flex-col gap-3">
                        @csrf
                        <input name="title" placeholder="Title" class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" required>
                        <input name="content" placeholder="Optional content" class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:outline-none">
                        <button class="bg-gradient-to-r from-primary via-secondary to-accent text-white px-4 py-2 rounded-lg">Add Pin</button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Pins Notes (right) -->
        <section class="pins-notes flex-1 min-h-[70vh]">
            <div class="h-full flex flex-col gap-4 relative">
                @if($pins->isEmpty())
                    <div class="text-center text-gray-500 py-20">
                        <div class="mx-auto w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 012 0v5h4a1 1 0 010 2h-4v5a1 1 0 11-2 0V9H5a1 1 0 010-2h4V2z"/></svg>
                        </div>
                        No pins yet. Create your first sticky note.
                    </div>
                @else
                    <div class="flex flex-col gap-4 relative">
                        @foreach($pins as $index => $pin)
                            <div class="relative bg-yellow-100/90 paper ring-1 ring-yellow-200 rounded-xl p-4 shadow-lg">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <div class="font-semibold text-yellow-900">{{ $pin->title }}</div>
                                        @if($pin->content)
                                            <div class="text-sm text-yellow-900/80 mt-1">{{ $pin->content }}</div>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('pins.destroy', $pin) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-yellow-900/60 hover:text-red-600" title="Remove">✕</button>
                                    </form>
                                </div>
                                <div class="text-xs text-yellow-900/60 mt-3">{{ $pin->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>

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
    </script>
</body>
</html>


