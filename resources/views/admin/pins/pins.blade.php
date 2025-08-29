<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin • Pins</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: '#8a4813ff', secondary: '#944403ff', accent: '#8b4d05ff' },
          }
        }
      }
    </script>
    <style>
        body { font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Inter, Helvetica, Arial, Noto Sans, sans-serif; }
        .parallax { background-image: linear-gradient(to bottom right, #fff7ed, #fffbeb); }
        .parallax::before {
            content: ""; position: fixed; inset: 0; z-index: -1;
            background: radial-gradient(600px 200px at 10% 10%, rgba(138,72,19,.08), transparent),
                        radial-gradient(700px 250px at 90% 20%, rgba(148,68,3,.07), transparent),
                        radial-gradient(800px 300px at 40% 80%, rgba(139,77,5,.06), transparent);
        }
        .parallax-element { position: fixed; inset: 0; z-index: -1; pointer-events: none; overflow: hidden; }
        .note { transform: rotate(var(--tilt, -1deg)); transition: transform .2s ease, box-shadow .2s ease; }
        .note:hover { transform: rotate(0deg) translateY(-2px); box-shadow: 0 20px 35px rgba(0,0,0,.08); }
        .tape::before { content: ""; position: absolute; inset: -12px auto auto 50%; translate: -50% 0; width: 80px; height: 24px; background: rgba(255,255,255,.8); box-shadow: 0 4px 8px rgba(0,0,0,.08); transform: rotate(-3deg); }
        .paper { background: #fff; background-image: linear-gradient(#f5f5f4 1px, transparent 1px); background-size: 100% 28px; }
    </style>
</head>
<body class="parallax min-h-screen">
    <div class="parallax-element">
        <div class="absolute top-24 left-10 w-40 h-40 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 blur-2xl" data-speed=".25"></div>
        <div class="absolute bottom-24 right-20 w-56 h-56 rounded-full bg-gradient-to-br from-accent/20 to-primary/20 blur-3xl" data-speed=".15"></div>
    </div>
    <header class="sticky top-0 z-40 bg-white/70 backdrop-blur border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-3">
            <div class="flex items-center gap-3 mr-2">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center font-bold text-primary">AD</div>
                <span class="font-semibold text-gray-800">Admin</span>
            </div>
            <div class="ml-auto text-sm flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Dashboard</a>
                <a href="{{ route('messages.index') }}" class="px-3 py-1.5 rounded-lg ring-1 ring-gray-300 hover:bg-gray-50">Messages</a>
            </div>
        </div>
    </header>



    <main class="max-w-7xl mx-auto px-4 py-8 flex gap-8">
        <!-- Sticky Pins Form (left) -->
        <aside class="w-full md:w-80 shrink-0">
            <div class="sticky top-24 z-10">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold">Sticky Pins</h1>
                    <p class="text-sm text-gray-500">Create quick notes and reminders. They appear here as sticky notes.</p>
                </div>
                <div class="bg-white/80 backdrop-blur ring-1 ring-gray-200 rounded-2xl p-4 mb-6 shadow-lg">
                    <form method="POST" action="{{ route('pins.store') }}" class="flex flex-col gap-3">
                        @csrf
                        <input name="title" placeholder="Title" class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:outline-none" required>
                        <input name="content" placeholder="Optional content" class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:outline-none">
                        <button class="bg-gradient-to-r from-primary via-secondary to-accent text-white px-4 py-2 rounded-lg">Add Pin</button>
                    </form>
                </div>
            </div>
        </aside>
        <!-- Pins Notes (right) -->
        <section class="flex-1 min-h-[70vh]">
            <div class="h-full flex flex-col gap-4 relative">
                @if($pins->isEmpty())
                    <div class="text-center text-gray-500 py-20">
                        <div class="mx-auto w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 012 0v5h4a1 1 0 010 2h-4v5a1 1 0 11-2 0V9H5a1 1 0 010-2h4V2z"/></svg>
                        </div>
                        No pins yet. Create your first sticky note.
                    </div>
                @else
                    <div class="flex flex-col gap-4 relative">
                        @foreach($pins as $index => $pin)
                            <div class="relative bg-yellow-100/90 paper ring-1 ring-yellow-200 rounded-xl p-4 shadow-lg">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <div class="font-semibold text-yellow-900">{{ $pin->title }}</div>
                                        @if($pin->content)
                                            <div class="text-sm text-yellow-900/80 mt-1">{{ $pin->content }}</div>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('pins.destroy', $pin) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-yellow-900/60 hover:text-red-600" title="Remove">✕</button>
                                    </form>
                                </div>
                                <div class="text-xs text-yellow-900/60 mt-3">{{ $pin->created_at->diffForHumans() }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </main>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const elements = Array.from(document.querySelectorAll('.parallax-element > div'));
        const update = () => {
          const y = window.scrollY || window.pageYOffset;
          elements.forEach(el => {
            const speed = parseFloat(el.dataset.speed || 0.2);
            el.style.transform = `translateY(${-(y * speed)}px)`;
          });
          requestAnimationFrame(update);
        };
        update();
      });
    </script>
</body>
</html>


