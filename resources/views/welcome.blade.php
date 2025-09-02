<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#8a4813ff',
            secondary: '#944403ff',
            accent: '#8b4d05ff',
          },
          fontFamily: {
            'inter': ['Inter', 'sans-serif'],
          },
          animation: {
            'float-slow': 'float-slow 8s ease-in-out infinite',
            'float-medium': 'float-medium 6s ease-in-out infinite',
            'float-fast': 'float-fast 4s ease-in-out infinite',
            'pulse-glow': 'pulse-glow 3s ease-in-out infinite',
            'slide-in-left': 'slide-in-left 0.8s ease-out forwards',
            'slide-in-right': 'slide-in-right 0.8s ease-out forwards',
            'slide-in-up': 'slide-in-up 0.8s ease-out forwards',
            'fade-in-scale': 'fade-in-scale 0.8s ease-out forwards',
            'rotate-3d': 'rotate-3d 20s linear infinite',
            'morph-shape': 'morph-shape 8s ease-in-out infinite',
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Inter', sans-serif; }
    .parallax-container { perspective: 1000px; transform-style: preserve-3d; }
    .parallax-element { will-change: transform; }
    .animate-on-scroll { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
    .animate-on-scroll.animate-in { opacity: 1; transform: translateY(0); }
    .navbar-hidden { transform: translateY(-100%); }
    .navbar-scrolled { background: rgba(255, 255, 255, 0.98) !important; backdrop-filter: blur(20px); }
    .glass-morphism { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); }
    .hover-lift { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .hover-lift:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); }
    .navbar-click-animate {
      animation: navbarClickScale 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    @keyframes navbarClickScale {
      0% { transform: scale(1); background: transparent; }
      30% { transform: scale(1.15); background: rgba(255,255,255,0.15); }
      60% { transform: scale(0.95); background: rgba(255,255,255,0.10); }
      100% { transform: scale(1); background: transparent; }
    }
  </style>
  <style>
    @keyframes slideInRight {
      from { transform: translateX(40px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in-right {
      animation: slideInRight 0.8s ease-out both;
    }
    @keyframes float-slow { 0%,100%{ transform: translateY(0) } 50%{ transform: translateY(-10px) } }
    .float-slow { animation: float-slow 8s ease-in-out infinite; }
    /* Hide native scrollbar for carousel */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
  </style>
</head>
<body class="relative min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-50 overflow-x-hidden font-inter">

<!-- Advanced Parallax & Animated Shapes -->
<div class="pointer-events-none select-none parallax-container">
  <!-- Parallax Layer 1: Floating Orbs -->
  <div class="parallax-element absolute top-10 left-0 w-40 h-40 bg-gradient-to-br from-primary to-secondary opacity-30 rounded-full blur-2xl animate-float-slow z-0" data-speed="0.3"></div>
  <div class="parallax-element absolute top-1/2 right-0 w-32 h-32 bg-gradient-to-br from-accent to-primary opacity-20 rounded-full blur-2xl animate-float-fast z-0" data-speed="0.5"></div>
  <div class="parallax-element absolute bottom-0 left-1/3 w-56 h-56 bg-gradient-to-br from-secondary to-accent opacity-20 rounded-full blur-3xl animate-float-medium z-0" data-speed="0.2"></div>
  
  <!-- Morphing Shapes -->
  <div class="parallax-element absolute top-1/4 right-1/4 w-24 h-24 bg-gradient-to-br from-primary to-accent opacity-20 animate-morph-shape z-0" data-speed="0.4"></div>
  <div class="parallax-element absolute bottom-1/4 right-1/3 w-20 h-20 bg-gradient-to-br from-secondary to-primary opacity-15 animate-rotate-3d z-0" data-speed="0.6"></div>
  
  <!-- Mouse Parallax Elements -->
  <div class="mouse-parallax absolute top-1/3 left-1/4 w-16 h-16 bg-gradient-to-br from-accent to-secondary opacity-25 rounded-full animate-pulse-glow z-0" data-mouse-speed="15"></div>
  <div class="mouse-parallax absolute bottom-1/3 right-1/4 w-12 h-12 bg-gradient-to-br from-primary to-accent opacity-20 rounded-full animate-float-slow z-0" data-mouse-speed="20"></div>
  
  <!-- SVG Decorative Elements -->
  <svg class="parallax-element absolute top-20 left-1/3 w-20 h-20 opacity-20 animate-float-medium z-0" viewBox="0 0 64 64" fill="none" data-speed="0.3">
    <path d="M32 58s26-15.9 26-34A14 14 0 0 0 32 10a14 14 0 0 0-26 14c0 18.1 26 34 26 34z" fill="#8a4813"/>
  </svg>
  
  <svg class="parallax-element absolute bottom-20 right-1/4 w-16 h-16 opacity-15 animate-rotate-3d z-0" viewBox="0 0 64 64" fill="none" data-speed="0.4">
    <circle cx="32" cy="32" r="28" stroke="#e97313" stroke-width="4" fill="none"/>
    <circle cx="32" cy="32" r="20" stroke="#f39c12" stroke-width="2" fill="none"/>
  </svg>
</div>

<!-- Video Background -->
<video autoplay muted loop playsinline 
 class="fixed top-0 left-0 w-full h-full object-cover -z-10 opacity-20">
  <source src="image/chaither3.mp4" type="video/mp4">
  
</video>

<!-- Enhanced Navbar with Glass Morphism -->
<nav class="glass-morphism bg-white/90 backdrop-blur-xl shadow-2xl sticky top-0 z-50 transition-all duration-500 ease-out">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      
      <!-- Enhanced Logo with Animation -->
      <div class="flex items-center group">
        <div class="relative">
          <i class="fas fa-camera-retro text-4xl text-primary mr-3 group-hover:scale-110 transition-transform duration-300 animate-pulse-glow"></i>
          <div class="absolute -top-1 -right-1 w-3 h-3 bg-accent rounded-full animate-pulse"></div>
        </div>
        <a href="#" class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent hover:scale-105 transition-transform duration-300">
          AD
        </a>
      </div>

      <!-- Enhanced Menu (Desktop) -->
      <div class="hidden md:flex space-x-8">
        <a href="#home" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium relative group">
          Home
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="#features" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium relative group">
          Features
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="#pricing" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium relative group">
          Pricing
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="#gallery" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium relative group">
          Gallery
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="#contact" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium relative group">
          Contact
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-secondary group-hover:w-full transition-all duration-300"></span>
        </a>
      </div>

      <!-- Enhanced CTA Button -->
      <div class="hidden md:block">
        <a href="#contact" class="bg-gradient-to-r from-primary via-secondary to-accent text-white px-8 py-3 rounded-full font-semibold hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
          <span class="relative z-10">Book Now</span>
          <div class="absolute inset-0 bg-gradient-to-r from-accent via-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>
      </div>

      <!-- Enhanced Mobile Burger Button -->
      <button class="md:hidden flex flex-col space-y-1.5 focus:outline-none group" id="menu-btn">
        <span class="block w-6 h-0.5 bg-primary group-hover:bg-secondary transition-all duration-300"></span>
        <span class="block w-6 h-0.5 bg-primary group-hover:bg-secondary transition-all duration-300"></span>
        <span class="block w-6 h-0.5 bg-primary group-hover:bg-secondary transition-all duration-300"></span>
      </button>

    </div>

    <!-- Enhanced Mobile Menu -->
    <div class="hidden md:hidden pb-6" id="mobile-menu">
      <div class="flex flex-col space-y-4 pt-4 border-t border-gray-200/20">
        <a href="#home" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium py-2 px-4 rounded-lg hover:bg-white/20">Home</a>
        <a href="#features" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium py-2 px-4 rounded-lg hover:bg-white/20">Features</a>
        <a href="#pricing" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium py-2 px-4 rounded-lg hover:bg-white/20">Pricing</a>
        <a href="#gallery" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium py-2 px-4 rounded-lg hover:bg-white/20">Gallery</a>
        <a href="#contact" class="text-gray-700 hover:text-primary transition-all duration-300 font-medium py-2 px-4 rounded-lg hover:bg-white/20">Contact</a>
        <a href="#contact" class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-full font-semibold text-center hover:shadow-lg transform hover:scale-105 transition-all duration-300">
          Book Now
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Enhanced Hero Section with Parallax -->
<section id="home" class="relative min-h-screen flex items-center justify-center px-4 overflow-hidden">
  <div class="flex flex-col items-center text-center max-w-4xl mx-auto relative z-10">
    
    <!-- Enhanced Logo/Brand Section with 3D Effects -->
    <div class="relative mb-8 group animate-on-scroll mt-20" data-aos="fade-up" data-aos-duration="1000">
      <div class="relative inline-block transform-gpu hover:rotate-y-12 transition-transform duration-700">
        <img src="image/nalbu.png" alt="AD Logo" class="w-48 h-48 md:w-56 md:h-56 inline-block drop-shadow-2xl hover:scale-110 transition-all duration-500">
        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-br from-accent to-secondary rounded-full flex items-center justify-center animate-pulse-glow shadow-lg">
          <i class="fas fa-camera text-white text-sm"></i>
        </div>
        <!-- Glowing Ring Effect -->
        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-primary/20 to-secondary/20 blur-xl scale-110 group-hover:scale-125 transition-transform duration-700"></div>
      </div>
    </div>

    <!-- Enhanced Typography with Staggered Animation -->
    <h1 class="text-6xl md:text-7xl lg:text-8xl font-black mb-8 bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent leading-tight animate-on-scroll" data-aos="fade-up" data-aos-delay="200">
    
      <span class="block text-4xl md:text-5xl lg:text-6xl mt-4 font-bold">Mirror Photo Booth</span>
    </h1>
    
    <p class="text-xl md:text-2xl lg:text-3xl text-gray-700 mb-12 leading-relaxed max-w-3xl animate-on-scroll" data-aos="fade-up" data-aos-delay="400">
      Experience the magic of our state-of-the-art mirror photo booth. 
      Perfect for weddings, corporate events, and special celebrations in Cebu City.
    </p>

    <!-- Enhanced CTA Buttons with Hover Effects -->
    <div class="flex flex-col sm:flex-row gap-6 animate-on-scroll" data-aos="fade-up" data-aos-delay="600">
      <a href="#contact" class="group relative overflow-hidden bg-gradient-to-r from-primary via-secondary to-accent text-white px-10 py-5 rounded-full text-xl font-bold hover:shadow-2xl transform hover:scale-105 hover:-translate-y-2 transition-all duration-500 text-center">
        <span class="relative z-10 flex items-center justify-center">
          <i class="fas fa-calendar-check mr-3 text-2xl group-hover:rotate-12 transition-transform duration-300"></i>
          Book Your Event
        </span>
        <div class="absolute inset-0 bg-gradient-to-r from-accent via-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="absolute inset-0 bg-white/20 rounded-full blur-xl scale-0 group-hover:scale-100 transition-transform duration-500"></div>
      </a>
      
      <a href="#gallery" class="group relative overflow-hidden bg-gradient-to-r from-secondary via-accent to-primary text-white px-10 py-5 rounded-full text-xl font-bold hover:shadow-2xl transform hover:scale-105 hover:-translate-y-2 transition-all duration-500 text-center">
        <span class="relative z-10 flex items-center justify-center">
          <i class="fas fa-images mr-3 text-2xl group-hover:scale-110 transition-transform duration-300"></i>
          View Gallery
        </span>
        <div class="absolute inset-0 bg-gradient-to-r from-primary via-secondary to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="absolute inset-0 bg-white/20 rounded-full blur-xl scale-0 group-hover:scale-100 transition-transform duration-500"></div>
      </a>
    </div>

    <!-- Enhanced Stats Section -->
    <div class="grid grid-cols-3 gap-8 mt-16 animate-on-scroll" data-aos="fade-up" data-aos-delay="800">
      <div class="text-center group">
        <div class="text-4xl md:text-5xl font-black text-primary mb-2 group-hover:scale-110 transition-transform duration-300">500+</div>
        <div class="text-sm md:text-base text-gray-600 font-medium">Happy Events</div>
        <div class="w-16 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mt-3 rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
      <div class="text-center group">
        <div class="text-4xl md:text-5xl font-black text-secondary mb-2 group-hover:scale-110 transition-transform duration-300">10K+</div>
        <div class="text-sm md:text-base text-gray-600 font-medium">Photos Taken</div>
        <div class="text-sm md:text-base text-gray-600 font-medium">Photos Taken</div>
        <div class="w-16 h-1 bg-gradient-to-r from-secondary to-accent mx-auto mt-3 rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
      <div class="text-center group">
        <div class="text-4xl md:text-5xl font-black text-accent mb-2 group-hover:scale-110 transition-transform duration-300">5★</div>
        <div class="text-sm md:text-base text-gray-600 font-medium">Rating</div>
        <div class="w-16 h-1 bg-gradient-to-r from-accent to-primary mx-auto mt-3 rounded-full group-hover:w-20 transition-all duration-300"></div>
      </div>
    </div>
  </div>

  <!-- Floating Elements Around Hero -->
  <div class="absolute inset-0 pointer-events-none">
    <div class="parallax-element absolute top-1/4 left-10 w-20 h-20 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-full blur-xl animate-float-slow" data-speed="0.1"></div>
    <div class="parallax-element absolute top-3/4 right-10 w-16 h-16 bg-gradient-to-br from-accent/20 to-primary/20 rounded-full blur-xl animate-float-medium" data-speed="0.15"></div>
    <div class="parallax-element absolute bottom-1/4 left-1/4 w-24 h-24 bg-gradient-to-br from-secondary/20 to-accent/20 rounded-full blur-xl animate-float-fast" data-speed="0.2"></div>
  </div>
</section>



<!-- Enhanced Features Section with Parallax -->
<section id="features" class="py-24 bg-gradient-to-br from-white via-amber-50/30 to-orange-50/30 relative overflow-hidden">
  <!-- Background Parallax Elements -->
  <div class="absolute inset-0 pointer-events-none">
    <div class="parallax-element absolute top-20 left-10 w-32 h-32 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full blur-3xl animate-float-slow" data-speed="0.1"></div>
    <div class="parallax-element absolute bottom-20 right-10 w-40 h-40 bg-gradient-to-br from-accent/10 to-primary/10 rounded-full blur-3xl animate-float-medium" data-speed="0.15"></div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-20 animate-on-scroll" data-aos="fade-up">
      <h2 class="text-5xl md:text-6xl font-black text-gray-800 mb-6 bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent">
        Why Choose AD Mirror Photo Booth?
      </h2>
      <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
        Experience the future of photo booths with our cutting-edge mirror technology and exceptional service in Cebu City.
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Enhanced Feature Card 1 -->
      <div class="group text-center p-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover-lift border border-white/20 animate-on-scroll" data-aos="fade-up" data-aos-delay="100">
        <div class="relative mb-6">
          <div class="w-20 h-20 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
         <i class="fas fa-fingerprint text-3xl text-white group-hover:rotate-12 transition-transform duration-300"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-2xl blur-xl scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-primary transition-colors duration-300">Touch Screen Mirror</h3>
        <p class="text-gray-600 leading-relaxed">Interactive mirror interface that doubles as a photo booth with intuitive touch controls and stunning visual effects.</p>
      </div>
      
      <!-- Enhanced Feature Card 2 -->
      <div class="group text-center p-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover-lift border border-white/20 animate-on-scroll" data-aos="fade-up" data-aos-delay="200">
        <div class="relative mb-6">
          <div class="w-20 h-20 bg-gradient-to-r from-secondary to-accent rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
            <i class="fas fa-print text-3xl text-white group-hover:scale-110 transition-transform duration-300"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-secondary/20 to-accent/20 rounded-2xl blur-xl scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-secondary transition-colors duration-300">Instant Prints</h3>
        <p class="text-gray-600 leading-relaxed">Get your photos printed instantly with custom AD branding and high-quality premium paper for lasting memories.</p>
      </div>
      
      <!-- Enhanced Feature Card 3 -->
      <div class="group text-center p-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover-lift border border-white/20 animate-on-scroll" data-aos="fade-up" data-aos-delay="300">
        <div class="relative mb-6">
          <div class="w-20 h-20 bg-gradient-to-r from-accent to-primary rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
            <i class="fas fa-share-alt text-3xl text-white group-hover:rotate-12 transition-transform duration-300"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-accent/20 to-primary/20 rounded-2xl blur-xl scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-accent transition-colors duration-300">Social Sharing</h3>
        <p class="text-gray-600 leading-relaxed">Share your photos instantly on social media with our integrated sharing platform and viral-worthy filters.</p>
      </div>
      
      <!-- Enhanced Feature Card 4 -->
      <div class="group text-center p-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover-lift border border-white/20 animate-on-scroll" data-aos="fade-up" data-aos-delay="400">
        <div class="relative mb-6">
          <div class="w-20 h-20 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
            <i class="fas fa-palette text-3xl text-white group-hover:scale-110 transition-transform duration-300"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-2xl blur-xl scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-primary transition-colors duration-300">Custom Props</h3>
        <p class="text-gray-600 leading-relaxed">Fun and creative props to make your photos even more entertaining and memorable for all ages.</p>
      </div>
      
      <!-- Enhanced Feature Card 5 -->
      <div class="group text-center p-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover-lift border border-white/20 animate-on-scroll" data-aos="fade-up" data-aos-delay="500">
        <div class="relative mb-6">
          <div class="w-20 h-20 bg-gradient-to-r from-secondary to-accent rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
            <i class="fas fa-clock text-3xl text-white group-hover:rotate-12 transition-transform duration-300"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-secondary/20 to-accent/20 rounded-2xl blur-xl scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-secondary transition-colors duration-300">24/7 Support</h3>
        <p class="text-gray-600 leading-relaxed">Round-the-clock customer support to ensure your event runs smoothly and exceeds expectations.</p>
      </div>
      
      <!-- Enhanced Feature Card 6 -->
      <div class="group text-center p-8 rounded-2xl bg-white/80 backdrop-blur-sm shadow-xl hover:shadow-2xl hover-lift border border-white/20 animate-on-scroll" data-aos="fade-up" data-aos-delay="600">
        <div class="relative mb-6">
          <div class="w-20 h-20 bg-gradient-to-r from-accent to-primary rounded-2xl flex items-center justify-center mx-auto group-hover:scale-110 transition-transform duration-500 shadow-lg">
            <i class="fas fa-truck text-3xl text-white group-hover:scale-110 transition-transform duration-300"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-r from-accent/20 to-primary/20 rounded-2xl blur-xl scale-110 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-accent transition-colors duration-300">Setup & Delivery</h3>
        <p class="text-gray-600 leading-relaxed">Professional setup and teardown service included with every booking for hassle-free events.</p>
      </div>
    </div>
  </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-20 bg-gradient-to-br from-amber-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-800 mb-4">Choose Your Package</h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Flexible pricing options to suit every event and budget.
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @forelse($packages as $index => $package)
        @php
          $isPopular = $index === 1; // Make the second package popular
          $bgClass = $isPopular ? 'bg-gradient-to-br from-primary to-secondary' : 'bg-white';
          $textClass = $isPopular ? 'text-white' : 'text-gray-800';
          $priceClass = $isPopular ? 'text-white' : 'text-primary';
          $subtextClass = $isPopular ? 'text-white/80' : 'text-gray-600';
          $checkColor = $isPopular ? 'text-white' : 'text-green-500';
          $buttonClass = $isPopular ? 'bg-white text-primary hover:bg-gray-100' : 'bg-gray-200 text-gray-800 hover:bg-gray-300';
        @endphp
        
        <div class="{{ $bgClass }} rounded-2xl shadow-lg p-8 hover:shadow-xl hover:scale-105 transition-transform duration-300">
          <div class="text-center mb-8">
            @if($isPopular)
              <div class="bg-white text-primary px-4 py-1 rounded-full text-sm font-semibold inline-block mb-4">Most Popular</div>
            @endif
            <h3 class="text-2xl font-bold {{ $textClass }} mb-4">{{ $package->name }}</h3>
            <div class="text-4xl font-bold {{ $priceClass }} mb-2">₱{{ number_format($package->price, 2) }}</div>
            <div class="{{ $subtextClass }}">per event</div>
            @if($package->duration)
              <div class="text-sm {{ $subtextClass }} mt-2">{{ $package->duration }}</div>
            @endif
          </div>
          
          @if($package->features && count($package->features) > 0)
            <ul class="space-y-4 mb-8">
              @foreach($package->features as $feature)
                @if(!empty(trim($feature)))
                  <li class="flex items-center">
                    <i class="fas fa-check {{ $checkColor }} mr-3"></i> 
                    <span class="{{ $textClass }}">{{ $feature }}</span>
                  </li>
                @endif
              @endforeach
            </ul>
          @endif
          
          @if($package->description)
            <p class="text-sm {{ $subtextClass }} mb-6 text-center">{{ $package->description }}</p>
          @endif
          
          <a href="#contact" class="w-full {{ $buttonClass }} py-3 rounded-full font-semibold text-center block transition-colors duration-300">
            Book {{ $package->name }}
          </a>
        </div>
      @empty
        <!-- Fallback packages if none exist -->
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl hover:scale-105 transition-transform duration-300">
          <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Basic</h3>
            <div class="text-4xl font-bold text-primary mb-2">₱299</div>
            <div class="text-gray-600">per event</div>
          </div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i> <span>2 hours of photo booth time</span></li>
            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i> <span>Unlimited photos</span></li>
            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i> <span>Basic props included</span></li>
          </ul>
          <a href="#contact" class="w-full bg-gray-200 text-gray-800 py-3 rounded-full font-semibold text-center block hover:bg-gray-300 transition-colors duration-300">Book Basic</a>
        </div>
        
        <div class="bg-gradient-to-br from-primary to-secondary rounded-2xl shadow-lg p-8 hover:shadow-xl hover:scale-110 transition-transform duration-300">
          <div class="text-center mb-8">
            <div class="bg-white text-primary px-4 py-1 rounded-full text-sm font-semibold inline-block mb-4">Most Popular</div>
            <h3 class="text-2xl font-bold text-white mb-4">Premium</h3>
            <div class="text-4xl font-bold text-white mb-2">₱499</div>
            <div class="text-white/80">per event</div>
          </div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> <span class="text-white">4 hours of photo booth time</span></li>
            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> <span class="text-white">Unlimited photos & prints</span></li>
            <li class="flex items-center"><i class="fas fa-check text-white mr-3"></i> <span class="text-white">Premium props & backdrops</span></li>
          </ul>
          <a href="#contact" class="w-full bg-white text-primary py-3 rounded-full font-semibold text-center block hover:bg-gray-100 transition-colors duration-300">Book Premium</a>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl hover:scale-105 transition-transform duration-300">
          <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Luxury</h3>
            <div class="text-4xl font-bold text-primary mb-2">₱799</div>
            <div class="text-gray-600">per event</div>
          </div>
          <ul class="space-y-4 mb-8">
            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i> <span>6 hours of photo booth time</span></li>
            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i> <span>Everything in Premium</span></li>
            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i> <span>Professional attendant</span></li>
          </ul>
          <a href="#contact" class="w-full bg-gray-200 text-gray-800 py-3 rounded-full font-semibold text-center block hover:bg-gray-300 transition-colors duration-300">Book Luxury</a>
        </div>
      @endforelse
    </div>
   
  </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-white relative overflow-hidden">
  <!-- Parallax Background for Gallery -->
  <div class="absolute inset-0 pointer-events-none">
    <div class="parallax-element absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full blur-3xl" data-speed="0.15"></div>
    <div class="parallax-element absolute top-1/3 -right-12 w-56 h-56 bg-gradient-to-br from-accent/10 to-primary/10 rounded-full blur-3xl" data-speed="0.25"></div>
    <div class="parallax-element absolute bottom-0 left-1/3 w-48 h-48 bg-gradient-to-br from-secondary/10 to-accent/10 rounded-full blur-3xl" data-speed="0.1"></div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-800 mb-4">Gallery</h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        See the magic we've created at previous events. 
      </p>
    </div>
    
    <div class="relative">
      <button type="button" aria-label="Previous" onclick="carouselPrev()" class="hidden sm:flex absolute -left-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white shadow hover:shadow-md border border-gray-200 items-center justify-center">
        <svg class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </button>
      <button type="button" aria-label="Next" onclick="carouselNext()" class="hidden sm:flex absolute -right-3 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-white shadow hover:shadow-md border border-gray-200 items-center justify-center">
        <svg class="w-5 h-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </button>
      <div id="galleryCarousel" class="flex gap-6 overflow-x-auto no-scrollbar snap-x snap-mandatory scroll-smooth pb-2">
        @php
          $eventsFromPhotos = isset($photosByEvent) && is_array($photosByEvent) ? array_keys($photosByEvent) : [];
          $featuredOrder = ['Wedding','Corporate Event','Birthday Party','Graduation'];
          $orderedEvents = array_values(array_unique(array_merge($featuredOrder, $eventsFromPhotos)));
        @endphp
        @foreach($orderedEvents as $eventType)
          <div class="min-w-[85%] sm:min-w-[60%] lg:min-w-[32%] snap-start">
            <button onclick="openPublicEventModal('{{ $eventType }}')" class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 block w-full text-left animate-slide-in-right">
              <div class="absolute -top-8 -left-8 w-28 h-28 bg-white/10 rounded-full blur-2xl float-slow"></div>
              <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-black/10 rounded-full blur-2xl float-slow" style="animation-delay:-2s"></div>
              @php
                $previewRendered = false;
              @endphp
              @if($eventType === 'Wedding')
                <video src="image/3.mp4" autoplay muted loop playsinline class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300"></video>
                @php $previewRendered = true; @endphp
              @elseif($eventType === 'Corporate Event')
                <video src="image/2.mp4" autoplay muted loop playsinline class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300"></video>
                @php $previewRendered = true; @endphp
              @elseif($eventType === 'Birthday Party')
                <video src="image/1.mp4" autoplay muted loop playsinline class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300"></video>
                @php $previewRendered = true; @endphp
              @elseif($eventType === 'Graduation')
                <img src="image/mirror.webp" alt="Graduation" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300" />
                @php $previewRendered = true; @endphp
              @endif
              @if(!$previewRendered)
                @php
                  $first = $photosByEvent[$eventType][0] ?? null;
                  $img = $first ? ($first['image_url'] ?? (isset($first['image_path']) ? '/storage/'.$first['image_path'] : null)) : null;
                @endphp
                @if($img)
                  <img src="{{ $img }}" alt="{{ $eventType }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300" />
                @else
                  <img src="/image/image.jpg" alt="{{ $eventType }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300" />
                @endif
              @endif
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                <div class="p-6 text-white">
                  <h3 class="text-lg font-semibold">{{ $eventType }}</h3>
                  <p class="text-sm">Click to view photos</p>
                  <div class="flex items-center mt-2">
                    <span class="text-xs bg-primary/80 px-2 py-1 rounded-full">Click to view photos</span>
                  </div>
                </div>
              </div>
            </button>
          </div>
        @endforeach
      </div>
    </div>

    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-gradient-to-br from-orange-50 to-amber-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-800 mb-4">What Our Clients Say</h2>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Don't just take our word for it - hear from our satisfied customers!
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-6">"Amazing photo booth experience! The quality was outstanding and our guests loved the instant prints. Highly recommend!"</p>
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold mr-4">
            S
          </div>
          <div>
            <div class="font-semibold text-gray-800">Sarah Johnson</div>
            <div class="text-sm text-gray-600">Wedding Client</div>
          </div>
        </div>
      </div>
      
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-6">"Professional service from start to finish. The setup was seamless and the photos turned out perfect for our corporate event."</p>
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-r from-secondary to-accent rounded-full flex items-center justify-center text-white font-bold mr-4">
            M
          </div>
          <div>
            <div class="font-semibold text-gray-800">Mike Chen</div>
            <div class="text-sm text-gray-600">Corporate Client</div>
          </div>
        </div>
      </div>
      
      <div class="bg-white p-8 rounded-2xl shadow-lg">
        <div class="flex items-center mb-4">
          <div class="flex text-yellow-400">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
        <p class="text-gray-600 mb-6">"The best photo booth we've ever used! The props were hilarious and the social sharing feature was a huge hit with our guests."</p>
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-r from-accent to-primary rounded-full flex items-center justify-center text-white font-bold mr-4">
            E
          </div>
          <div>
            <div class="font-semibold text-gray-800">Emma Davis</div>
            <div class="text-sm text-gray-600">Birthday Party</div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-10 text-center">
      <button onclick="openFeedbackOverviewModal()" class="group relative overflow-hidden inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-primary via-secondary to-accent text-white font-bold text-lg hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-500">
        <div class="relative z-10 flex items-center gap-3">
          <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
            <i class="fas fa-comments text-xl group-hover:rotate-12 transition-transform duration-300"></i>
          </div>
          <span>View Client Feedback</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-accent via-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="absolute inset-0 bg-white/20 rounded-2xl blur-xl scale-0 group-hover:scale-100 transition-transform duration-500"></div>
      </button>
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 bg-gray-900 text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold mb-4">Ready to Create Memories?</h2>
      <p class="text-xl text-gray-300 max-w-3xl mx-auto">
        Get in touch with us to book your photo booth experience or ask any questions.
      </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
      <!-- Contact Form -->
       
      <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8">
        <h3 class="text-2xl font-bold mb-6">Send us a Message</h3>
        @if (session('status'))
          <div class="mb-4 rounded-lg bg-green-600/20 border border-green-600/30 text-green-200 px-4 py-3">
            {{ session('status') }}
          </div>
        @endif
        @if ($errors->any())
          <div class="mb-4 rounded-lg bg-red-600/20 border border-red-600/30 text-red-200 px-4 py-3">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form method="POST" action="{{ route('messages.store') }}" class="space-y-6">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium mb-2">First Name</label>
              <input name="first_name" value="{{ old('first_name') }}" type="text" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:border-primary" required>
            </div>
            <div>
              <label class="block text-sm font-medium mb-2">Last Name</label>
              <input name="last_name" value="{{ old('last_name') }}" type="text" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:border-primary" required>
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Email</label>
            <input name="email" value="{{ old('email') }}" type="email" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:border-primary" required>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Phone</label>
            <input name="phone" value="{{ old('phone') }}" type="tel" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:border-primary">
          </div>
          <div>
          <label class="block text-sm font-medium mb-2">Event Type</label>
          <select id="eventType" name="event_type"
            class="w-full px-4 py-3 rounded-lg bg-gray-700 border border-gray-500 text-white focus:outline-none focus:border-primary" required>
                  <option value="Wedding" {{ old('event_type')==='Wedding' ? 'selected' : '' }}>Wedding</option>
                  <option value="Corporate Event" {{ old('event_type')==='Corporate Event' ? 'selected' : '' }}>Corporate Event</option>
                  <option value="Birthday Party" {{ old('event_type')==='Birthday Party' ? 'selected' : '' }}>Birthday Party</option>
                  <option value="Graduation" {{ old('event_type')==='Graduation' ? 'selected' : '' }}>Graduation</option>
                  <option value="Other" {{ old('event_type')==='Other' ? 'selected' : '' }}>Other</option>
          </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2">Message</label>
            <textarea name="message" rows="4" class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:border-primary" required>{{ old('message') }}</textarea>
          </div>
          <button type="submit" class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
            Send Message
          </button>
        </form>
      </div>
      
      <!-- Contact Info -->
      <div class="space-y-8">
        <div>
          <h3 class="text-2xl font-bold mb-6">Get in Touch</h3>
          <p class="text-gray-300 mb-8">
            We're here to help you create the perfect photo booth experience for your special event.
          </p>
        </div>
        
        <div class="space-y-6">
          <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-phone text-white"></i>
            </div>
            <div>
              <div class="font-semibold">Phone</div>
              <div class="text-gray-300">
                @if (!empty($contactInfo['phone']))
                  <a href="tel:{{ $contactInfo['phone'] }}" class="hover:underline">{{ $contactInfo['phone'] }}</a>
                @else
                  (555) 123-4567
                @endif
              </div>
            </div>
          </div>
          
          <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-secondary to-accent rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-envelope text-white"></i>
            </div>
            <div>
              <div class="font-semibold">Email</div>
              <div class="text-gray-300">
                @if (!empty($contactInfo['email']))
                  <a href="mailto:{{ $contactInfo['email'] }}" class="hover:underline">{{ $contactInfo['email'] }}</a>
                @else
                  info@snapshotstudio.com
                @endif
              </div>
            </div>
          </div>
          
          <div class="flex items-center">
            <div class="w-12 h-12 bg-gradient-to-r from-accent to-primary rounded-full flex items-center justify-center mr-4">
              <i class="fas fa-map-marker-alt text-white"></i>
            </div>
            <div>
              <div class="font-semibold">Location</div>
              @if (!empty($contactInfo['address']))
                <a href="https://maps.google.com/?q={{ urlencode($contactInfo['address']) }}" target="_blank" class="text-gray-300 hover:underline">
                  {{ $contactInfo['address'] }}
                </a>
              @else
                <div class="text-gray-300">123 Photo Street, City, State 12345</div>
              @endif
            </div>
          </div>
        </div>
        
        <div class="pt-6">
          <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
          <div class="flex space-x-4">
            <a href= " https://www.facebook.com/profile.php?id=61565882637150    " class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
              <i class="fab fa-facebook-f text-white"></i>
            </a>
            <a href="https://www.instagram.com/" class="w-10 h-10 bg-gradient-to-r from-secondary to-accent rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
              <i class="fab fa-instagram text-white"></i>
            </a>
            <a href="https://x.com/" class="w-10 h-10 bg-gradient-to-r from-accent to-primary rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
              <i class="fab fa-twitter text-white"></i>
            </a>
          </div>
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
          <span class="text-xl font-bold">SnapShot Studio</span>
        </div>
        <p class="text-gray-300">
          Creating unforgettable memories through the art of photography.
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
      <p>&copy; 2024 SnapShot Studio. All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Public Feedback Modal -->
<div id="feedbackModal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
  <div class="relative min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full overflow-hidden">
      <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <div>
          <h3 class="text-2xl font-bold text-gray-900">Share Your Feedback</h3>
          <p class="text-gray-600 mt-1">Tell us how we did. Your review helps us improve.</p>
        </div>
        <button onclick="closeFeedbackModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>
      <form method="POST" action="{{ route('feedback.storePublic') }}" class="p-6 space-y-5">
        @csrf
        @if (session('status'))
          <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
          <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3">
            <ul class="list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
            <input name="name" value="{{ old('name') }}" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary" required>
          </div>
          <div>
            <label class="block text-sm font-medium mb-2 text-gray-700">Email (optional)</label>
            <input name="email" value="{{ old('email') }}" type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Rate Us</label>
          <div class="flex items-center gap-2" id="ratingStars">
            <input type="hidden" name="rating" id="ratingValue" value="{{ old('rating', 5) }}">
            <button type="button" data-value="1" class="star p-1 text-2xl text-amber-300">★</button>
            <button type="button" data-value="2" class="star p-1 text-2xl text-amber-300">★</button>
            <button type="button" data-value="3" class="star p-1 text-2xl text-amber-300">★</button>
            <button type="button" data-value="4" class="star p-1 text-2xl text-amber-300">★</button>
            <button type="button" data-value="5" class="star p-1 text-2xl text-amber-300">★</button>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Your Feedback</label>
          <textarea name="comment" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary" required>{{ old('comment') }}</textarea>
        </div>
        <div class="flex justify-end gap-3">
          <button type="button" onclick="closeFeedbackModal()" class="px-5 py-3 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Cancel</button>
          <button type="submit" class="px-5 py-3 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white">Submit</button>
        </div>
      </form>
    </div>
  </div>
 </div>

<!-- Feedback Overview Modal -->
<div id="feedbackOverviewModal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
  <div class="relative min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
      <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <div>
          <h3 class="text-2xl font-bold text-gray-900">Client Feedback Overview</h3>
          <p class="text-gray-600 mt-1">See what our clients are saying about us</p>
        </div>
        <div class="flex items-center gap-3">
          <button onclick="openFeedbackModal(); closeFeedbackOverviewModal()" class="group relative overflow-hidden inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary via-secondary to-accent text-white font-semibold text-sm hover:shadow-lg transform hover:scale-105 transition-all duration-300">
            <div class="relative z-10 flex items-center gap-2">
              <i class="fas fa-pen text-sm group-hover:rotate-12 transition-transform duration-300"></i>
              <span>Give Feedback</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-accent via-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </button>
          <button onclick="closeFeedbackOverviewModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>
      </div>
      
      <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
        <!-- Loading State -->
        <div id="feedbackLoading" class="text-center py-12">
          <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-gradient-to-r from-primary to-secondary">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading feedback...
          </div>
        </div>
        
        <!-- Empty State -->
        <div id="feedbackEmpty" class="hidden text-center py-12">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">No Feedback Yet</h3>
          <p class="text-gray-600">Be the first to share your experience with us!</p>
          <button onclick="closeFeedbackOverviewModal(); openFeedbackModal()" class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-primary via-secondary to-accent text-white font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300 mt-4">
            <div class="relative z-10 flex items-center gap-2">
              <i class="fas fa-pen text-sm group-hover:rotate-12 transition-transform duration-300"></i>
              <span>Give Feedback</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-accent via-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </button>
        </div>
        
        <!-- Feedback List -->
        <div id="feedbackList" class="hidden space-y-6">
          <!-- Feedback items will be populated here -->
        </div>
        
        <!-- Give Feedback CTA -->
        <div id="feedbackCTA" class="hidden text-center py-8 border-t border-gray-200 mt-8">
          <h4 class="text-lg font-semibold text-gray-900 mb-3">Share Your Experience</h4>
          <p class="text-gray-600 mb-4">Help others by sharing your feedback about our photo booth service</p>
          <button onclick="closeFeedbackOverviewModal(); openFeedbackModal()" class="group relative overflow-hidden inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-r from-primary via-secondary to-accent text-white font-bold text-lg hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 transition-all duration-500">
            <div class="relative z-10 flex items-center gap-3">
              <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-pen text-xl group-hover:rotate-12 transition-transform duration-300"></i>
              </div>
              <span>Give Feedback</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-accent via-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="absolute inset-0 bg-white/20 rounded-2xl blur-xl scale-0 group-hover:scale-100 transition-transform duration-500"></div>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="publicEventModal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-black/80 backdrop-blur-sm"></div>
  <div class="relative min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-6xl w-full max-h-[90vh] overflow-hidden">
      <div class="flex items-center justify-between p-6 border-b border-gray-200">
        <div>
          <h3 id="publicModalTitle" class="text-2xl font-bold text-gray-900">Event Gallery</h3>
          <p id="publicModalSubtitle" class="text-gray-600 mt-1">Photos from this event category</p>
        </div>
        <button onclick="closePublicEventModal()" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
        <div id="publicModalEmpty" class="hidden text-center py-12">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">No Photos Yet</h3>
          <p class="text-gray-600">Photos for this event type will appear here once uploaded.</p>
        </div>
        <div id="publicModalPhotos"></div>
      </div>
    </div>
  </div>
</div>

<style>
  .float-slow { animation: float 6s ease-in-out infinite; }
  @keyframes float { 0%,100%{ transform: translateY(0);} 50%{ transform: translateY(-15px);} }

  .fade-up { opacity: 0; transform: translateY(40px); transition: all 1s ease; }
  .fade-up.show { opacity: 1; transform: translateY(0); }
</style>

<!-- JS: Parallax + Scroll Fade -->
<script>
  // Parallax
  document.addEventListener("mousemove", (e) => {
    document.querySelectorAll(".parallax-element").forEach(el => {
      const speed = parseFloat(el.getAttribute("data-speed"));
      const x = (window.innerWidth - e.pageX * speed) / 100;
      const y = (window.innerHeight - e.pageY * speed) / 100;
      el.style.transform = `translate(${x}px, ${y}px)`;
    });
  });

  // Fade in on scroll
  const fadeElements = document.querySelectorAll(".fade-up");
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add("show");
    });
  }, { threshold: 0.2 });
  fadeElements.forEach(el => observer.observe(el));
</script>

<script>
  const PHOTOS_BY_EVENT = @json($photosByEvent ?? []);
  function openPublicEventModal(eventType){
    const titleMap = {
      'Wedding': 'Wedding Celebration Gallery',
      'Corporate Event': 'Corporate Events Gallery',
      'Birthday Party': 'Birthday Parties Gallery',
      'Graduation': 'Graduation Gallery',
      'Other': 'Special Events Gallery'
    };
    document.getElementById('publicModalTitle').textContent = titleMap[eventType] || 'Event Gallery';
    document.getElementById('publicModalSubtitle').textContent = 'Click any photo to view in full';

    const container = document.getElementById('publicModalPhotos');
    const empty = document.getElementById('publicModalEmpty');
    const photos = PHOTOS_BY_EVENT[eventType] || [];

    if(photos.length === 0){
      empty.classList.remove('hidden');
      container.innerHTML = '';
    } else {
      empty.classList.add('hidden');
      container.innerHTML = `<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">${photos.map(p => `
        <div class=\"bg-gray-50 rounded-lg p-3\">
          <img src=\"${p.image_url || ('/storage/' + p.image_path)}\" alt=\"${p.title || ''}\" class=\"w-full h-48 object-cover rounded-md mb-3\">
          ${p.title ? `<h4 class=\"font-semibold text-gray-900\">${p.title}</h4>` : ''}
          ${p.description ? `<p class=\"text-sm text-gray-600\">${p.description}</p>` : ''}
        </div>`).join('')}</div>`;
    }
    const modal = document.getElementById('publicEventModal');
    modal.classList.remove('hidden');
    lockScroll();
  }
  function closePublicEventModal(){
    const modal = document.getElementById('publicEventModal');
    modal.classList.add('hidden');
    unlockScroll();
  }
  document.getElementById('publicEventModal').addEventListener('click', function(e){
    if(e.target === this){ closePublicEventModal(); }
  });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape') closePublicEventModal(); });

  // Prevent background scroll when modal is open
  let _scrollLock = { handler: null };
  function lockScroll(){
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
    if(!_scrollLock.handler){
      _scrollLock.handler = function(ev){
        const modal = document.getElementById('publicEventModal');
        if (modal && modal.contains(ev.target)) {
          // Allow scroll inside modal content
          return;
        }
        ev.preventDefault();
      };
      window.addEventListener('wheel', _scrollLock.handler, { passive: false });
      window.addEventListener('touchmove', _scrollLock.handler, { passive: false });
    }
  }
  function unlockScroll(){
    document.documentElement.classList.remove('overflow-hidden');
    document.body.classList.remove('overflow-hidden');
    if(_scrollLock.handler){
      window.removeEventListener('wheel', _scrollLock.handler, { passive: false });
      window.removeEventListener('touchmove', _scrollLock.handler, { passive: false });
      _scrollLock.handler = null;
    }
  }
</script>

<script>
  // Feedback modal controls
  function openFeedbackModal(){ document.getElementById('feedbackModal').classList.remove('hidden'); }
  function closeFeedbackModal(){ document.getElementById('feedbackModal').classList.add('hidden'); }
  document.addEventListener('click', (e) => {
    const modal = document.getElementById('feedbackModal');
    if (!modal) return;
    if (e.target === modal) closeFeedbackModal();
  });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeFeedbackModal(); });

  // Feedback overview modal controls
  function openFeedbackOverviewModal(){ 
    document.getElementById('feedbackOverviewModal').classList.remove('hidden');
    loadFeedbackData();
  }
  function closeFeedbackOverviewModal(){ 
    document.getElementById('feedbackOverviewModal').classList.add('hidden');
  }
  document.addEventListener('click', (e) => {
    const modal = document.getElementById('feedbackOverviewModal');
    if (!modal) return;
    if (e.target === modal) closeFeedbackOverviewModal();
  });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeFeedbackOverviewModal(); });

  // Load feedback data
  async function loadFeedbackData() {
    const loading = document.getElementById('feedbackLoading');
    const empty = document.getElementById('feedbackEmpty');
    const list = document.getElementById('feedbackList');
    const cta = document.getElementById('feedbackCTA');
    
    // Show loading state
    loading.classList.remove('hidden');
    empty.classList.add('hidden');
    list.classList.add('hidden');
    cta.classList.add('hidden');
    
    try {
      const response = await fetch('/feedback/overview');
      const feedback = await response.json();
      
      if (feedback.length === 0) {
        loading.classList.add('hidden');
        empty.classList.remove('hidden');
        return;
      }
      
      // Hide loading and show feedback list
      loading.classList.add('hidden');
      list.classList.remove('hidden');
      cta.classList.remove('hidden');
      
      // Populate feedback list
      list.innerHTML = feedback.map(item => `
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-all duration-300">
          <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-lg">
                ${item.name.charAt(0).toUpperCase()}
              </div>
              <div>
                <h4 class="font-semibold text-gray-900">${item.name}</h4>
                <p class="text-sm text-gray-500">${item.email || 'Anonymous'}</p>
              </div>
            </div>
            <div class="flex items-center gap-1">
              ${generateStars(item.rating)}
            </div>
          </div>
          <p class="text-gray-700 leading-relaxed">"${item.comment}"</p>
          <div class="mt-4 text-xs text-gray-400">
            ${new Date(item.created_at).toLocaleDateString('en-US', { 
              year: 'numeric', 
              month: 'long', 
              day: 'numeric' 
            })}
          </div>
        </div>
      `).join('');
      
    } catch (error) {
      console.error('Error loading feedback:', error);
      loading.classList.add('hidden');
      empty.classList.remove('hidden');
      document.getElementById('feedbackEmpty').innerHTML = `
        <div class="text-center py-12">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Error Loading Feedback</h3>
          <p class="text-gray-600">Something went wrong. Please try again later.</p>
          <button onclick="loadFeedbackData()" class="mt-4 inline-flex items-center gap-2 px-4 py-3 rounded-lg bg-gradient-to-r from-primary to-secondary text-white font-medium hover:shadow-lg transition-all">
            <i class="fas fa-redo"></i>
            Retry
          </button>
        </div>
      `;
    }
  }

  // Generate star rating display
  function generateStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
      if (i <= rating) {
        stars += '<i class="fas fa-star text-amber-400"></i>';
      } else {
        stars += '<i class="far fa-star text-gray-300"></i>';
      }
    }
    return stars;
  }

  // Star rating logic
  (function(){
    const stars = document.querySelectorAll('#ratingStars .star');
    const input = document.getElementById('ratingValue');
    if(!stars.length || !input) return;
    function paint(value){
      stars.forEach(star => {
        const v = parseInt(star.dataset.value);
        star.style.color = v <= value ? '#f59e0b' : '#d1d5db';
      });
    }
    paint(parseInt(input.value || '5'));
    stars.forEach(star => {
      star.addEventListener('mouseenter', () => paint(parseInt(star.dataset.value)));
      star.addEventListener('mouseleave', () => paint(parseInt(input.value || '5')));
      star.addEventListener('click', () => { input.value = star.dataset.value; paint(parseInt(input.value)); });
    });
  })();
  // Gallery Carousel Controls
  const carousel = document.getElementById('galleryCarousel');
  function carouselNext(){ if(!carousel) return; carousel.scrollBy({ left: carousel.clientWidth * 0.9, behavior: 'smooth' }); }
  function carouselPrev(){ if(!carousel) return; carousel.scrollBy({ left: -carousel.clientWidth * 0.9, behavior: 'smooth' }); }

  // Enhanced Mobile Menu Controller
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
      this.menuBtn.classList.toggle('active');
    }

    closeMenu() {
      this.mobileMenu.classList.add('hidden');
      this.menuBtn.classList.remove('active');
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


  // Improved Smooth Scroll for Navbar Links
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(link => {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href.length > 1 && document.querySelector(href)) {
          // Add click animation
          this.classList.remove('navbar-click-animate');
          void this.offsetWidth;
          this.classList.add('navbar-click-animate');
          this.addEventListener('animationend', function handler() {
            this.classList.remove('navbar-click-animate');
            this.removeEventListener('animationend', handler);
          });
          e.preventDefault();
          const target = document.querySelector(href);
          const nav = document.querySelector('nav');
          const navHeight = nav ? nav.offsetHeight : 0;
          const rect = target.getBoundingClientRect();
          const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
          const top = rect.top + scrollTop - navHeight - 10; // 10px extra spacing
          window.scrollTo({ top, behavior: 'smooth' });
        }
      });
    });
  });

  // Enhanced Parallax Controller
  class ParallaxController {
    constructor() {
      this.parallaxElements = document.querySelectorAll('.parallax-element');
      this.mouseX = 0;
      this.mouseY = 0;
      this.scrollY = 0;
      this.init();
    }

    init() {
      this.bindEvents();
      this.animate();
    }

    bindEvents() {
      window.addEventListener('scroll', this.handleScroll.bind(this));
      window.addEventListener('mousemove', this.handleMouseMove.bind(this));
      window.addEventListener('resize', this.handleResize.bind(this));
    }

    handleScroll() {
      this.scrollY = window.pageYOffset;
      this.updateParallax();
    }

    handleMouseMove(e) {
      this.mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
      this.mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
      this.updateMouseParallax();
    }

    handleResize() {
      this.updateParallax();
    }

    updateParallax() {
      this.parallaxElements.forEach((element) => {
        const speed = element.dataset.speed || 0.5;
        const yPos = -(this.scrollY * speed);
        const scale = 1 + (this.scrollY * 0.0001);
        
        element.style.transform = `translateY(${yPos}px) scale(${scale})`;
      });
    }

    updateMouseParallax() {
      document.querySelectorAll('.mouse-parallax').forEach((element) => {
        const speed = element.dataset.mouseSpeed || 20;
        const x = this.mouseX * speed;
        const y = this.mouseY * speed;
        
        element.style.transform = `translate(${x}px, ${y}px)`;
      });
    }

    animate() {
      requestAnimationFrame(this.animate.bind(this));
    }
  }

  // Enhanced Navbar Controller
  class NavbarController {
    constructor() {
      this.navbar = document.querySelector('nav');
      this.lastScrollY = 0;
      this.init();
    }

    init() {
      this.bindEvents();
    }

    bindEvents() {
      window.addEventListener('scroll', this.handleScroll.bind(this));
    }

    handleScroll() {
      const currentScrollY = window.pageYOffset;
      
      if (currentScrollY > this.lastScrollY && currentScrollY > 100) {
        this.navbar.classList.add('navbar-hidden');
      } else {
        this.navbar.classList.remove('navbar-hidden');
      }
      
      if (currentScrollY > 50) {
        this.navbar.classList.add('navbar-scrolled');
      } else {
        this.navbar.classList.remove('navbar-scrolled');
      }
      
      this.lastScrollY = currentScrollY;
    }
  }

  // Intersection Observer for Animations
  class AnimationController {
    constructor() {
      this.animatedElements = document.querySelectorAll('.animate-on-scroll');
      this.init();
    }

    init() {
      this.createObserver();
    }

    createObserver() {
      const options = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
            observer.unobserve(entry.target);
          }
        });
      }, options);

      this.animatedElements.forEach(element => {
        observer.observe(element);
      });
    }
  }

  // Typing Effect
  class TypingEffect {
    constructor(element, text, speed = 100) {
      this.element = element;
      this.text = text;
      this.speed = speed;
      this.currentIndex = 0;
      this.init();
    }

    init() {
      this.type();
    }

    type() {
      if (this.currentIndex < this.text.length) {
        this.element.textContent += this.text.charAt(this.currentIndex);
        this.currentIndex++;
        setTimeout(() => this.type(), this.speed);
      }
    }
  }

  // Initialize all controllers when DOM is loaded
  document.addEventListener('DOMContentLoaded', () => {
    new MobileMenuController();
    new ParallaxController();
    new NavbarController();
    new AnimationController();
    // Initialize typing effect
    const typingElement = document.querySelector('.typing-effect');
    if (typingElement) {
      new TypingEffect(typingElement, 'AD', 150);
    }
    // Add loading animation
    document.body.classList.add('loaded');

    // Auto-open feedback modal on redirect with status/errors
    try {
      const shouldOpen = {{ session('openFeedback', false) ? 'true' : 'false' }};
      if (shouldOpen) { openFeedbackModal(); }
    } catch (e) {}
  });

  // Utility functions
  window.utils = {
    debounce: (func, wait) => {
      let timeout;
      return function executedFunction(...args) {
        const later = () => {
          clearTimeout(timeout);
          func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
      };
    },
    
    throttle: (func, limit) => {
      let inThrottle;
      return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
          func.apply(context, args);
          inThrottle = true;
          setTimeout(() => inThrottle = false, limit);
        }
      };
    }
  };
</script>

</body>
</html>
