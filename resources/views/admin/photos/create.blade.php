<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo - Admin Dashboard</title>
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
        
        /* Form Styles */
        .image-preview { 
            max-width: 100%; 
            max-height: 300px; 
            object-fit: cover; 
        }
        
        .drag-area { 
            border: 2px dashed #d1d5db; 
            transition: all 0.3s ease; 
        }
        
        .drag-area.dragover { 
            border-color: #8a4813; 
            background-color: #fef3c7; 
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
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">
                        AD
                    </div>
                    <span class="hidden sm:block text-lg font-semibold text-gray-800">Upload Photo</span>
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
                
                <!-- Dashboard Button -->
                <a href="{{ route('admin.dashboard') }}" class="w-full mb-4 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-primary via-secondary to-accent hover:shadow-lg transition-shadow text-center block">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                        </svg>
                        Dashboard
                    </div>
                </a>
                
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
                    
                    <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/5 text-gray-700 transition-colors group">
                        <span class="inline-flex w-5">
                            <svg class="w-5 h-5 text-primary group-hover:text-primary/80" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/>
                            </svg>
                        </span>
                        <span class="font-medium">Packages</span>
                    </a>
                    
                    <a href="{{ route('photos.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary font-medium">
                        <span class="inline-flex w-5">
                            <svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                        </span>
                        <span class="font-medium">Photos</span>
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

        <main class="flex-1 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Upload New Photo</h1>
                    <p class="text-gray-600 mt-1">Add a new photo to your gallery</p>
                </div>
                <a href="{{ route('photos.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    ← Back to Photos
                </a>
            </div>

            <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl p-6">
                <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Photo Title *</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors"
                                    placeholder="Enter photo title">
                                @error('title')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Type (typeable with suggestions) -->
                            <div>
                                <label for="event_type_input" class="block text-sm font-medium text-gray-700 mb-2">Event Type *</label>
                                <input list="event_type_suggestions" name="event_type_input" id="event_type_input" value="{{ old('event_type_input') }}" required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors"
                                    placeholder="Type or choose: Wedding, Corporate Event, Birthday Party, ...">
                                <datalist id="event_type_suggestions">
                                    @foreach($eventTypes as $eventType)
                                        <option value="{{ $eventType }}">
                                    @endforeach
                                </datalist>
                                @error('event_type_input')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Custom Event Label becomes auto if typed doesn't match; keep optional for clarity -->
                            <div>
                                <label for="event_label" class="block text-sm font-medium text-gray-700 mb-2">Custom Event Label (optional)</label>
                                <input type="text" name="event_label" id="event_label" value="{{ old('event_label') }}"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors"
                                    placeholder="e.g., Silver Wedding of Mark & Jane">
                                <p class="text-xs text-gray-500 mt-1">If your typed event isn't a standard type, it will be saved as "Other" with this label.</p>
                                @error('event_label')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors"
                                    placeholder="Enter photo description (optional)">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-colors"
                                    placeholder="0">
                                <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                                @error('sort_order')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary focus:ring-2">
                                <label for="is_active" class="ml-2 text-sm text-gray-700">Make photo visible on public page</label>
                            </div>
                        </div>

                        <!-- Right Column - Image Upload -->
                        <div class="space-y-6">
                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Photo Upload *</label>
                                <div id="dragArea" class="drag-area rounded-lg p-8 text-center cursor-pointer transition-all duration-300">
                                    <div id="uploadContent">
                                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="text-lg font-medium text-gray-600 mb-2">Drop your photo here</p>
                                        <p class="text-sm text-gray-500 mb-4">or click to browse</p>
                                        <button type="button" id="browseBtn" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                                            Browse Files
                                        </button>
                                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden" required>
                                    </div>
                                    <div id="previewContent" class="hidden">
                                        <img id="imagePreview" class="image-preview mx-auto mb-4 rounded-lg" alt="Preview">
                                        <button type="button" id="changeImageBtn" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                                            Change Image
                                        </button>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Upload Guidelines -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="font-medium text-blue-900 mb-2">Upload Guidelines</h4>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li>• Supported formats: JPEG, PNG, JPG, GIF, WebP</li>
                                    <li>• Maximum file size: 2MB</li>
                                    <li>• Recommended dimensions: 800x600 or larger</li>
                                    <li>• High-quality images work best</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('photos.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary via-secondary to-accent text-white rounded-lg hover:shadow-lg transition-all duration-200 hover-lift">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Upload Photo
                        </button>
                    </div>
                </form>
            </div>
        </main>
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

        // Image upload functionality
        const dragArea = document.getElementById('dragArea');
        const imageInput = document.getElementById('imageInput');
        const browseBtn = document.getElementById('browseBtn');
        const uploadContent = document.getElementById('uploadContent');
        const previewContent = document.getElementById('previewContent');
        const imagePreview = document.getElementById('imagePreview');
        const changeImageBtn = document.getElementById('changeImageBtn');

        // Browse button click
        browseBtn.addEventListener('click', () => {
            imageInput.click();
        });

        // File input change
        imageInput.addEventListener('change', handleFileSelect);

        // Drag and drop events
        dragArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dragArea.classList.add('dragover');
        });

        dragArea.addEventListener('dragleave', () => {
            dragArea.classList.remove('dragover');
        });

        dragArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dragArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });

        // Handle file selection
        function handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                handleFile(file);
            }
        }

        // Process selected file
        function handleFile(file) {
            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB.');
                return;
            }

            // Display preview
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                uploadContent.classList.add('hidden');
                previewContent.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        // Change image button
        changeImageBtn.addEventListener('click', () => {
            imageInput.value = '';
            uploadContent.classList.remove('hidden');
            previewContent.classList.add('hidden');
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
</body>
</html>
