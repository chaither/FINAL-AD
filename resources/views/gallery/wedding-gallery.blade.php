<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wedding Gallery - AD Mirror Photo Booth Cebu City</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#8a4813ff',
            secondary: '#e97313ff',
            accent: '#f39c12ff',
          }
        }
      }
    }
  </script>
  <style>
    /* Parallax Scroll Effects */
    .parallax-container {
      perspective: 1000px;
      transform-style: preserve-3d;
    }
    
    .parallax-image {
    transform: none !important;
    will-change: auto;
    transition: none;
    }
    
    .scroll-message {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .scroll-message.active {
      opacity: 1;
      transform: translateY(0);
    }
    
    .scroll-message.fade-out {
      opacity: 0;
      transform: translateY(-30px);
    }
    
    /* Smooth scrolling */
    html {
      scroll-behavior: smooth;
    }
    
    /* Animation keyframes */
    @keyframes float-slow {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-30px) scale(1.05); }
      100% { transform: translateY(0) scale(1); }
    }
    
    @keyframes float-medium {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-50px) scale(1.1); }
      100% { transform: translateY(0) scale(1); }
    }
    
    @keyframes float-fast {
      0% { transform: translateY(0) scale(1); }
      50% { transform: translateY(-20px) scale(0.98); }
      100% { transform: translateY(0) scale(1); }
    }
    
    .animate-float-slow {
      animation: float-slow 8s ease-in-out infinite;
    }
    
    .animate-float-medium {
      animation: float-medium 6s ease-in-out infinite;
    }
    
    .animate-float-fast {
      animation: float-fast 4s ease-in-out infinite;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: rgba(138, 72, 19, 0.1);
    }
    
    ::-webkit-scrollbar-thumb {
      background: linear-gradient(45deg, #8a4813, #e97313);
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(45deg, #e97313, #f39c12);
    }
  </style>
</head>
<body class="relative min-h-screen bg-gradient-to-br from-amber-50 to-orange-50 overflow-x-hidden">

<!-- Parallax & Animated Shapes -->
<div class="pointer-events-none select-none">
  <!-- Parallax Layer 1: Blurred Circle -->
  <div class="parallax-shape absolute top-10 left-0 w-40 h-40 bg-gradient-to-br from-primary to-secondary opacity-30 rounded-full blur-2xl animate-float-slow z-0"></div>
  <!-- Parallax Layer 2: Blurred Circle -->
  <div class="parallax-shape absolute top-1/2 right-0 w-32 h-32 bg-gradient-to-br from-accent to-primary opacity-20 rounded-full blur-2xl animate-float-fast z-0"></div>
  <!-- Parallax Layer 3: Blurred Circle -->
  <div class="parallax-shape absolute bottom-0 left-1/3 w-56 h-56 bg-gradient-to-br from-secondary to-accent opacity-20 rounded-full blur-3xl animate-float-medium z-0"></div>
  <!-- Parallax Layer 4: SVG Heart -->
  <svg class="parallax-shape absolute top-24 right-1/4 w-24 h-24 opacity-30 animate-float-slow z-0" viewBox="0 0 64 64" fill="none"><path d="M32 58s26-15.9 26-34A14 14 0 0 0 32 10a14 14 0 0 0-26 14c0 18.1 26 34 26 34z" fill="#e97313"/></svg>
  <!-- Parallax Layer 5: SVG Ring -->
  <svg class="parallax-shape absolute bottom-20 left-10 w-20 h-20 opacity-20 animate-float-medium z-0" viewBox="0 0 64 64" fill="none"><circle cx="32" cy="32" r="28" stroke="#8a4813" stroke-width="6" fill="none"/></svg>
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
          <i class="fas fa-heart text-2xl text-white"></i>
        </div>
        <div>
          <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Wedding Celebrations</h1>
          <p class="text-lg text-gray-600">Beautiful moments captured at weddings</p>
        </div>
      </div>
      
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Experience the magic of love through our lens. Every wedding tells a unique story, 
        and we're honored to capture these precious moments with our mirror photo booth.
      </p>
    </div>
  </div>
</section>

<!-- Enhanced Parallax Gallery with Scroll Messages -->
<section class="py-20 bg-white relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Scroll Progress Indicator -->
    <div class="fixed top-20 right-8 z-40 hidden lg:block">
      <div class="bg-white/80 backdrop-blur-sm rounded-full p-3 shadow-lg">
        <div class="w-3 h-32 bg-gray-200 rounded-full relative">
          <div id="scroll-progress" class="w-3 bg-gradient-to-b from-primary to-secondary rounded-full transition-all duration-300" style="height: 0%"></div>
        </div>
      </div>
    </div>

    <!-- Gallery Container with Parallax -->
    <div class="parallax-container relative">
      
      <!-- Wedding Photo 1 with Message -->
      <div class="mb-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Image with Parallax -->
          <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <img src="/image/wedding1.jpg" alt="Wedding Celebration 1" 
                 class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                 data-speed="0.3">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
          </div>
          
          <!-- Centered Message -->
          <div class="text-center lg:text-left">
            <div class="scroll-message" data-scroll="1">
              <div class="mb-6">
                <i class="fas fa-heart text-4xl text-red-400 mb-4"></i>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Love at First Sight</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                  Every glance, every smile, every moment of pure joy captured forever. 
                  Your wedding day is a story of love that deserves to be told beautifully.
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-start space-x-4">
                <span class="text-sm text-primary font-semibold">Wedding Celebration</span>
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-sm text-gray-500">Scroll to continue</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Wedding Photo 2 with Message -->
      <div class="mb-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Centered Message -->
          <div class="text-center lg:text-right order-2 lg:order-1">
            <div class="scroll-message" data-scroll="2">
              <div class="mb-6">
                <i class="fas fa-ring text-4xl text-primary mb-4"></i>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Forever Together</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                  From "I do" to forever, we capture the promises that bind two souls together. 
                  Each photograph tells the story of your commitment and love.
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-end space-x-4">
                <span class="text-sm text-gray-500">Keep scrolling</span>
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-sm text-primary font-semibold">Wedding Celebration</span>
              </div>
            </div>
          </div>
          
          <!-- Image with Parallax -->
          <div class="relative overflow-hidden rounded-2xl shadow-2xl order-1 lg:order-2">
            <img src="/image/wedding2.jpg" alt="Wedding Celebration 2" 
                 class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                 data-speed="0.4">
            <div class="absolute inset-0 bg-gradient-to-l from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
          </div>
        </div>
      </div>

      <!-- Wedding Photo 3 with Message -->
      <div class="mb-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Image with Parallax -->
          <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <img src="/image/wedding3.jpg" alt="Wedding Celebration 3" 
                 class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                 data-speed="0.5">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
          </div>
          
          <!-- Centered Message -->
          <div class="text-center lg:text-left">
            <div class="scroll-message" data-scroll="3">
              <div class="mb-6">
                <i class="fas fa-star text-4xl text-yellow-400 mb-4"></i>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Magical Moments</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                  The magic happens in the details - the nervous smiles, the happy tears, 
                  the pure joy of celebrating love with family and friends.
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-start space-x-4">
                <span class="text-sm text-primary font-semibold">Wedding Celebration</span>
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-sm text-gray-500">More to discover</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Wedding Photo 4 with Message -->
      <div class="mb-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Centered Message -->
          <div class="text-center lg:text-right order-2 lg:order-1">
            <div class="scroll-message" data-scroll="4">
              <div class="mb-6">
                <i class="fas fa-camera text-4xl text-secondary mb-4"></i>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Timeless Memories</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                  Every photograph is a window to your special day, preserving the emotions, 
                  the laughter, and the love that filled the air.
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-end space-x-4">
                <span class="text-sm text-gray-500">Almost there</span>
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-sm text-primary font-semibold">Wedding Celebration</span>
              </div>
            </div>
          </div>
          
          <!-- Image with Parallax -->
          <div class="relative overflow-hidden rounded-2xl shadow-2xl order-1 lg:order-2">
            <img src="/image/wedding4.jpg" alt="Wedding Celebration 4" 
                 class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                 data-speed="0.6">
            <div class="absolute inset-0 bg-gradient-to-l from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
          </div>
        </div>
      </div>

      <!-- Wedding Photo 5 with Message -->
      <div class="mb-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Image with Parallax -->
          <div class="relative overflow-hidden rounded-2xl shadow-2xl">
            <img src="/image/wedding5.jpg" alt="Wedding Celebration 5" 
                 class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                 data-speed="0.7">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
          </div>
          
          <!-- Centered Message -->
          <div class="text-center lg:text-left">
            <div class="scroll-message" data-scroll="5">
              <div class="mb-6">
                <i class="fas fa-heart-broken text-4xl text-red-500 mb-4"></i>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Pure Happiness</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                  The joy of your wedding day radiates through every image. 
                  We capture not just photos, but the essence of your love story.
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-start space-x-4">
                <span class="text-sm text-primary font-semibold">Wedding Celebration</span>
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-sm text-gray-500">Final moments</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Wedding Photo 6 with Message -->
      <div class="mb-32 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Centered Message -->
          <div class="text-center lg:text-right order-2 lg:order-1">
            <div class="scroll-message" data-scroll="6">
              <div class="mb-6">
                <i class="fas fa-infinity text-4xl text-accent mb-4"></i>
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Endless Love</h3>
                <p class="text-lg text-gray-600 leading-relaxed">
                  Your love story is just beginning, and we're honored to have captured 
                  the first chapter. Here's to a lifetime of beautiful memories together.
                </p>
              </div>
              <div class="flex items-center justify-center lg:justify-end space-x-4">
                <span class="text-sm text-gray-500">Ready to begin?</span>
                <div class="w-8 h-px bg-primary"></div>
                <span class="text-sm text-primary font-semibold">Wedding Celebration</span>
              </div>
            </div>
          </div>
          
          <!-- Image with Parallax -->
          <div class="relative overflow-hidden rounded-2xl shadow-2xl order-1 lg:order-2">
            <img src="/image/wedding6.jpg" alt="Wedding Celebration 6" 
                 class="parallax-image w-full h-96 lg:h-[500px] object-cover" 
                 data-speed="0.8">
            <div class="absolute inset-0 bg-gradient-to-l from-primary/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500"></div>
          </div>
        </div>
      </div>

    </div>

    <!-- Call to Action -->
    <div class="text-center mt-16">
      <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-2xl p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Ready to Create Your Wedding Memories?</h3>
        <p class="text-lg text-gray-600 mb-6">
          Let us capture your special day with our premium mirror photo booth experience.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="/#contact" class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <i class="fas fa-calendar-check mr-2"></i>
            Book Your Wedding
          </a>
          <a href="/" class="border-2 border-primary text-primary px-8 py-4 rounded-full text-lg font-semibold hover:bg-primary hover:text-white transition-all duration-300">
            <i class="fas fa-home mr-2"></i>
            Back to Home
          </a>
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
          <i class="fas fa-camera-retro text-2xl text-primary mr-3"></i>
          <span class="text-xl font-bold">AD Photo Booth</span>
        </div>
        <p class="text-gray-300">
          Creating unforgettable memories through the art of photography.
        </p>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Services</h4>
        <ul class="space-y-2 text-gray-300">
          <li><a href="/#gallery" class="hover:text-primary transition-colors">Wedding Photo Booths</a></li>
          <li><a href="/#gallery" class="hover:text-primary transition-colors">Corporate Events</a></li>
          <li><a href="/#gallery" class="hover:text-primary transition-colors">Birthday Parties</a></li>
          <li><a href="/#gallery" class="hover:text-primary transition-colors">Special Occasions</a></li>
        </ul>
      </div>
      
      <div>
        <h4 class="text-lg font-semibold mb-4">Company</h4>
        <ul class="space-y-2 text-gray-300">
          <li><a href="/#features" class="hover:text-primary transition-colors">About Us</a></li>
          <li><a href="/#features" class="hover:text-primary transition-colors">Our Team</a></li>
          <li><a href="/#contact" class="hover:text-primary transition-colors">Contact</a></li>
          <li><a href="/#pricing" class="hover:text-primary transition-colors">Pricing</a></li>
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
      
      // Update scroll progress
      const scrollPercent = (scrollY / (documentHeight - windowHeight)) * 100;
      this.updateScrollProgress(scrollPercent);
      
      // Handle parallax effects
      this.updateParallax(scrollY);
      
      // Handle message transitions
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
        
        // Calculate parallax transform based on scroll position
        const translateX = -(scrolled * 0.1); // Slide to left
        const translateY = -(scrolled * 0.05); // Slight upward movement
        const scale = 1 + (scrolled * 0.0001); // Subtle scale effect
        
        image.style.transform = `translate3d(${translateX}px, ${translateY}px, 0) scale(${scale})`;
      });
    }

    updateScrollMessages(scrollY, windowHeight) {
      this.scrollMessages.forEach((message, index) => {
        const rect = message.getBoundingClientRect();
        const messageTop = rect.top + scrollY;
        const messageBottom = messageTop + rect.height;
        
        // Calculate when message should be active
        const triggerPoint = scrollY + (windowHeight * 0.6); // 60% of viewport height
        
        if (triggerPoint >= messageTop && triggerPoint <= messageBottom) {
          this.activateMessage(index);
        } else if (scrollY > messageBottom) {
          this.fadeOutMessage(index);
        } else if (scrollY < messageTop - windowHeight) {
          this.fadeOutMessage(index);
        }
      });
    }

    activateMessage(index) {
      // Deactivate all messages
      this.scrollMessages.forEach((msg, i) => {
        if (i !== index) {
          msg.classList.remove('active');
          msg.classList.add('fade-out');
        }
      });
      
      // Activate current message
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

  // Mobile menu toggle
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
      
      // Close menu when clicking outside
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

  // Initialize controllers when DOM is loaded
  document.addEventListener('DOMContentLoaded', () => {
    new ParallaxGalleryController();
    new MobileMenuController();
    
    // Add smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  });

  // Parallax effect for shapes
  document.addEventListener('mousemove', function(e) {
    const shapes = document.querySelectorAll('.parallax-shape');
    const x = (e.clientX / window.innerWidth - 0.5) * 2;
    const y = (e.clientY / window.innerHeight - 0.5) * 2;
    shapes.forEach((shape, i) => {
      const speed = (i + 1) * 10;
      shape.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
    });
  });

  // Prevent background scroll when any modal opens (reuse from welcome if exists)
  function lockScroll(){ document.documentElement.classList.add('overflow-hidden'); document.body.classList.add('overflow-hidden'); }
  function unlockScroll(){ document.documentElement.classList.remove('overflow-hidden'); document.body.classList.remove('overflow-hidden'); }
</script>

</body>
</html>

