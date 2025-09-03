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
