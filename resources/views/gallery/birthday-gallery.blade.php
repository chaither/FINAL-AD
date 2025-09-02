<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Birthday Parties Gallery - AD Mirror Photo Booth Cebu City</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#fd7d14',
            secondary: '#fd7d14',
            accent: '#fd7d14',
          }
        }
      }
    }
  </script>
  <style>
    .parallax-container { perspective: 1000px; transform-style: preserve-3d; }
    .parallax-image { transform: none !important; will-change: auto; transition: none; }
    .scroll-message { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
    .scroll-message.active { opacity: 1; transform: translateY(0); }
    .scroll-message.fade-out { opacity: 0; transform: translateY(-30px); }
    html { scroll-behavior: smooth; }
    @keyframes float-slow { 0% { transform: translateY(0) scale(1); } 50% { transform: translateY(-30px) scale(1.05); } 100% { transform: translateY(0) scale(1); } }
    @keyframes float-medium { 0% { transform: translateY(0) scale(1); } 50% { transform: translateY(-50px) scale(1.1); } 100% { transform: translateY(0) scale(1); } }
    @keyframes float-fast { 0% { transform: translateY(0) scale(1); } 50% { transform: translateY(-20px) scale(0.98); } 100% { transform: translateY(0) scale(1); } }
    .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
    .animate-float-medium { animation: float-medium 6s ease-in-out infinite; }
    .animate-float-fast { animation: float-fast 4s ease-in-out infinite; }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: rgba(253, 125, 20, 0.1); }
    ::-webkit-scrollbar-thumb { background: linear-gradient(45deg, #fd7d14, #fd7d14); border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: linear-gradient(45deg, #fd7d14, #fd7d14); }
  </style>
</head>
<body class="relative min-h-screen bg-gradient-to-br from-amber-50 to-orange-50">
<!-- Parallax & Animated Shapes -->
<div class="pointer-events-none select-none">
  <div class="parallax-shape absolute top-10 left-0 w-40 h-40 bg-gradient-to-br from-primary to-secondary opacity-30 rounded-full blur-2xl animate-float-slow z-0"></div>
  <div class="parallax-shape absolute top-1/2 right-0 w-32 h-32 bg-gradient-to-br from-accent to-primary opacity-20 rounded-full blur-2xl animate-float-fast z-0"></div>
  <div class="parallax-shape absolute bottom-0 left-1/3 w-56 h-56 bg-gradient-to-br from-secondary to-accent opacity-20 rounded-full blur-3xl animate-float-medium z-0"></div>
  <svg class="parallax-shape absolute top-24 right-1/4 w-24 h-24 opacity-30 animate-float-slow z-0" viewBox="0 0 64 64" fill="none"><path d="M32 58s26-15.9 26-34A14 14 0 0 0 32 10a14 14 0 0 0-26 14c0 18.1 26 34 26 34z" fill="#fd7d14"/></svg>
  <svg class="parallax-shape absolute bottom-20 left-10 w-20 h-20 opacity-20 animate-float-medium z-0" viewBox="0 0 64 64" fill="none"><circle cx="32" cy="32" r="28" stroke="#fd7d14" stroke-width="6" fill="none"/></svg>
</div>

<!-- Video Background -->
<video autoplay muted loop playsinline 
 class="fixed top-0 left-0 w-full h-full object-cover -z-10 opacity-10">
  <source src="image/chaither.mp4" type="video/mp4">
</video>

<!-- Navbar -->
<nav class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      
      <!-- Logo -->
      <div class="flex items-center">
        <i class="fas fa-camera-retro text-3xl text-primary mr-3"></i>
        <a href="/" class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
          AD
        </a>
      </div>

      <!-- Menu (Desktop) -->
      <div class="hidden md:flex space-x-8">
        <a href="/" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Home</a>
        <a href="/#features" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Features</a>
        <a href="/#pricing" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Pricing</a>
        <a href="/#gallery" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Gallery</a>
        <a href="/#contact" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Contact</a>
      </div>

      <!-- CTA Button -->
      <div class="hidden md:block">
        <a href="/#contact" class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
          Book Now
        </a>
      </div>

      <!-- Mobile Burger Button -->
      <button class="md:hidden flex flex-col space-y-1.5 focus:outline-none" id="menu-btn">
        <span class="block w-6 h-0.5 bg-primary"></span>
        <span class="block w-6 h-0.5 bg-primary"></span>
        <span class="block w-6 h-0.5 bg-primary"></span>
      </button>

    </div>

    <!-- Mobile Menu -->
    <div class="hidden md:hidden pb-4" id="mobile-menu">
      <div class="flex flex-col space-y-3">
        <a href="/" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Home</a>
        <a href="/#features" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Features</a>
        <a href="/#pricing" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Pricing</a>
        <a href="/#gallery" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Gallery</a>
        <a href="/#contact" class="text-gray-700 hover:text-primary transition-colors duration-300 font-medium">Contact</a>
        <a href="/#contact" class="bg-gradient-to-r from-primary to-secondary text-white px-4 py-2 rounded-full font-semibold text-center">
          Book Now
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Header Section -->
<section class="py-20 bg-gradient-to-br from-primary/10 to-secondary/10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <div class="mb-8">
      <a href="/" class="inline-flex items-center text-primary hover:text-secondary transition-colors duration-300 mb-6">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Home
      </a>
      
      <div class="flex items-center justify-center mb-6">
        <div class="w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center mr-4">
          <i class="fas fa-birthday-cake text-2xl text-white"></i>
        </div>
        <div>
          <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Birthday Parties</h1>
          <p class="text-lg text-gray-600">Fun and laughter guaranteed</p>
        </div>
      </div>
      
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Make every birthday celebration unforgettable with our fun and interactive mirror photo booth experience. 
        Perfect for all ages and party themes in Cebu City.
      </p>
    </div>
  </div>
</section>

<!-- Gallery Grid -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="fixed top-20 right-8 z-40 hidden lg:block">
      <div class="bg-white/80 backdrop-blur-sm rounded-full p-3 shadow-lg">
        <div class="w-3 h-32 bg-gray-200 rounded-full relative">
          <div id="scroll-progress" class="w-3 bg-gradient-to-b from-primary to-secondary rounded-full transition-all duration-300" style="height: 0%"></div>
        </div>
      </div>
    </div>
    <div class="parallax-container relative">
      @forelse($photos as $index => $photo)
        <div class="mb-32 relative">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            @if($index % 2 == 0)
              <!-- Image with Parallax (Left) -->
              <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" 
                     class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                     data-speed="{{ 0.3 + ($index * 0.1) }}">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
              </div>
              
              <!-- Centered Message (Right) -->
              <div class="text-center lg:text-left">
                <div class="scroll-message" data-scroll="{{ $index + 1 }}">
                  <div class="mb-6">
                    <i class="fas fa-birthday-cake text-4xl text-orange-400 mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ $photo->title }}</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">
                      {{ $photo->description ?: 'Laughter, games, and memories made. Capture the joy of your birthday party with our interactive photo booth.' }}
                    </p>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start space-x-4">
                    <span class="text-sm text-primary font-semibold">Birthday Party</span>
                    <div class="w-8 h-px bg-primary"></div>
                    <span class="text-sm text-gray-500">{{ $index == count($photos) - 1 ? 'Final moments' : 'Scroll to continue' }}</span>
                  </div>
                </div>
              </div>
            @else
              <!-- Centered Message (Left) -->
              <div class="text-center lg:text-right order-2 lg:order-1">
                <div class="scroll-message" data-scroll="{{ $index + 1 }}">
                  <div class="mb-6">
                    <i class="fas fa-gift text-4xl text-primary mb-4"></i>
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ $photo->title }}</h3>
                    <p class="text-lg text-gray-600 leading-relaxed">
                      {{ $photo->description ?: 'Unwrap the excitement! Every birthday is filled with surprises and smiles to remember.' }}
                    </p>
                  </div>
                  <div class="flex items-center justify-center lg:justify-end space-x-4">
                    <span class="text-sm text-gray-500">{{ $index == count($photos) - 1 ? 'Ready to begin?' : 'Keep scrolling' }}</span>
                    <div class="w-8 h-px bg-primary"></div>
                    <span class="text-sm text-primary font-semibold">Birthday Party</span>
                  </div>
                </div>
              </div>
              
              <!-- Image with Parallax (Right) -->
              <div class="relative overflow-hidden rounded-2xl shadow-2xl order-1 lg:order-2">
                <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}" 
                     class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                     data-speed="{{ 0.3 + ($index * 0.1) }}">
                <div class="absolute inset-0 bg-gradient-to-l from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
              </div>
            @endif
          </div>
        </div>
      @empty
        <!-- Fallback content when no photos exist -->
        <div class="text-center py-20">
          <div class="mb-8">
            <i class="fas fa-birthday-cake text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-600 mb-4">No Birthday Party Photos Yet</h3>
            <p class="text-lg text-gray-500">
              Our birthday gallery is being prepared. Check back soon for fun party moments!
            </p>
          </div>
        </div>
      @endforelse
    </div>
    <div class="text-center mt-16">
      <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-2xl p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Ready to Make Your Birthday Unforgettable?</h3>
        <p class="text-lg text-gray-600 mb-6">Let us add fun and excitement to your birthday celebration with our interactive mirror photo booth experience.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="/#contact" class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300">Book Birthday Party</a>
          <a href="/" class="border-2 border-primary text-primary px-8 py-4 rounded-full text-lg font-semibold hover:bg-primary hover:text-white transition-all duration-300">Back to Home</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      <div>
        <div class="flex items-center mb-4">
          <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-lg flex items-center justify-center mr-3">
            <span class="text-xl font-bold text-white">AD</span>
          </div>
          <span class="text-xl font-bold">AD Photo Booth</span>
        </div>
        <p class="text-gray-300">
          Creating unforgettable memories through our premium mirror photo booth experience in Cebu City.
        </p>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Services</h4>
        <ul class="space-y-2 text-gray-300">
          <li><a href="#" class="hover:text-primary transition-colors">Wedding Photo Booths</a></li>
          <li><a href="#" class="hover:text-primary transition-colors">Corporate Events</a></li>
          <li><a href="#" class="hover:text-primary transition-colors">Birthday Parties</a></li>
          <li><a href="#" class="hover:text-primary transition-colors">Special Occasions</a></li>
        </ul>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Company</h4>
        <ul class="space-y-2 text-gray-300">
          <li><a href="#" class="hover:text-primary transition-colors">About Us</a></li>
          <li><a href="#" class="hover:text-primary transition-colors">Our Team</a></li>
          <li><a href="#" class="hover:text-primary transition-colors">Careers</a></li>
          <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
        </ul>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
        <p class="text-gray-300 mb-4">Stay updated with our latest offers and events.</p>
        <div class="flex">
          <input type="email" placeholder="Your email" class="flex-1 px-4 py-2 rounded-l-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary">
          <button class="px-4 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-r-lg hover:shadow-lg transition-all duration-300">
            <i class="fas fa-paper-plane"></i>
          </button>
        </div>
      </div>
    </div>
    
    <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
      <p>&copy; 2024 AD Photo Booth Cebu City. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
  // Enhanced Parallax and Scroll Message Controller
  class ParallaxGalleryController {
    constructor() {
      this.parallaxImages = document.querySelectorAll('.parallax-image');
      this.scrollMessages = document.querySelectorAll('.scroll-message');
      this.scrollProgress = document.getElementById('scroll-progress');
      this.lastScrollY = 0;
      this.currentMessageIndex = 0;
      this.init();
    }
    init() {
      this.bindEvents();
      this.activateFirstMessage();
      this.updateScrollProgress();
    }
    bindEvents() {
      window.addEventListener('scroll', this.handleScroll.bind(this));
      window.addEventListener('resize', this.handleResize.bind(this));
    }
    handleScroll() {
      const scrollY = window.pageYOffset;
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;
      const scrollPercent = (scrollY / (documentHeight - windowHeight)) * 100;
      this.updateScrollProgress(scrollPercent);
      this.updateParallax(scrollY);
      this.updateScrollMessages(scrollY, windowHeight);
      this.lastScrollY = scrollY;
    }
    updateScrollProgress(percent = 0) {
      if (this.scrollProgress) {
        this.scrollProgress.style.height = `${percent}%`;
      }
    }
    updateParallax(scrollY) {
      this.parallaxImages.forEach((image) => {
        const speed = parseFloat(image.dataset.speed) || 0.5;
        const rect = image.getBoundingClientRect();
        const scrolled = scrollY * speed;
        const translateX = -(scrolled * 0.1);
        const translateY = -(scrolled * 0.05);
        const scale = 1 + (scrolled * 0.0001);
        image.style.transform = `translate3d(${translateX}px, ${translateY}px, 0) scale(${scale})`;
      });
    }
    updateScrollMessages(scrollY, windowHeight) {
      this.scrollMessages.forEach((message, index) => {
        const rect = message.getBoundingClientRect();
        const messageTop = rect.top + scrollY;
        const messageBottom = messageTop + rect.height;
        const triggerPoint = scrollY + (windowHeight * 0.6);
        if (triggerPoint >= messageTop && triggerPoint <= messageBottom) {
          this.activateMessage(index);
        } else if (scrollY > messageBottom) {
          this.fadeOutMessage(index);
        } else if (scrollY < messageTop - windowHeight) {
          // ...
        }
      });
    }
    activateMessage(index) {
      this.scrollMessages.forEach((msg, i) => {
        if (i !== index) {
          // ...
        }
      });
      const currentMessage = this.scrollMessages[index];
      if (currentMessage) {
        currentMessage.classList.remove('fade-out');
        currentMessage.classList.add('active');
        this.currentMessageIndex = index;
      }
    }
    fadeOutMessage(index) {
      const message = this.scrollMessages[index];
      if (message) {
        message.classList.remove('active');
        message.classList.add('fade-out');
      }
    }
    activateFirstMessage() {
      if (this.scrollMessages.length > 0) {
        this.activateMessage(0);
      }
    }
    handleResize() {
      this.updateScrollProgress();
    }
  }
  class MobileMenuController {
    constructor() {
      this.menuBtn = document.getElementById('menu-btn');
      this.mobileMenu = document.getElementById('mobile-menu');
      this.init();
    }
    init() {
      this.bindEvents();
    }
    bindEvents() {
      this.menuBtn.addEventListener('click', this.toggleMenu.bind(this));
      document.addEventListener('click', (e) => {
        if (!this.menuBtn.contains(e.target) && !this.mobileMenu.contains(e.target)) {
          this.closeMenu();
        }
      });
      // Auto-close on scroll and resize
      window.addEventListener('scroll', this.handleScrollClose.bind(this), { passive: true });
      window.addEventListener('resize', this.closeMenu.bind(this));
      // Close after clicking any link inside the mobile menu
      this.mobileMenu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => this.closeMenu());
      });
    }
    toggleMenu() {
      this.mobileMenu.classList.toggle('hidden');
      this.menuBtn && this.menuBtn.classList.toggle('active');
    }
    closeMenu() {
      this.mobileMenu.classList.add('hidden');
      this.menuBtn && this.menuBtn.classList.remove('active');
    }
    isMenuOpen() {
      return !this.mobileMenu.classList.contains('hidden');
    }
    handleScrollClose() {
      if (this.isMenuOpen()) {
        this.closeMenu();
      }
    }
  }
  document.addEventListener('DOMContentLoaded', () => {
    new ParallaxGalleryController();
    new MobileMenuController();
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          // ...
        }
      });
    });
  });
  document.addEventListener('mousemove', function(e) {
    const shapes = document.querySelectorAll('.parallax-shape');
    const x = (e.clientX / window.innerWidth - 0.5) * 2;
    const y = (e.clientY / window.innerHeight - 0.5) * 2;
    shapes.forEach((shape, i) => {
      const speed = (i + 1) * 10;
      shape.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
    });
  });
</script>

</body>
</html>

