<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Admin Dashboard</title>
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
                    <a href="{{ route('packages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium">
                        <span class="inline-flex w-5"><svg class="w-5 h-5 text-primary" viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v7a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm2 3h4v2H6V7zm0 3h8v2H6v-2z"/></svg></span>
                        Packages
                    </a>
                    <a href="{{ route('photos.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-primary/5 text-gray-700">
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
                    <h1 class="text-2xl font-bold text-gray-900">Manage Packages & Pricing</h1>
                    <p class="text-gray-600 mt-1">Create and manage your photobooth service packages</p>
                </div>
                
            </div>
            
            <!-- Public Page Summary -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="font-medium text-blue-900">Public Page Status</h3>
                            <p class="text-sm text-blue-700">
                                {{ $packages->where('is_active', true)->count() }} of {{ $packages->count() }} packages are currently visible on your welcome page
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="/" target="_blank" class="px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            View Public Page
                        </a>
                        <a href="{{ route('packages.create') }}" class="px-3 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Add New Package
                        </a>
                    </div>
                </div>
                
                <!-- Quick Preview of Public Packages -->
                @if($packages->where('is_active', true)->count() > 0)
                    <div class="mt-4 pt-4 border-t border-blue-200">
                        <h4 class="text-sm font-medium text-blue-900 mb-3">Currently Visible on Public Page:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach($packages->where('is_active', true) as $package)
                                <div class="bg-white rounded-lg p-3 border border-blue-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <h5 class="font-medium text-blue-900 text-sm">{{ $package->name }}</h5>
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">₱{{ number_format($package->price, 2) }}</span>
                                    </div>
                                    <p class="text-xs text-blue-700 mb-2">{{ $package->description }}</p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('packages.edit', $package) }}" class="text-xs text-blue-600 hover:text-blue-800 underline">Edit</a>
                                        <a href="/" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 underline">View on Page</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse($packages as $package)
                    <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl p-6 hover-lift animate-on-scroll">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $package->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ $package->description }}</p>
                                
                                @if($package->duration)
                                    <div class="text-sm text-gray-500 mb-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $package->duration }}
                                    </div>
                                @endif

                                <div class="text-2xl font-bold text-primary mb-4">₱{{ number_format($package->price, 2) }}</div>

                                @if($package->features && is_array($package->features) && count($package->features) > 0)
                                    <div class="space-y-2 mb-4">
                                        @foreach($package->features as $feature)
                                            @if(!empty(trim($feature)))
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $feature }}
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2 ml-4">
                                <form action="{{ route('packages.toggle-status', $package) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-lg {{ $package->is_active ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }} hover:bg-opacity-80 transition-colors">
                                        @if($package->is_active)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        @else
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                            <a href="{{ route('packages.edit', $package) }}" class="flex-1 px-3 py-2 text-center text-sm bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('packages.destroy', $package) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this package?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 text-center text-sm bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                        
                        <!-- Public Page Status -->
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-500">Public Page Status:</span>
                                @if($package->is_active)
                                    <span class="text-green-600 font-medium">✓ Visible on Welcome Page</span>
                                @else
                                    <span class="text-red-600 font-medium">✗ Hidden from Public</span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <a href="/" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 underline">
                                    View on Public Page →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-xl p-12 text-center animate-on-scroll">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No packages yet</h3>
                        <p class="text-gray-600 mb-6">Get started by creating your first photobooth package</p>
                        <a href="{{ route('packages.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary via-secondary to-accent text-white rounded-lg hover:shadow-lg transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Create First Package
                        </a>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
