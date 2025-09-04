<!DOCTYPE html>
<html lang="html">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Manage Feedback</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { theme: { extend: { colors: { primary: '#8a4813ff', secondary: '#944403ff', accent: '#8b4d05ff' } } } }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    
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
      .feedback-card {
        position: relative;
      }
      .featured-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        z-index: 10;
      }
    }
  </style>
  </head>
<body class="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50/30 to-yellow-50/30">
     <header class="sticky top-0 z-40 bg-white/70 backdrop-blur supports-[backdrop-filter]:bg-white/60 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Mobile Menu Button -->
            <button id="menuToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Toggle menu" aria-expanded="false">
                <div class="hamburger w-6 h-6 flex flex-col justify-center items-center">
                    <span class="block w-5 h-0.5 bg-gray-700 mb-1 transition-all"></span>
                    <span class="block w-5 h-0.5 bg-gray-700 mb-1 transition-all"></span>
                    <span class="block w-5 h-0.5 bg-gray-700 transition-all"></span>
                </div>
            </button>
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="hidden md:block text-lg font-semibold text-gray-900">Feedback Management</span>
            </div>
            
            <!-- Desktop User Info -->
            <div class="hidden md:flex items-center gap-4 text-sm">
                <span class="text-gray-700">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Logout</button>
                </form>
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
      <div class="mt-3 text-sm text-gray-600">Hi, {{ auth()->user()->name }}</div>
    </div>
    
    <div class="p-4">
      <a href="{{ route('admin.dashboard') }}" class="w-full mb-3 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-primary via-secondary to-accent block text-center text-sm">Dashboard</a>
      <nav class="space-y-2">
        <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
          <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/></svg></span>
          Packages
        </a>
        <a href="{{ route('photos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700 text-sm">
          <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg></span>
          Photos
        </a>
        <a href="{{ route('feedback.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium text-sm">
          <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg></span>
          Feedback
        </a>
      </nav>
      
      <div class="mt-6 pt-4 border-t border-gray-200">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button class="w-full px-3 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">Logout</button>
        </form>
      </div>
    </div>
  </aside>

  <!-- Desktop Sidebar -->
  <aside class="hidden md:block w-64 shrink-0">
    <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-2xl p-3 sticky top-24">
      <a href="{{ route('admin.dashboard') }}" class="w-full mb-2 px-4 py-3 rounded-xl text-white bg-gradient-to-r from-primary via-secondary to-accent block text-center">Dashboard</a>
      <nav class="text-sm">
        <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
          <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/></svg></span>
          Packages
        </a>
        <a href="{{ route('photos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
          <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg></span>
          Photos
        </a>
        <a href="{{ route('feedback.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium">
          <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg></span>
          Feedback
        </a>
      </nav>
    </div>
  </aside>

  <main class="max-w-7xl mx-auto px-4 py-6 flex gap-6">
    <div class="flex-1 space-y-6">
      @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
      @endif

      <!-- Featured Feedback Summary -->
      <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl p-6 border border-primary/20">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Featured Feedback Status</h3>
            <p class="text-sm text-gray-600">Currently featuring {{ $feedback->where('is_featured', true)->count() }} out of 3 slots</p>
          </div>
          <div class="flex items-center gap-2">
            @for($i = 1; $i <= 3; $i++)
              <div class="w-3 h-3 rounded-full {{ $i <= $feedback->where('is_featured', true)->count() ? 'bg-green-500' : 'bg-gray-300' }}"></div>
            @endfor
          </div>
        </div>
        <div class="text-xs text-gray-500">
          <strong>Note:</strong> Only 3 feedback items can be featured at a time. Featured items appear on the welcome page.
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Manage Feedback</h1>
          <p class="text-gray-600 mt-1">Review and manage user feedback submissions.</p>
        </div>
      </div>

      <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse($feedback as $item)
            <div class="feedback-card rounded-xl ring-1 ring-gray-200 p-5 bg-white flex flex-col {{ $item->is_featured ? 'ring-2 ring-primary/50 bg-gradient-to-br from-primary/5 to-secondary/5' : '' }}">
              <!-- Featured Badge -->
              @if($item->is_featured)
                <div class="featured-badge absolute -top-2 -right-2">
                  <div class="bg-gradient-to-r from-primary to-secondary text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                    ★ Featured
                  </div>
                </div>
              @endif
              
              <div class="flex items-center justify-between mb-2">
                <div class="font-semibold text-gray-900">{{ $item->name }}</div>
                <div class="text-xs px-2 py-1 rounded-full {{ $item->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                  {{ $item->is_approved ? 'Approved' : 'Pending' }}
                </div>
              </div>
              <div class="text-xs text-gray-500 mb-3">{{ $item->email }}</div>
              <div class="flex items-center gap-1 mb-3">
                @for($i=1; $i<=5; $i++)
                  <i class="fa{{ $i <= $item->rating ? 's' : 'r' }} fa-star text-amber-400"></i>
                @endfor
              </div>
              <p class="text-gray-700 text-sm flex-1">{{ $item->comment }}</p>
              <div class="flex gap-2 mt-4">
                <!-- Featured Toggle Button -->
                <button 
                  onclick="toggleFeatured({{ $item->id }}, this)" 
                  class="px-3 py-2 rounded-lg text-sm transition-all duration-200 {{ $item->is_featured 
                    ? 'bg-primary/20 text-primary hover:bg-primary/30' 
                    : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                  data-feedback-id="{{ $item->id }}"
                  data-is-featured="{{ $item->is_featured ? 'true' : 'false' }}"
                >
                  {{ $item->is_featured ? '★ Unfeature' : '☆ Feature' }}
                </button>
                
                <!-- Delete Button -->
                <form action="{{ route('feedback.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this feedback?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-2 rounded-lg bg-red-50 text-red-600 text-sm hover:bg-red-100">Delete</button>
                </form>
              </div>
            </div>
          @empty
            <div class="col-span-full text-center text-gray-600">No feedback yet.</div>
          @endforelse
        </div>
        <div class="mt-6">{{ $feedback->links() }}</div>
      </div>
    </div>
  </main>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  
  <script>
    // Mobile Menu Functionality
    document.addEventListener('DOMContentLoaded', () => {
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
    });

    async function toggleFeatured(feedbackId, button) {
      const isCurrentlyFeatured = button.dataset.isFeatured === 'true';
      const featuredCount = document.querySelectorAll('[data-is-featured="true"]').length;
      
      // Check if we're trying to feature and already have 3
      if (!isCurrentlyFeatured && featuredCount >= 3) {
        alert('Maximum 3 featured feedback items allowed. Please unfeature another item first.');
        return;
      }
      
      try {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        
        const response = await fetch(`/admin/feedback/${feedbackId}/toggle-featured`, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        });
        
        const data = await response.json();
        
        if (data.success) {
          // Update button state
          button.dataset.isFeatured = data.is_featured.toString();
          button.innerHTML = data.is_featured ? '★ Unfeature' : '☆ Feature';
          
          // Update button styling
          if (data.is_featured) {
            button.className = 'px-3 py-2 rounded-lg text-sm transition-all duration-200 bg-primary/20 text-primary hover:bg-primary/30';
            button.closest('.rounded-xl').classList.add('ring-2', 'ring-primary/50', 'bg-gradient-to-br', 'from-primary/5', 'to-secondary/5');
          } else {
            button.className = 'px-3 py-2 rounded-lg text-sm transition-all duration-200 bg-gray-100 text-gray-600 hover:bg-gray-200';
            button.closest('.rounded-xl').classList.remove('ring-2', 'ring-primary/50', 'bg-gradient-to-br', 'from-primary/5', 'to-secondary/5');
          }
          
          // Update featured count display
          updateFeaturedCount();
          
          // Show success message
          showNotification(data.message, 'success');
        } else {
          showNotification(data.message, 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showNotification('An error occurred while updating featured status.', 'error');
      } finally {
        button.disabled = false;
      }
    }
    
    function updateFeaturedCount() {
      const featuredCount = document.querySelectorAll('[data-is-featured="true"]').length;
      const countText = document.querySelector('.text-sm.text-gray-600');
      if (countText) {
        countText.textContent = `Currently featuring ${featuredCount} out of 3 slots`;
      }
      
      // Update status dots
      const dots = document.querySelectorAll('.w-3.h-3.rounded-full');
      dots.forEach((dot, index) => {
        dot.className = `w-3 h-3 rounded-full ${index < featuredCount ? 'bg-green-500' : 'bg-gray-300'}`;
      });
    }
    
    function showNotification(message, type) {
      // Create notification element
      const notification = document.createElement('div');
      notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
      }`;
      notification.textContent = message;
      
      document.body.appendChild(notification);
      
      // Animate in
      setTimeout(() => {
        notification.classList.remove('translate-x-full');
      }, 100);
      
      // Animate out and remove
      setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    }
  </script>
</body>
</html>


