<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Kriya.Lokal — Platform budaya lokal yang membantu UMKM mengemas identitas dan nilai budaya Indonesia melalui storytelling visual dan digital engagement.">
    <title>@yield('title', 'Kriya.Lokal — Budaya × Modern × Digital')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Lora:ital,wght@0,400;0,500;0,600;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>window.__KRIYA_CATALOG__ = @json($catalog ?? []);</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased text-kriya-brown bg-kriya-cream-light text-[15px] leading-relaxed"
    x-data="{ mobileOpen: false }">

    {{-- ─── TOAST CONTAINER ─── --}}
    <div id="kriya-toast-container"></div>

    {{-- ─── FLOATING PILL NAVBAR ─── --}}
    <nav class="kriya-navbar-floating" id="kriya-navbar" x-data="{}">
        <div class="flex items-center justify-between gap-3">

            {{-- Logo --}}
            <a href="{{ route('kriya.home') }}" class="flex-shrink-0 flex items-center gap-2 group">
                <span class="font-serif-display text-lg font-bold tracking-wide text-kriya-cream-light group-hover:text-kriya-gold-soft transition-colors">
                    Kriya<span class="text-kriya-gold-soft">.</span>Lokal
                </span>
            </a>

            {{-- Center nav links (desktop) --}}
            <div class="hidden md:flex items-center gap-1">
                @foreach ([
                    ['kriya.home', 'Beranda'],
                    ['kriya.collection', 'Koleksi'],
                    ['kriya.about', 'Tentang'],
                    ['kriya.seller', 'Penjual'],
                ] as [$route, $label])
                    <a href="{{ route($route) }}"
                        class="relative px-4 py-1.5 rounded-full text-sm font-medium transition-all
                            {{ request()->routeIs($route) ? 'bg-white/15 text-kriya-gold-soft' : 'text-kriya-cream/80 hover:text-kriya-cream hover:bg-white/10' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- Right side: Cart + Mobile toggle --}}
            <div class="flex items-center gap-2">
                {{-- Mobile menu --}}
                <button type="button" class="md:hidden p-2 text-kriya-cream/80 hover:text-kriya-cream transition" @click="mobileOpen = !mobileOpen" aria-label="Menu">
                    <i class="fas fa-bars text-base"></i>
                </button>
                {{-- Cart --}}
                <a href="{{ route('kriya.cart') }}"
                    class="relative inline-flex h-9 w-9 items-center justify-center rounded-full text-kriya-cream hover:text-kriya-gold-soft transition"
                    style="background:rgba(255,255,255,0.1);border:1px solid rgba(201,162,39,0.25);"
                    aria-label="Keranjang">
                    <i class="fas fa-shopping-bag text-sm"></i>
                    <span id="kriya-cart-badge"
                        class="absolute -top-1 -right-1 min-h-[1.1rem] min-w-[1.1rem] rounded-full px-1 text-center text-[10px] font-black leading-none text-white hidden items-center justify-center"
                        style="background:var(--color-kriya-orange);">0</span>
                </a>
            </div>
        </div>

        {{-- Mobile dropdown --}}
        <div x-show="mobileOpen" x-transition class="md:hidden mt-3 pt-3 space-y-0.5" style="border-top:1px solid rgba(255,255,255,0.1);">
            @foreach ([['kriya.home','Beranda'],['kriya.collection','Koleksi'],['kriya.about','Tentang'],['kriya.seller','Penjual']] as [$r,$l])
                <a href="{{ route($r) }}" class="block px-3 py-2.5 rounded-xl text-sm text-kriya-cream/85 hover:bg-white/10 hover:text-kriya-gold-soft transition">{{ $l }}</a>
            @endforeach
        </div>
    </nav>

    {{-- Spacer so content isn't hidden behind floating nav --}}
    <div style="height: 5rem;"></div>

    <main>@yield('content')</main>

    {{-- ─── FOOTER ─── --}}
    <footer style="background:linear-gradient(135deg,#2a1008 0%,#3d1d0d 100%);border-top:1px solid rgba(201,162,39,0.22);">
        <div style="height:2px;background:linear-gradient(to right,transparent,rgba(201,162,39,0.35) 20%,rgba(201,162,39,0.7) 50%,rgba(201,162,39,0.35) 80%,transparent);"></div>
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-14 md:grid-cols-3 md:px-6">
            <div>
                <p class="font-serif-display text-2xl font-bold text-kriya-gold-soft tracking-wide">Kriya.Lokal</p>
                <p class="mt-1 text-xs text-kriya-gold/55 uppercase tracking-widest font-medium">Budaya × Modern × Digital</p>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-kriya-cream/70 font-body-serif">
                    Platform kurasi UMKM berbasis budaya Indonesia yang mengemas identitas dan nilai melalui
                    storytelling visual dan digital engagement.
                </p>
            </div>
            <div>
                <h3 class="font-semibold text-kriya-gold-soft tracking-widest uppercase text-xs mb-5">Navigasi</h3>
                <ul class="space-y-3 text-sm">
                    @foreach ([['kriya.home','Beranda'],['kriya.collection','Koleksi'],['kriya.about','Tentang'],['kriya.seller','Dashboard Penjual']] as [$r,$l])
                        <li><a href="{{ route($r) }}" class="text-kriya-cream/65 hover:text-kriya-gold-soft transition">{{ $l }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-kriya-gold-soft tracking-widest uppercase text-xs mb-5">Kontak</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2.5 text-kriya-cream/65"><i class="fas fa-envelope text-kriya-gold/65 w-4 text-center"></i> halo@kriya.lokal</li>
                    <li class="flex items-center gap-2.5 text-kriya-cream/65"><i class="fab fa-instagram text-kriya-gold/65 w-4 text-center"></i> @KriyaLokal</li>
                    <li class="flex items-center gap-2.5 text-kriya-cream/65"><i class="fab fa-whatsapp text-kriya-gold/65 w-4 text-center"></i> +62 812-3456-7890</li>
                </ul>
            </div>
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.05);" class="py-5 text-center text-xs text-kriya-cream/35">
            &copy; {{ date('Y') }} Kriya.Lokal — Nusantara Kontemporer. Semua hak cipta dilindungi.
        </div>
    </footer>

    @stack('scripts')

    {{-- ─── GLOBAL SCRIPTS: Scroll animations + Navbar scroll + Toast ─── --}}
    <script>
    // ── Floating navbar scroll effect ──
    const navbar = document.getElementById('kriya-navbar');
    window.addEventListener('scroll', () => {
        navbar?.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });

    // ── IntersectionObserver scroll animations ──
    function initAnimations() {
        const animObs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    animObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });

        document.querySelectorAll('[data-animate]').forEach(el => {
            // Immediately show elements already in viewport
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                el.classList.add('is-visible');
            } else {
                animObs.observe(el);
            }
        });
    }
    // Run on DOMContentLoaded + short delay for Alpine-rendered elements
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAnimations);
    } else {
        initAnimations();
    }
    setTimeout(initAnimations, 300);

    // ── Toast system ──
    window.kriyaToast = function(message, icon = 'fas fa-check', type = 'success') {
        const container = document.getElementById('kriya-toast-container');
        if (!container) return;
        const toast = document.createElement('div');
        toast.className = 'kriya-toast';
        const iconColor = type === 'success' ? 'var(--color-kriya-gold-soft)' : '#f87171';
        toast.innerHTML = `
            <div class="kriya-toast-icon" style="background:rgba(201,162,39,0.15);">
                <i class="${icon}" style="color:${iconColor};font-size:0.8rem;"></i>
            </div>
            <div style="flex:1;">
                <p style="font-weight:600;font-size:0.8rem;color:var(--color-kriya-gold-soft);margin-bottom:2px;">Kriya.Lokal</p>
                <p style="font-size:0.8rem;color:rgba(253,246,227,0.85);">${message}</p>
            </div>
            <button onclick="this.parentElement.classList.add('toast-exit')" style="color:rgba(253,246,227,0.4);padding:0 4px;font-size:1rem;line-height:1;">&times;</button>
        `;
        container.appendChild(toast);
        setTimeout(() => { toast.classList.add('toast-exit'); setTimeout(() => toast.remove(), 300); }, 3500);
    };

    // ── Cart toast on add ──
    document.addEventListener('kriya-cart-added', (e) => {
        const name = e.detail?.name || 'Produk';
        window.kriyaToast(`<strong>${name}</strong> ditambahkan ke keranjang!`, 'fas fa-bag-shopping');
    });
    </script>
</body>
</html>
