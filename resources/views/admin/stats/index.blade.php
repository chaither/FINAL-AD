<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics Dashboard - AD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .parallax { background-image: linear-gradient(to bottom right, #fff7ed, #fffbeb); }
        .parallax-element { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden; }
        .animate-on-scroll { opacity: 0; transform: translateY(16px); transition: all .6s cubic-bezier(.2,.8,.2,1); }
        .animate-on-scroll.animate-in { opacity: 1; transform: translateY(0); }

        /* Mobile Menu Styles */
        .mobile-menu { transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); }
        .mobile-menu.open { transform: translateX(0); }
        .mobile-overlay { opacity: 0; visibility: hidden; transition: opacity .3s ease, visibility .3s ease; }
        .mobile-overlay.open { opacity: 1; visibility: visible; }
        .hamburger { transition: transform .3s ease; }
        .hamburger.open { transform: rotate(90deg); }
    </style>
    @php
        // Ensure variables exist to avoid view errors if controller changes
        $totalFeedback = $totalFeedback ?? 0;
        $totalMessages = $totalMessages ?? 0;
        $todaysFeedback = $todaysFeedback ?? 0;
        $todaysMessages = $todaysMessages ?? 0;
        $weeksFeedback = $weeksFeedback ?? 0;
        $weeksMessages = $weeksMessages ?? 0;
        $monthsFeedback = $monthsFeedback ?? 0;
        $monthsMessages = $monthsMessages ?? 0;
        $averageRating = $averageRating ?? 0;
        $recentActivity = $recentActivity ?? collect([]);
        $ratingStats = $ratingStats ?? collect([]);
        $topContributors = $topContributors ?? collect([]);
    @endphp
</head>
<body class="parallax min-h-screen">
    <div class="parallax-element">
        <div class="absolute top-24 left-10 w-40 h-40 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 blur-2xl" data-speed=".25"></div>
        <div class="absolute bottom-24 right-20 w-56 h-56 rounded-full bg-gradient-to-br from-accent/20 to-primary/20 blur-3xl" data-speed=".15"></div>
    </div>
    <header class="sticky top-0 z-40 bg-white/70 backdrop-blur supports-[backdrop-filter]:bg-white/60 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo / Title -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="hidden md:block text-lg font-semibold text-gray-800">Statistics Dashboard</span>
            </div>

            <!-- Right: Desktop user info + Mobile menu button -->
            <div class="flex items-center gap-2">
                <div class="hidden md:flex items-center gap-4 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Dashboard</a>
                    <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Logout</button>
                    </form>
                </div>
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
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
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

    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Website Statistics & Analytics</h1>
            <p class="text-gray-600">Monitor performance, client engagement, and business metrics</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white/80 backdrop-blur ring-1 ring-primary/10 rounded-xl shadow p-6 animate-on-scroll">
                <p class="text-sm text-gray-500">Total Feedback</p>
                <p class="text-3xl font-bold text-primary">{{ number_format($totalFeedback) }}</p>
            </div>
            <div class="bg-white/80 backdrop-blur ring-1 ring-secondary/10 rounded-xl shadow p-6 animate-on-scroll">
                <p class="text-sm text-gray-500">Total Messages</p>
                <p class="text-3xl font-bold text-secondary">{{ number_format($totalMessages) }}</p>
            </div>
            <div class="bg-white/80 backdrop-blur ring-1 ring-accent/10 rounded-xl shadow p-6 animate-on-scroll">
                <p class="text-sm text-gray-500">Average Rating</p>
                <p class="text-3xl font-bold text-accent">{{ number_format($averageRating, 1) }}/5</p>
            </div>
            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl shadow p-6 animate-on-scroll">
                <p class="text-sm text-gray-500">This Month</p>
                <p class="text-3xl font-bold text-gray-800">{{ number_format($monthsFeedback + $monthsMessages) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl shadow p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity (Last 7 Days)</h3>
                @if($recentActivity->count() > 0)
                    <div class="h-64"><canvas id="recentActivityChart"></canvas></div>
                @else
                    <div class="h-64 flex items-center justify-center text-gray-500">No recent activity data</div>
                @endif
            </div>
            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl shadow p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Feedback Rating Distribution</h3>
                @if($ratingStats->count() > 0)
                    <div class="h-64"><canvas id="ratingChart"></canvas></div>
                @else
                    <div class="h-64 flex items-center justify-center text-gray-500">No rating data</div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white/80 backdrop-blur ring-1 ring-primary/20 rounded-xl shadow p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Today</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span>Feedback</span><span class="font-semibold text-primary">{{ $todaysFeedback }}</span></div>
                    <div class="flex justify-between"><span>Messages</span><span class="font-semibold text-secondary">{{ $todaysMessages }}</span></div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur ring-1 ring-secondary/20 rounded-xl shadow p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">This Week</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span>Feedback</span><span class="font-semibold text-primary">{{ $weeksFeedback }}</span></div>
                    <div class="flex justify-between"><span>Messages</span><span class="font-semibold text-secondary">{{ $weeksMessages }}</span></div>
                </div>
            </div>
            <div class="bg-white/80 backdrop-blur ring-1 ring-accent/20 rounded-xl shadow p-6 animate-on-scroll">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">This Month</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span>Feedback</span><span class="font-semibold text-primary">{{ $monthsFeedback }}</span></div>
                    <div class="flex justify-between"><span>Messages</span><span class="font-semibold text-secondary">{{ $monthsMessages }}</span></div>
                </div>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl shadow p-6 animate-on-scroll">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Feedback Contributors</h3>
            @if($topContributors->count())
                <div class="space-y-3">
                    @foreach($topContributors as $index => $contributor)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary to-secondary text-white flex items-center justify-center text-sm font-bold">{{ $index + 1 }}</div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $contributor->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $contributor->feedback_count }} feedback{{ $contributor->feedback_count > 1 ? 's' : '' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-500">No feedback contributors yet</div>
            @endif
        </div>
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

            if (menuToggle) menuToggle.addEventListener('click', (e) => { e.preventDefault(); openMobileMenu(); });
            if (menuClose) menuClose.addEventListener('click', (e) => { e.preventDefault(); closeMobileMenu(); });
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeMobileMenu);
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeMobileMenu(); });
            window.addEventListener('resize', () => { if (window.innerWidth >= 768) closeMobileMenu(); });

            // Parallax Effect
            const blobs = Array.from(document.querySelectorAll('.parallax-element > div'));
            const updateParallax = () => {
                const y = window.scrollY || window.pageYOffset;
                blobs.forEach(el => {
                    const speed = parseFloat(el.dataset.speed || 0.2);
                    el.style.transform = `translateY(${-(y * speed)}px)`;
                });
                requestAnimationFrame(updateParallax);
            };
            updateParallax();

            const hasRecentActivity = @json($recentActivity->count() > 0);
            const hasRatingStats = @json($ratingStats->count() > 0);

            if (hasRecentActivity) {
                const el = document.getElementById('recentActivityChart');
                if (el) {
                    const ctx = el.getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($recentActivity->pluck('date')),
                            datasets: [{
                                label: 'Feedback',
                                data: @json($recentActivity->pluck('feedback')),
                                borderColor: '#8a4813',
                                backgroundColor: 'rgba(138, 72, 19, 0.1)',
                                tension: 0.4,
                                fill: true
                            }, {
                                label: 'Messages',
                                data: @json($recentActivity->pluck('messages')),
                                borderColor: '#944403',
                                backgroundColor: 'rgba(148, 68, 3, 0.1)',
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'top' } },
                            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                        }
                    });
                }
            }

            if (hasRatingStats) {
                const el = document.getElementById('ratingChart');
                if (el) {
                    const ctx = el.getContext('2d');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: @json($ratingStats->pluck('rating')->map(function($rating) { return (string) $rating; })),
                            datasets: [{
                                data: @json($ratingStats->pluck('count')),
                                backgroundColor: ['#ef4444','#f97316','#eab308','#22c55e','#3b82f6'],
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const total = @json($ratingStats->sum('count'));
                                            const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                            return `${context.label} Stars: ${context.parsed} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
            document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>



