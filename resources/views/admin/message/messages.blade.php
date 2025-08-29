<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin • Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: '#8a4813ff', secondary: '#944403ff', accent: '#8b4d05ff' }
          }
        }
      }
    </script>
</head>
<body class="bg-gray-50">
        <!-- Figma-style SVG Parallax Background -->
        <div class="absolute inset-0 -z-20 pointer-events-none select-none">
            <svg width="100%" height="100%" viewBox="0 0 1440 900" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <defs>
                    <linearGradient id="msg-grad1" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#ffe5b4"/>
                        <stop offset="100%" stop-color="#fff7e6"/>
                    </linearGradient>
                    <linearGradient id="msg-grad2" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#f7c873"/>
                        <stop offset="100%" stop-color="#fbeee0"/>
                    </linearGradient>
                </defs>
                <ellipse cx="350" cy="180" rx="320" ry="140" fill="url(#msg-grad1)" opacity="0.7" class="parallax-ell1"/>
                <ellipse cx="1200" cy="120" rx="200" ry="90" fill="url(#msg-grad2)" opacity="0.5" class="parallax-ell2"/>
                <ellipse cx="900" cy="700" rx="350" ry="120" fill="#fff7e6" opacity="0.4" class="parallax-ell3"/>
            </svg>
        </div>

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

        <div class="relative max-w-6xl mx-auto p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-extrabold tracking-tight text-primary drop-shadow-sm flex items-center gap-2">
                    <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 10.5l-9 5-9-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Messages
                </h1>
                <div class="flex items-center gap-3">
                    <button id="openSearchModal" class="px-4 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white shadow hover:scale-105 transition">Search</button>
                    <div class="text-sm text-gray-500 bg-white/80 px-4 py-2 rounded-xl shadow border border-gray-200">Total: {{ $messages->total() }}</div>
                </div>
        <!-- Search Modal -->
        <div id="searchModal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close-search></div>
            <div class="relative max-w-md mx-auto mt-24 bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl ring-1 ring-primary/10 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-primary/20 to-secondary/30 rounded-full blur-2xl z-0 parallax-float" data-speed="0.18"></div>
                <div class="relative p-6 z-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-primary">Search Messages</h2>
                        <button class="text-gray-500 hover:text-gray-700" data-close-search aria-label="Close">✕</button>
                    </div>
                    <form method="GET" action="" class="space-y-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1" for="search_name">Name</label>
                            <input type="text" id="search_name" name="name" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" placeholder="Enter name">
                        </div>
                        <div class="relative">
                            <label class="block text-xs text-gray-500 mb-1" for="search_event">Event</label>
                            <input type="text" id="search_event" name="event" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary" placeholder="Select event type" autocomplete="off">
                            <div id="eventOptions" class="absolute left-0 right-0 mt-1 bg-white border border-gray-200 rounded-lg shadow-lg z-20 hidden">
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Wedding">Wedding</div>
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Corporate">Corporate</div>
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Birthday">Birthday</div>
                                <div class="cursor-pointer px-4 py-2 hover:bg-primary/10" data-value="Other">Other</div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1" for="search_date">Date</label>
                            <input type="date" id="search_date" name="date" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">
                        </div>
                        <div class="flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white">Search</button>
                            <button type="button" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50" data-close-search>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>

            <div class="relative bg-white/95 backdrop-blur-xl ring-1 ring-primary/10 rounded-3xl shadow-2xl overflow-hidden px-2 py-6 md:p-8" style="box-shadow:0 8px 40px 0 rgba(140,80,20,0.10);">
                <!-- Show current search criteria and Clear All button -->
                @if(request('name') || request('event') || request('date'))
                    <div class="flex flex-wrap items-center justify-between mb-4 gap-2 bg-primary/5 px-4 py-3 rounded-xl border border-primary/10">
                        <div class="text-sm text-primary flex flex-wrap gap-3 items-center">
                            <span class="font-semibold">Search:</span>
                            @if(request('name'))
                                <span class="inline-flex items-center bg-primary/10 rounded px-2 py-1 mr-1">
                                    Name: <span class="font-bold ml-1">{{ request('name') }}</span>
                                    <a href="{{ route('messages.index', array_filter(request()->except('name'))) }}" class="ml-2 text-xs text-primary hover:text-red-600 font-bold" title="Remove name filter">×</a>
                                </span>
                            @endif
                            @if(request('event'))
                                <span class="inline-flex items-center bg-primary/10 rounded px-2 py-1 mr-1">
                                    Event: <span class="font-bold ml-1">{{ request('event') }}</span>
                                    <a href="{{ route('messages.index', array_filter(request()->except('event'))) }}" class="ml-2 text-xs text-primary hover:text-red-600 font-bold" title="Remove event filter">×</a>
                                </span>
                            @endif
                            @if(request('date'))
                                <span class="inline-flex items-center bg-primary/10 rounded px-2 py-1 mr-1">
                                    Date: <span class="font-bold ml-1">{{ request('date') }}</span>
                                    <a href="{{ route('messages.index', array_filter(request()->except('date'))) }}" class="ml-2 text-xs text-primary hover:text-red-600 font-bold" title="Remove date filter">×</a>
                                </span>
                            @endif
                        </div>
                        <a href="{{ route('messages.index') }}" class="ml-auto px-3 py-1.5 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white text-xs font-semibold shadow hover:scale-105 transition">Clear All</a>
                    </div>
                @endif
                <!-- Parallax floating shapes -->
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-gradient-to-br from-primary/20 to-secondary/30 rounded-full blur-2xl z-0 parallax-float" data-speed="0.2"></div>
                <div class="absolute -bottom-16 right-10 w-56 h-56 bg-gradient-to-br from-accent/20 to-primary/10 rounded-full blur-3xl z-0 parallax-float" data-speed="0.3"></div>
                <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-gradient-to-br from-secondary/20 to-accent/20 rounded-full blur-2xl z-0 parallax-float" data-speed="0.15"></div>

                <div class="relative z-10 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-primary/10 to-secondary/10">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Name</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Phone</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Event</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-primary uppercase tracking-wider">Created</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($messages as $msg)
                                <tr class="hover:bg-primary/5 transition">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <button type="button"
                                            class="open-message text-black hover:underline font-semibold"
                                            data-name="{{ $msg->first_name }} {{ $msg->last_name }}"
                                            data-email="{{ $msg->email }}"
                                            data-phone="{{ $msg->phone }}"
                                            data-event="{{ $msg->event_type }}"
                                            data-message="{{ $msg->message }}"
                                            data-created="{{ $msg->created_at->format('Y-m-d H:i') }}">
                                            {{ $msg->first_name }} {{ $msg->last_name }}
                                        </button>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap"><a href="mailto:{{ $msg->email }}" class="text-primary hover:underline">{{ $msg->email }}</a></td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $msg->phone }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $msg->event_type }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $msg->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                                        <div class="mx-auto w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.94 6.34A2 2 0 014.6 5h10.8a2 2 0 011.66.94L10 11.5 2.94 6.34zM2 7.92V14a2 2 0 002 2h12a2 2 0 002-2V7.92l-7.4 4.93a2 2 0 01-2.2 0L2 7.92z"/></svg>
                                        </div>
                                        No messages yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4">{{ $messages->links() }}</div>
            </div>
        </div>

        <!-- Message Modal -->
        <div id="messageModal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" data-close-modal></div>
            <div class="relative max-w-2xl mx-auto mt-20 bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl ring-1 ring-primary/10 overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-primary/20 to-secondary/30 rounded-full blur-2xl z-0 parallax-float" data-speed="0.18"></div>
                <div class="relative p-6 z-10">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="text-xs uppercase tracking-wider text-gray-500">Message from</div>
                            <h3 class="text-2xl font-bold text-gray-800" id="modalName">Name</h3>
                        </div>
                        <button class="text-gray-500 hover:text-gray-700" data-close-modal aria-label="Close">✕</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Email</div>
                            <div class="font-medium"><a id="modalEmail" class="text-primary hover:underline" href="#"></a></div>
                        </div>
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Phone</div>
                            <div class="font-medium" id="modalPhone">—</div>
                        </div>
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Event</div>
                            <div class="font-medium" id="modalEvent">—</div>
                        </div>
                        <div class="bg-white/80 rounded-lg p-4 ring-1 ring-gray-200">
                            <div class="text-xs text-gray-500">Received</div>
                            <div class="font-medium" id="modalCreated">—</div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-5 ring-1 ring-gray-200">
                        <div class="text-xs text-gray-500 mb-2">Message</div>
                        <p class="leading-relaxed text-gray-800 whitespace-pre-wrap" id="modalMessage"></p>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <!-- Save Note Button -->
                        <button id="modalSaveNote" type="button" class="px-4 py-2 rounded-lg bg-gradient-to-r from-primary via-secondary to-accent text-white">Save Note</button>
                        <a id="modalReply" href="#"></a>
                        <button class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50" data-close-modal>Close</button>
                        <!-- Hidden form for saving pin -->
                        <form id="saveNoteForm" action="{{ route('pins.store') }}" method="POST" class="hidden">
                            @csrf
                            <input type="hidden" name="title" id="pinTitle">
                            <input type="hidden" name="note" id="pinNote">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Search Modal logic and event dropdown
            document.addEventListener('DOMContentLoaded', () => {
                const searchModal = document.getElementById('searchModal');
                const openSearchBtn = document.getElementById('openSearchModal');
                const closeSearchEls = searchModal.querySelectorAll('[data-close-search]');
                openSearchBtn.addEventListener('click', () => {
                    searchModal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                });
                const closeSearch = () => { searchModal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); };
                closeSearchEls.forEach(el => el.addEventListener('click', closeSearch));
                window.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !searchModal.classList.contains('hidden')) closeSearch(); });

                // Event dropdown logic
                const eventInput = document.getElementById('search_event');
                const eventOptions = document.getElementById('eventOptions');
                let eventDropdownOpen = false;

                function showEventOptions() {
                    eventOptions.classList.remove('hidden');
                    eventDropdownOpen = true;
                }
                function hideEventOptions() {
                    setTimeout(() => {
                        eventOptions.classList.add('hidden');
                        eventDropdownOpen = false;
                    }, 120); // Delay to allow click
                }
                eventInput.addEventListener('focus', showEventOptions);
                eventInput.addEventListener('input', showEventOptions);
                eventInput.addEventListener('blur', hideEventOptions);
                eventInput.addEventListener('mouseenter', showEventOptions);
                eventInput.addEventListener('mouseleave', () => { if (!eventDropdownOpen) hideEventOptions(); });
                eventOptions.addEventListener('mouseenter', showEventOptions);
                eventOptions.addEventListener('mouseleave', hideEventOptions);
                eventOptions.querySelectorAll('[data-value]').forEach(opt => {
                    opt.addEventListener('mousedown', function(e) {
                        e.preventDefault();
                        eventInput.value = this.dataset.value;
                        eventOptions.classList.add('hidden');
                        eventDropdownOpen = false;
                    });
                });
            });
            // Parallax effect for floating shapes
            document.addEventListener('mousemove', function(e) {
                document.querySelectorAll('.parallax-float').forEach(function(el) {
                    const speed = parseFloat(el.dataset.speed || 0.2);
                    const x = (window.innerWidth / 2 - e.clientX) * speed;
                    const y = (window.innerHeight / 2 - e.clientY) * speed;
                    el.style.transform = `translate(${x}px, ${y}px)`;
                });
            });

            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('messageModal');
                const openButtons = document.querySelectorAll('.open-message');
                const closeEls = modal.querySelectorAll('[data-close-modal]');
                const nameEl = document.getElementById('modalName');
                const emailEl = document.getElementById('modalEmail');
                const phoneEl = document.getElementById('modalPhone');
                const eventEl = document.getElementById('modalEvent');
                const createdEl = document.getElementById('modalCreated');
                const messageEl = document.getElementById('modalMessage');
                const replyEl = document.getElementById('modalReply');
                const saveNoteBtn = document.getElementById('modalSaveNote');
                const saveNoteForm = document.getElementById('saveNoteForm');
                const pinTitleInput = document.getElementById('pinTitle');
                const pinNoteInput = document.getElementById('pinNote');

                const openModal = (data) => {
                    nameEl.textContent = data.name || 'Unknown';
                    emailEl.textContent = data.email || '—';
                    emailEl.href = data.email ? `mailto:${data.email}` : '#';
                    phoneEl.textContent = data.phone || '—';
                    eventEl.textContent = data.event || '—';
                    createdEl.textContent = data.created || '—';
                    messageEl.textContent = data.message || '';
                    if (data.email) replyEl.href = `mailto:${data.email}`; else replyEl.removeAttribute('href');
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    // Store current modal data for Save Note
                    // Title: Name (Event)
                    // Note: Message content
                    saveNoteBtn.dataset.title = data.name ? `${data.name} (${data.event || ''})` : 'Note';
                    // Combine message for display in pin note
                    saveNoteBtn.dataset.note = (data.message ? data.message : '') + (data.email ? `\nEmail: ${data.email}` : '') + (data.phone ? `\nPhone: ${data.phone}` : '');
                };

                openButtons.forEach(btn => btn.addEventListener('click', () => {
                    openModal({
                        name: btn.dataset.name,
                        email: btn.dataset.email,
                        phone: btn.dataset.phone,
                        event: btn.dataset.event,
                        message: btn.dataset.message,
                        created: btn.dataset.created,
                    });
                }));

                const closeModal = () => { modal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); };
                closeEls.forEach(el => el.addEventListener('click', closeModal));
                window.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });

                // Save Note logic
                saveNoteBtn.addEventListener('click', function() {
                    // Fill hidden form with modal data
                    pinTitleInput.value = this.dataset.title || nameEl.textContent;
                    pinNoteInput.value = this.dataset.note || messageEl.textContent;
                    saveNoteForm.submit();
                });
            });
        </script>
</body>
</html>


