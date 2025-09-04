<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Info Editor</title>
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
    .parallax-element { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden; }
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
    .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 20px 35px rgba(0,0,0,.08); }
    .tilt { will-change: transform; transform-style: preserve-3d; transition: transform .2s ease; }
    .tilt:hover { transition: transform .08s ease; }
    .glow { box-shadow: 0 10px 30px rgba(148, 68, 3, 0.08); }

    /* Mobile Menu Styles */
    .mobile-menu { transform: translateX(-100%); transition: transform .3s cubic-bezier(.4,0,.2,1); }
    .mobile-menu.open { transform: translateX(0); }
    .mobile-overlay { opacity: 0; visibility: hidden; transition: opacity .3s ease, visibility .3s ease; }
    .mobile-overlay.open { opacity: 1; visibility: visible; }
    .hamburger { transition: transform .3s ease; }
    .hamburger.open { transform: rotate(90deg); }
  </style>
</head>
<body class="parallax min-h-screen">

  <div class="parallax-element">
    <div class="absolute top-24 left-10 w-40 h-40 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 blur-2xl" data-speed=".25"></div>
    <div class="absolute bottom-24 right-20 w-56 h-56 rounded-full bg-gradient-to-br from-accent/20 to-primary/20 blur-3xl" data-speed=".15"></div>
  </div>

  <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b border-gray-200 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="hidden md:block font-semibold text-gray-800">Contact Info</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="hidden md:block text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Back to dashboard</a>
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
                <a href="{{ route('contact-info.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary text-sm">
                    <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h5l2 2h5a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"/></svg></span>
                    Contact Info
                </a>
            </nav>
        </div>
    </aside>

  <!-- Main Section -->
  <div class="max-w-5xl mx-auto px-4 py-10">
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 tilt glow">

      @if (session('status'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
          {{ session('status') }}
        </div>
      @endif

      @php
        $path = storage_path('app/contact_info.json');
        $contactInfo = [];
        if (file_exists($path)) {
          $contactInfo = json_decode(@file_get_contents($path), true) ?? [];
        }
      @endphp

      <!-- Display contact info -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
  <div class="p-5 rounded-xl bg-gradient-to-br from-primary/5 to-white ring-1 ring-primary/10 shadow-sm">
    <div class="text-sm font-semibold mb-1 text-gray-700">📞 Phone</div>
    @php
      $phone = $contactInfo['phone'] ?? '';
      // Ensure it starts with +63
      if (!empty($phone) && !str_starts_with($phone, '+63')) {
          $phone = '+63' . ltrim($phone, '0'); // remove leading 0 then add +63
      }
    @endphp
    <a href="tel:{{ $phone }}" class="text-primary font-medium">
      {{ $phone ?: 'Not set' }}
    </a>
  </div>
</div>

        <div class="p-5 rounded-xl bg-gradient-to-br from-secondary/5 to-white ring-1 ring-secondary/10 shadow-sm">
          <div class="text-sm font-semibold mb-1 text-gray-700">📧 Email</div>
          <a href="mailto:{{ $contactInfo['email'] ?? '' }}" class="text-secondary font-medium">
            {{ $contactInfo['email'] ?? 'Not set' }}
          </a>
        </div>
        <div class="p-5 rounded-xl bg-gradient-to-br from-accent/5 to-white ring-1 ring-accent/10 shadow-sm">
          <div class="text-sm font-semibold mb-1 text-gray-700">📍 Address</div>
          @if (!empty($contactInfo['address']))
            <a href="https://maps.google.com/?q={{ urlencode($contactInfo['address']) }}" target="_blank" class="text-accent font-medium">
              {{ $contactInfo['address'] }}
            </a>
          @else
            <span class="text-gray-500">Not set</span>
          @endif
        </div>
      </div>

      <hr class="my-6 border-gray-300" />

      <!-- Social Media Links Section -->
      <div class="mb-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Social Media Links</h3>
        
        <!-- Display current social links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
          @if(isset($contactInfo['social_links']) && is_array($contactInfo['social_links']))
            @foreach($contactInfo['social_links'] as $index => $social)
              <div class="p-4 rounded-xl bg-gradient-to-br from-gray-50 to-white ring-1 ring-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                  <i class="fab fa-{{ $social['icon'] ?? 'globe' }} text-lg text-primary"></i>
                  <span class="font-medium text-gray-700">{{ $social['platform'] ?? 'Social Media' }}</span>
                </div>
                <a href="{{ $social['url'] ?? '#' }}" target="_blank" class="text-sm text-primary hover:underline break-all">
                  {{ $social['url'] ?? 'No URL set' }}
                </a>
              </div>
            @endforeach
          @else
            <div class="col-span-full text-center text-gray-500 py-4">No social media links configured yet.</div>
          @endif
        </div>
      </div>

      <hr class="my-6 border-gray-300" />

      <!-- Form -->
      <form method="POST" action="{{ route('contact-info.update') }}" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Contact Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div>
            <label class="block text-sm mb-2 font-medium text-gray-700">Phone</label>
            <input name="phone" type="text" value="{{ $contactInfo['phone'] ?? '' }}" 
                   class="w-full border rounded-lg p-2 ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
          </div>
          <div>
            <label class="block text-sm mb-2 font-medium text-gray-700">Email</label>
            <input name="email" type="email" value="{{ $contactInfo['email'] ?? '' }}" 
                   class="w-full border rounded-lg p-2 ring-1 ring-gray-300 focus:ring-2 focus:ring-secondary focus:outline-none" />
          </div>
          <div>
            <label class="block text-sm mb-2 font-medium text-gray-700">Address</label>
            <input name="address" type="text" value="{{ $contactInfo['address'] ?? '' }}" 
                   class="w-full border rounded-lg p-2 ring-1 ring-gray-300 focus:ring-2 focus:ring-accent focus:outline-none" />
          </div>
        </div>

        <!-- Social Media Links Form -->
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <h4 class="text-md font-semibold text-gray-700">Social Media Links</h4>
            <button type="button" id="addSocialLink" class="px-3 py-1.5 text-sm bg-primary text-white rounded-lg hover:bg-primary/80 transition">
              + Add Link
            </button>
          </div>
          
          <div id="socialLinksContainer" class="space-y-3">
            @if(isset($contactInfo['social_links']) && is_array($contactInfo['social_links']))
              @foreach($contactInfo['social_links'] as $index => $social)
                <div class="social-link-row flex gap-3 items-end p-3 bg-gray-50 rounded-lg">
                  <div class="flex-1">
                    <label class="block text-xs text-gray-600 mb-1">Platform</label>
                    <input name="social_links[{{ $index }}][platform]" type="text" value="{{ $social['platform'] ?? '' }}" 
                           placeholder="e.g., Facebook, Instagram, Twitter" 
                           class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                  </div>
                  <div class="flex-1">
                    <label class="block text-xs text-gray-600 mb-1">URL</label>
                    <input name="social_links[{{ $index }}][url]" type="url" value="{{ $social['url'] ?? '' }}" 
                           placeholder="https://..." 
                           class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                  </div>
                  <div class="w-24">
                    <label class="block text-xs text-gray-600 mb-1">Icon</label>
                    <input name="social_links[{{ $index }}][icon]" type="text" value="{{ $social['icon'] ?? '' }}" 
                           placeholder="facebook-f" 
                           class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                  </div>
                  <button type="button" class="remove-social-link px-2 py-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              @endforeach
            @endif
          </div>
        </div>

        <hr class="my-6 border-gray-300" />

        <!-- Gallery Previews Form -->
        @php
          $eventOptions = ['Wedding','Corporate Event','Birthday Party','Graduation','Other'];
          $gp = $contactInfo['gallery_previews'] ?? [];
        @endphp
        <div class="space-y-4">
          <div class="flex items-center justify-between">
            <h4 class="text-md font-semibold text-gray-700">Gallery Event Previews (Card media)</h4>
            <button type="button" id="addPreviewRow" class="px-3 py-1.5 text-sm bg-primary text-white rounded-lg hover:bg-primary/80 transition">+ Add Preview</button>
          </div>
          <div id="previewRows" class="space-y-3">
            @foreach($gp as $event => $info)
              <div class="preview-row grid grid-cols-1 md:grid-cols-5 gap-3 p-3 bg-gray-50 rounded-lg">
                <div>
                  <label class="block text-xs text-gray-600 mb-1">Event</label>
                  <input name="gallery_previews[{{ $loop->index }}][event]" type="text" value="{{ $event }}" class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>
                <div>
                  <label class="block text-xs text-gray-600 mb-1">Type</label>
                  <select name="gallery_previews[{{ $loop->index }}][type]" class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none">
                    <option value="image" {{ ($info['type'] ?? '')==='image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ ($info['type'] ?? '')==='video' ? 'selected' : '' }}>Video</option>
                  </select>
                </div>
                <div class="md:col-span-2">
                  <label class="block text-xs text-gray-600 mb-1">URL (image src or video src)</label>
                  <input name="gallery_previews[{{ $loop->index }}][url]" type="text" value="{{ $info['url'] ?? '' }}" placeholder="https://... or /storage/..." class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>
                <div>
                  <label class="block text-xs text-gray-600 mb-1">Poster (optional)</label>
                  <input name="gallery_previews[{{ $loop->index }}][poster]" type="text" value="{{ $info['poster'] ?? '' }}" placeholder="Video poster image URL" class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
                </div>
                <button type="button" class="remove-preview px-2 py-2 text-red-500 hover:bg-red-50 rounded-lg transition md:col-span-5 justify-self-start"><i class="fas fa-trash"></i></button>
              </div>
            @endforeach
          </div>
        </div>

        <div class="text-right">
          <button type="submit" class="px-6 py-2 rounded-xl bg-gradient-to-r from-primary via-secondary to-accent text-white font-semibold shadow hover:opacity-90 transition">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Mobile menu handlers
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

      // Parallax blobs
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

      const addButton = document.getElementById('addSocialLink');
      const container = document.getElementById('socialLinksContainer');
      let linkIndex = {{ isset($contactInfo['social_links']) ? count($contactInfo['social_links']) : 0 }};

      // Add new social link row
      if (addButton) {
        addButton.addEventListener('click', function() {
          const newRow = document.createElement('div');
          newRow.className = 'social-link-row flex gap-3 items-end p-3 bg-gray-50 rounded-lg';
          newRow.innerHTML = `
            <div class="flex-1">
              <label class="block text-xs text-gray-600 mb-1">Platform</label>
              <input name="social_links[${linkIndex}][platform]" type="text" 
                     placeholder="e.g., Facebook, Instagram, Twitter" 
                     class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
            </div>
            <div class="flex-1">
              <label class="block text-xs text-gray-600 mb-1">URL</label>
              <input name="social_links[${linkIndex}][url]" type="url" 
                     placeholder="https://..." 
                     class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
            </div>
            <div class="w-24">
              <label class="block text-xs text-gray-600 mb-1">Icon</label>
              <input name="social_links[${linkIndex}][icon]" type="text" 
                     placeholder="facebook-f" 
                     class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
            </div>
            <button type="button" class="remove-social-link px-2 py-2 text-red-500 hover:bg-red-50 rounded-lg transition">
              <i class="fas fa-trash"></i>
            </button>
          `;
          
          container.appendChild(newRow);
          linkIndex++;
          
          // Add event listener to the new remove button
          newRow.querySelector('.remove-social-link').addEventListener('click', function() {
            container.removeChild(newRow);
          });
        });
      }

      // Remove social link row (for existing rows)
      document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-social-link')) {
          const row = e.target.closest('.social-link-row');
          if (row) {
            container.removeChild(row);
          }
        }
      });

      // Gallery Previews dynamic rows
      const addPreviewBtn = document.getElementById('addPreviewRow');
      const previewsContainer = document.getElementById('previewRows');
      let previewIndex = {{ isset($contactInfo['gallery_previews']) && is_array($contactInfo['gallery_previews']) ? count($contactInfo['gallery_previews']) : 0 }};
      if (addPreviewBtn) {
        addPreviewBtn.addEventListener('click', function() {
          const row = document.createElement('div');
          row.className = 'preview-row grid grid-cols-1 md:grid-cols-5 gap-3 p-3 bg-gray-50 rounded-lg';
          row.innerHTML = `
            <div>
              <label class="block text-xs text-gray-600 mb-1">Event</label>
              <input name="gallery_previews[${previewIndex}][event]" type="text" class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
            </div>
            <div>
              <label class="block text-xs text-gray-600 mb-1">Type</label>
              <select name="gallery_previews[${previewIndex}][type]" class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none">
                <option value="image">Image</option>
                <option value="video">Video</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label class="block text-xs text-gray-600 mb-1">URL (image src or video src)</label>
              <input name="gallery_previews[${previewIndex}][url]" type="text" placeholder="https://... or /storage/..." class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
            </div>
            <div>
              <label class="block text-xs text-gray-600 mb-1">Poster (optional)</label>
              <input name="gallery_previews[${previewIndex}][poster]" type="text" placeholder="Video poster image URL" class="w-full border rounded-lg p-2 text-sm ring-1 ring-gray-300 focus:ring-2 focus:ring-primary focus:outline-none" />
            </div>
            <button type="button" class="remove-preview px-2 py-2 text-red-500 hover:bg-red-50 rounded-lg transition md:col-span-5 justify-self-start"><i class="fas fa-trash"></i></button>
          `;
          previewsContainer.appendChild(row);
          previewIndex++;
        });
      }
      document.addEventListener('click', function(e){
        if (e.target.closest('.remove-preview')) {
          const row = e.target.closest('.preview-row');
          if (row && previewsContainer.contains(row)) previewsContainer.removeChild(row);
        }
      });
    });
  </script>

</body>
</html>
