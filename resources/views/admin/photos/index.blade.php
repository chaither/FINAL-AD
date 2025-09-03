<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Photos - Admin Dashboard</title>
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
        .hover-lift { transition: transform .25s ease, box-shadow .25s ease; }
        .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,.1); }
        .animate-on-scroll { opacity: 0; transform: translateY(16px); transition: all .6s cubic-bezier(.2,.8,.2,1); }
        .animate-on-scroll.animate-in { opacity: 1; transform: translateY(0); }
        @keyframes float-slow { 0%,100%{ transform: translateY(0) } 50%{ transform: translateY(-8px) } }
        .float-slow { animation: float-slow 8s ease-in-out infinite; }
    </style>
</head>
<body class="parallax min-h-screen">
    <header class="sticky top-0 z-40 bg-white/70 backdrop-blur supports-[backdrop-filter]:bg-white/60 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-3">
            <div class="flex items-center gap-3 mr-2">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
            </div>
            <div class="ml-auto flex items-center gap-4 text-sm">
                <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-6 flex gap-6">
        <aside class="w-64 shrink-0">
            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-2xl p-3 sticky top-24">
                <a href="{{ route('admin.dashboard') }}" class="w-full mb-2 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-primary via-secondary to-accent block text-center">Dashboard</a>
                <nav class="text-sm">
                    <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
                        <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/></svg></span>
                        Packages
                    </a>
                    <a href="{{ route('photos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium">
                        <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg></span>
                        Photos
                    </a>
                     <a href="{{ route('feedback.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
                        <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg></span>
                         Feedback
                    </a>
                </nav>
            </div>
        </aside>

        <main class="flex-1 space-y-6">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg animate-on-scroll">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manage Photos</h1>
                    <p class="text-gray-600 mt-1">Click on any event type container to view and manage photos for that category</p>
                </div>
                <a href="{{ route('photos.create') }}" class="px-4 py-2 bg-gradient-to-r from-primary via-secondary to-accent text-white rounded-lg hover:shadow-lg transition-all duration-200 hover-lift">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Upload New Photo
                </a>
            </div>

            <!-- Event Type Containers -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Wedding Events Container -->
                <button onclick="openEventModal('Wedding')" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 block w-full text-left hover-lift">
                    <div class="w-full h-48 bg-gradient-to-br from-pink-500 to-red-500 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-heart text-6xl text-white"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-semibold mb-2">Wedding Events</h3>
                            <p class="text-sm mb-3">Beautiful wedding moments captured</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">{{ $photoCounts['Wedding'] ?? 0 }} photos</span>
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Click to manage</span>
                            </div>
                        </div>
                    </div>
                </button>
                
                <!-- Corporate Events Container -->
                <button onclick="openEventModal('Corporate Event')" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 block w-full text-left hover-lift">
                    <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-briefcase text-6xl text-white"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-semibold mb-2">Corporate Events</h3>
                            <p class="text-sm mb-3">Professional team building</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">{{ $photoCounts['Corporate Event'] ?? 0 }} photos</span>
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Click to manage</span>
                            </div>
                        </div>
                    </div>
                </button>
                
                <!-- Birthday Parties Container -->
                <button onclick="openEventModal('Birthday Party')" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 block w-full text-left hover-lift">
                    <div class="w-full h-48 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-birthday-cake text-6xl text-white"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-semibold mb-2">Birthday Parties</h3>
                            <p class="text-sm mb-3">Fun and laughter guaranteed</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">{{ $photoCounts['Birthday Party'] ?? 0 }} photos</span>
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Click to manage</span>
                            </div>
                        </div>
                    </div>
                </button>
                
                <!-- Graduation Container -->
                <button onclick="openEventModal('Graduation')" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 block w-full text-left hover-lift">
                    <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-graduation-cap text-6xl text-white"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-semibold mb-2">Graduation</h3>
                            <p class="text-sm mb-3">Academic achievements celebrated</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">{{ $photoCounts['Graduation'] ?? 0 }} photos</span>
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Click to manage</span>
                            </div>
                        </div>
                    </div>
                </button>
                
                <!-- Other Events Container -->
                <button onclick="openEventModal('Other')" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 block w-full text-left hover-lift">
                    <div class="w-full h-48 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-calendar-alt text-6xl text-white"></i>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-semibold mb-2">Special Events</h3>
                            <p class="text-sm mb-3">Unique celebrations & occasions</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">{{ $photoCounts['Other'] ?? 0 }} photos</span>
                                <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Click to manage</span>
                            </div>
                        </div>
                    </div>
                </button>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Photo Management Overview</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-primary">{{ $photoCounts['Wedding'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Wedding</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $photoCounts['Corporate Event'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Corporate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $photoCounts['Birthday Party'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Birthday</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ $photoCounts['Graduation'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Graduation</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $photoCounts['Other'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Other</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Event Photos Modal -->
    <div id="eventModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
        
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <div>
                        <h3 id="modalTitle" class="text-2xl font-bold text-gray-900">Event Photos</h3>
                        <p id="modalSubtitle" class="text-gray-600 mt-1">Manage photos for this event category</p>
                    </div>
                    <button onclick="closeEventModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Content -->
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                    <div id="modalContent" class="space-y-6">
                        <!-- Loading state -->
                        <div id="modalLoading" class="text-center py-12">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                            <p class="text-gray-600">Loading photos...</p>
                        </div>
                        
                        <!-- Photos will be loaded here -->
                        <div id="modalPhotos" class="hidden">
                            <!-- Photos grid will be populated here -->
                        </div>
                        
                        <!-- Empty state -->
                        <div id="modalEmpty" class="hidden text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Photos Yet</h3>
                            <p class="text-gray-600 mb-6">No photos have been uploaded for this event type yet.</p>
                            <a href="{{ route('photos.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary via-secondary to-accent text-white rounded-lg hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Upload First Photo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Viewer (Lightbox) Modal -->
    <div id="imageViewerModal" class="fixed inset-0 z-[60] hidden">
        <div id="imageViewerBackdrop" class="absolute inset-0 bg-black/90 backdrop-blur-sm"></div>
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <button class="absolute top-6 right-6 p-2 rounded-lg bg-white/10 hover:bg-white/20 transition" onclick="closeImageViewer()" aria-label="Close image viewer">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <img id="imageViewerImg" src="" alt="" class="max-h-[85vh] max-w-[90vw] rounded-xl shadow-2xl" />
        </div>
    </div>

    <script>
        // Event Modal Functions
        function openEventModal(eventType) {
            const modal = document.getElementById('eventModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalSubtitle = document.getElementById('modalSubtitle');
            const modalLoading = document.getElementById('modalLoading');
            const modalPhotos = document.getElementById('modalPhotos');
            const modalEmpty = document.getElementById('modalEmpty');
            
            // Set modal title based on event type
            const eventTitles = {
                'Wedding': 'Wedding Events Photos',
                'Corporate Event': 'Corporate Events Photos',
                'Birthday Party': 'Birthday Parties Photos',
                'Graduation': 'Graduation Photos',
                'Other': 'Special Events Photos'
            };
            
            const eventSubtitles = {
                'Wedding': 'Manage all wedding event photos',
                'Corporate Event': 'Manage all corporate event photos',
                'Birthday Party': 'Manage all birthday party photos',
                'Graduation': 'Manage all graduation photos',
                'Other': 'Manage all special event photos'
            };
            
            modalTitle.textContent = eventTitles[eventType] || 'Event Photos';
            modalSubtitle.textContent = eventSubtitles[eventType] || 'Manage photos for this event category';
            
            // Show modal and loading state
            modal.classList.remove('hidden');
            modalLoading.classList.remove('hidden');
            modalPhotos.classList.add('hidden');
            modalEmpty.classList.add('hidden');
            
            // Load photos for this event type
            loadEventPhotos(eventType);
        }

        function closeEventModal() {
            const modal = document.getElementById('eventModal');
            modal.classList.add('hidden');
        }

        function loadEventPhotos(eventType) {
            // Get photos from the current page data (no need for API call)
            const photos = @json($photos);
            const eventPhotos = photos.filter(photo => photo.event_type === eventType);
            
            const modalLoading = document.getElementById('modalLoading');
            const modalPhotos = document.getElementById('modalPhotos');
            const modalEmpty = document.getElementById('modalEmpty');
            
            modalLoading.classList.add('hidden');
            
            if (eventPhotos.length > 0) {
                displayPhotos(eventPhotos);
                modalPhotos.classList.remove('hidden');
            } else {
                modalEmpty.classList.remove('hidden');
            }
        }

        function displayPhotos(photos) {
            const modalPhotos = document.getElementById('modalPhotos');
            
            const photosHTML = photos.map(photo => `
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="aspect-w-16 aspect-h-9 mb-4">
                        <img src="${photo.image_url || '/storage/' + photo.image_path}" alt="${photo.title}" class="w-full h-48 object-cover rounded-lg cursor-zoom-in js-zoom-img" data-url="${photo.image_url || '/storage/' + photo.image_path}">
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">${photo.title}</h4>
                    ${photo.description ? `<p class="text-gray-600 text-sm mb-3">${photo.description}</p>` : ''}
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                        <span>Order: ${photo.sort_order}</span>
                        <span>${new Date(photo.created_at).toLocaleDateString()}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="/photos/${photo.id}/edit" class="flex-1 px-3 py-2 text-center text-sm bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors">
                            Edit
                        </a>
                        <form action="/photos/${photo.id}/toggle-status" method="POST" class="flex-1">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="w-full px-3 py-2 text-center text-sm ${photo.is_active ? 'bg-yellow-50 text-yellow-600' : 'bg-green-50 text-green-600'} rounded-lg hover:bg-opacity-80 transition-colors">
                                ${photo.is_active ? 'Hide' : 'Show'}
                            </button>
                        </form>
                        <form action="/photos/${photo.id}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this photo?')">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="w-full px-3 py-2 text-center text-sm bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            `).join('');
            
            modalPhotos.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    ${photosHTML}
                </div>
            `;

            // Wire zoom handlers
            modalPhotos.querySelectorAll('.js-zoom-img').forEach(function(img) {
                img.addEventListener('click', function() {
                    openImageViewer(img.dataset.url, img.getAttribute('alt') || '');
                });
            });
        }

        // Close modal when clicking outside
        document.getElementById('eventModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEventModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEventModal();
                closeImageViewer();
            }
        });

        // Animation observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
    </script>

    <script>
        function openImageViewer(url, title) {
            const modal = document.getElementById('imageViewerModal');
            const img = document.getElementById('imageViewerImg');
            img.src = url;
            img.alt = title || '';
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            const backdrop = document.getElementById('imageViewerBackdrop');
            if (backdrop) { backdrop.onclick = closeImageViewer; }
        }

        function closeImageViewer() {
            const modal = document.getElementById('imageViewerModal');
            if (!modal || modal.classList.contains('hidden')) return;
            const img = document.getElementById('imageViewerImg');
            img.src = '';
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
</body>
</html>
