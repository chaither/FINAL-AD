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
  </style>
</head>
<body class="parallax min-h-screen">

  <!-- Dashboard Button -->
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b border-gray-200 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-3">
            <div class="flex items-center gap-3 mr-2">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="font-semibold text-gray-800">Admin</span>
            </div>
            <div class="ml-auto text-sm">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Back to dashboard</a>
            </div>
        </div>
    </header>

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

      <!-- Form -->
      <form method="POST" action="{{ route('contact-info.update') }}" class="space-y-6">
        @csrf
        @method('PUT')
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
        <div class="text-right">
          <button type="submit" class="px-6 py-2 rounded-xl bg-gradient-to-r from-primary via-secondary to-accent text-white font-semibold shadow hover:opacity-90 transition">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
