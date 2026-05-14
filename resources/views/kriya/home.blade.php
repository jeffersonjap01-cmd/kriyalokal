@extends('layouts.kriya')
@section('title', 'Beranda — Kriya.Lokal')
@section('content')

{{-- ═══ HERO ═══ --}}
<section class="relative overflow-hidden kriya-pattern" style="min-height: 90vh; display:flex; align-items:center;">
    <div class="kriya-corner-ornament top-left" style="width:100px;height:100px;opacity:.18;"></div>
    <div class="kriya-corner-ornament top-right" style="width:100px;height:100px;opacity:.18;"></div>
    <div class="kriya-corner-ornament bottom-left" style="width:100px;height:100px;opacity:.18;"></div>
    <div class="kriya-corner-ornament bottom-right" style="width:100px;height:100px;opacity:.18;"></div>

    {{-- Large batik decorative motif --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:.06;">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" style="position:absolute;right:-5%;top:50%;transform:translateY(-50%);width:50%;fill:none;stroke:rgba(201,162,39,1);stroke-width:0.8;">
            <circle cx="250" cy="250" r="220"/><circle cx="250" cy="250" r="170"/><circle cx="250" cy="250" r="120"/>
            <circle cx="250" cy="250" r="70"/><circle cx="250" cy="250" r="20"/>
            <path d="M250 30 L250 470 M30 250 L470 250 M103 103 L397 397 M397 103 L103 397"/>
            <path d="M250 30 L280 100 L350 100 L295 145 L315 215 L250 175 L185 215 L205 145 L150 100 L220 100 Z" opacity=".5"/>
        </svg>
    </div>

    <div class="relative mx-auto flex max-w-6xl flex-col gap-12 px-4 py-20 md:flex-row md:items-center md:py-28 md:px-6 w-full">
        <div class="max-w-xl flex-1">
            <span class="kriya-section-label" data-animate="fade-up">
                <i class="fas fa-star-of-life text-[9px]"></i> Budaya + Modern + Digital
            </span>
            <h1 class="mt-6 font-serif-display text-[2.8rem] md:text-[3.6rem] font-bold leading-[1.1] text-kriya-cream-light" data-animate="fade-up" data-delay="100">
                Cerita Warisan<br><span style="color:var(--color-kriya-gold-soft);">Nusantara</span>
            </h1>
            <div class="mt-5 flex items-center gap-3" data-animate="fade-up" data-delay="150">
                <div style="height:1px;width:40px;background:linear-gradient(to right,transparent,rgba(201,162,39,0.6));"></div>
                <i class="fas fa-diamond text-[8px] text-kriya-gold/60"></i>
                <div style="height:1px;flex:1;background:linear-gradient(to right,rgba(201,162,39,0.4),transparent);"></div>
            </div>
            <p class="mt-5 text-base md:text-lg leading-relaxed text-kriya-cream/85 font-body-serif" data-animate="fade-up" data-delay="200">
                Kami membantu UMKM berbasis budaya lokal mengemas identitas dan nilai melalui
                <em class="text-kriya-gold-soft not-italic font-medium">storytelling visual</em> —
                meningkatkan diferensiasi dan keputusan pembelian konsumen.
            </p>
            <div class="mt-9 flex flex-wrap gap-3" data-animate="fade-up" data-delay="250">
                <a href="{{ route('kriya.collection') }}" class="kriya-btn-primary">
                    Jelajahi Koleksi <i class="fas fa-arrow-right text-[11px]"></i>
                </a>
                <a href="{{ route('kriya.about') }}" class="kriya-btn-outline">Cerita Kami</a>
            </div>
            <div class="mt-9 flex flex-wrap gap-6" data-animate="fade-up" data-delay="300">
                @foreach ([['fas fa-shield-halved','UMKM Terverifikasi'],['fas fa-leaf','Budaya Autentik'],['fas fa-handshake','Cerita Per Produk']] as $t)
                    <div class="flex items-center gap-2 text-xs text-kriya-cream/65">
                        <i class="{{ $t[0] }} text-kriya-gold/70"></i><span>{{ $t[1] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="relative flex-shrink-0 w-full md:w-auto flex justify-center md:justify-end" data-animate="fade-left" data-delay="200">
            <div class="relative" style="width:min(340px,85vw);">
                <div class="absolute inset-0 rounded-2xl" style="background:radial-gradient(ellipse at center,rgba(201,162,39,0.15) 0%,transparent 70%);transform:scale(1.1);"></div>
                <div class="relative rounded-2xl overflow-hidden kriya-frame-gold bg-kriya-brown-deep" style="aspect-ratio:3/4;">
                    <img src="{{ asset('images/kriya/batik-artisan-hero.jpg') }}" alt="Pengrajin batik Nusantara"
                        class="h-full w-full object-cover"
                        onerror="this.onerror=null;this.src='{{ asset('images/kriya/hero-portrait.jpg') }}';">
                    <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(61,29,13,0.7) 0%,transparent 50%);"></div>
                    <div class="kriya-image-caption">
                        <span class="block text-[11px] uppercase tracking-widest text-kriya-gold/80 font-semibold mb-0.5">Desain Pilihan</span>
                        <span class="block text-sm text-kriya-cream/95 font-body-serif">Batik × Identitas Nusantara</span>
                    </div>
                </div>
                <div class="absolute -top-4 -right-4 rounded-xl px-3 py-2 text-xs font-semibold text-kriya-brown-deep shadow-lg"
                    style="background:var(--color-kriya-gold-soft);border:1px solid rgba(201,162,39,0.6);">
                    <i class="fas fa-award mr-1"></i> Warisan UNESCO
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0" style="height:4px;background:linear-gradient(to right,transparent,rgba(201,162,39,0.5) 30%,rgba(201,162,39,0.8) 50%,rgba(201,162,39,0.5) 70%,transparent);"></div>
</section>

{{-- ═══ FILOSOFI ═══ --}}
<section class="kriya-pattern-soft py-20 md:py-24">
    <div class="mx-auto max-w-6xl px-4 md:px-6">
        <div class="text-center" data-animate="fade-up">
            <span class="text-xs uppercase tracking-widest font-bold text-kriya-terracotta/70">Pilar Kami</span>
            <h2 class="mt-3 font-serif-display text-3xl md:text-4xl font-bold text-kriya-brown-deep">Filosofi Kami</h2>
            <div class="kriya-gold-divider mt-4 max-w-xs mx-auto"><i class="fas fa-gem text-kriya-gold text-[10px]"></i></div>
            <p class="mt-4 max-w-2xl mx-auto text-kriya-brown/75 font-body-serif leading-relaxed">
                Setiap desain memiliki cerita yang menghubungkan masa lalu dengan masa depan.
            </p>
        </div>
        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['fa-palette','#c8611a','01','Visual Storytelling','Setiap motif bercerita tentang warisan budaya Indonesia dengan bahasa visual kontemporer yang kuat.'],
                ['fa-star-and-crescent','#c9a227','02','Fusi Budaya','Memadukan batik, wayang, dan Reog dengan gaya modern cyberpunk, anime, dan street art.'],
                ['fa-heart','#8b4513','03','Cinta Nusantara','Setiap produk adalah bentuk apresiasi dan pelestarian identitas budaya untuk generasi digital.'],
            ] as [$icon,$color,$num,$title,$body])
                <div class="kriya-card p-7 relative overflow-hidden group" data-animate="fade-up" data-delay="{{ ($loop->index + 1) * 100 }}">
                    <span class="absolute top-4 right-5 font-serif-display text-5xl font-black" style="color:rgba(92,51,23,0.07);line-height:1;">{{ $num }}</span>
                    <div class="inline-flex h-13 w-13 items-center justify-center rounded-xl mb-5" style="background:rgba(92,51,23,0.09);">
                        <i class="fas {{ $icon }} text-lg" style="color:{{ $color }};"></i>
                    </div>
                    <h3 class="font-serif-display text-xl font-bold text-kriya-brown-deep">{{ $title }}</h3>
                    <div class="mt-2 mb-3" style="height:2px;width:32px;background:{{ $color }};border-radius:1px;opacity:.7;"></div>
                    <p class="text-sm leading-relaxed text-kriya-brown/75 font-body-serif">{{ $body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ KOLEKSI UNGGULAN ═══ --}}
<section style="background:linear-gradient(160deg,#3d1d0d 0%,#5c3317 50%,#3d1d0d 100%);" class="py-20 md:py-24">
    <div style="height:1px;background:linear-gradient(to right,transparent,rgba(201,162,39,0.7) 50%,transparent);"></div>
    <div class="mx-auto max-w-6xl px-4 md:px-6 pt-2">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between" data-animate="fade-up">
            <div>
                <span class="text-xs uppercase tracking-widest font-bold text-kriya-gold/60">Pilihan Editor</span>
                <h2 class="mt-2 font-serif-display text-3xl md:text-4xl font-bold text-kriya-cream-light">Koleksi Unggulan</h2>
                <p class="mt-2 max-w-xl text-sm text-kriya-cream/70 font-body-serif leading-relaxed">
                    Desain terbaik yang menggabungkan tradisi dan modernitas.
                </p>
            </div>
            <a href="{{ route('kriya.collection') }}" class="flex-shrink-0 inline-flex items-center gap-1.5 text-sm font-semibold text-kriya-gold-soft hover:text-kriya-gold transition">
                Lihat Semua <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="mt-10 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredProducts as $product)
                <div data-animate="fade-up" data-delay="{{ ($loop->index + 1) * 100 }}">
                    @include('kriya.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>
    <div style="height:1px;background:linear-gradient(to right,transparent,rgba(201,162,39,0.7) 50%,transparent);margin-top:5rem;"></div>
</section>

{{-- ═══ UMKM STORY STRIP ═══ --}}
<section class="kriya-pattern-soft py-20 md:py-24">
    <div class="mx-auto max-w-6xl px-4 md:px-6">
        <div class="grid gap-12 md:grid-cols-2 md:items-center">
            <div class="grid grid-cols-2 gap-3" data-animate="fade-right">
                <div class="overflow-hidden rounded-2xl kriya-frame-cream row-span-2" style="aspect-ratio:2/3;">
                    <img src="{{ asset('images/kriya/batik-workshop-story.jpg') }}" alt="Workshop batik UMKM"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                        onerror="this.onerror=null;this.src='{{ asset('images/kriya/parang-long.jpg') }}';">
                </div>
                <div class="overflow-hidden rounded-xl" style="aspect-ratio:1/1;border:1px solid rgba(92,51,23,0.12);">
                    <img src="{{ asset('images/kriya/batik-fabric-pattern.jpg') }}" alt="Motif batik"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                        onerror="this.onerror=null;this.src='{{ asset('images/kriya/batik-fractal.jpg') }}';">
                </div>
                <div class="overflow-hidden rounded-xl" style="aspect-ratio:1/1;border:1px solid rgba(92,51,23,0.12);">
                    <img src="{{ asset('images/kriya/nusantara-craft-collection.jpg') }}" alt="Koleksi Nusantara"
                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                        onerror="this.onerror=null;this.src='{{ asset('images/kriya/wayang-comic.jpg') }}';">
                </div>
            </div>
            <div data-animate="fade-left">
                <span class="text-xs uppercase tracking-widest font-bold text-kriya-terracotta/70">Mengapa Kami Ada</span>
                <h2 class="mt-3 font-serif-display text-3xl md:text-4xl font-bold text-kriya-brown-deep leading-tight">
                    Dari Tangan Pengrajin<br>ke Layar Digital
                </h2>
                <div class="mt-4 mb-5" style="height:2px;width:48px;background:var(--color-kriya-gold);border-radius:1px;opacity:.7;"></div>
                <div class="space-y-4 font-body-serif text-kriya-brown/80 leading-relaxed">
                    <p>Nusantara Kontemporer lahir untuk menjembatani antara warisan budaya Indonesia yang kaya dengan generasi digital masa kini.</p>
                    <p>Melalui produk fashion kontemporer, kami mengemas cerita pengrajin lokal dengan bahasa visual yang relevan tanpa kehilangan esensi budayanya.</p>
                </div>
                <a href="{{ route('kriya.about') }}" class="mt-7 inline-flex items-center gap-2 text-sm font-semibold text-kriya-terracotta hover:text-kriya-rust transition">
                    Pelajari Lebih Lanjut <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section class="kriya-pattern py-20 md:py-24 relative overflow-hidden">
    <div class="kriya-corner-ornament top-left"></div><div class="kriya-corner-ornament top-right"></div>
    <div class="kriya-corner-ornament bottom-left"></div><div class="kriya-corner-ornament bottom-right"></div>
    <div class="relative mx-auto max-w-4xl px-4 text-center md:px-6">
        <span class="kriya-section-label" data-animate="fade-up"><i class="fas fa-fire-flame-curved text-[9px]"></i> Bergabung Sekarang</span>
        <h2 class="mt-6 font-serif-display text-3xl md:text-4xl font-bold text-kriya-cream-light" data-animate="fade-up" data-delay="100">
            Kenakan Budaya,<br>Rayakan Identitas
        </h2>
        <div class="kriya-gold-divider mt-5 max-w-sm mx-auto" data-animate="fade-up" data-delay="150"><i class="fas fa-diamond text-kriya-gold text-[8px]"></i></div>
        <p class="mt-5 text-kriya-cream/80 font-body-serif leading-relaxed max-w-2xl mx-auto" data-animate="fade-up" data-delay="200">
            Setiap pembelian adalah dukungan nyata pada pengrajin lokal dan pelestarian warisan budaya Indonesia untuk generasi mendatang.
        </p>
        <a href="{{ route('kriya.collection') }}" class="mt-9 inline-flex items-center gap-2 rounded-full font-semibold text-sm shadow-lg transition" data-animate="fade-up" data-delay="250"
            style="background:var(--color-kriya-gold-soft);color:var(--color-kriya-brown-deep);padding:0.875rem 2.25rem;box-shadow:0 4px 20px rgba(232,201,106,0.35);">
            <i class="fas fa-bag-shopping"></i> Mulai Berbelanja
        </a>
        <form class="mt-12 mx-auto flex max-w-md flex-col gap-2 sm:flex-row sm:items-center" data-animate="fade-up" data-delay="300"
            action="#" onsubmit="event.preventDefault(); window.kriyaToast && window.kriyaToast('Terima kasih! Anda akan mendapat info koleksi terbaru.','fas fa-envelope');">
            <label class="sr-only" for="news-email">Email</label>
            <input id="news-email" type="email" placeholder="Masukkan email untuk info koleksi baru"
                class="flex-1 rounded-full px-4 py-3 text-sm outline-none"
                style="border:1px solid rgba(201,162,39,0.35);background:rgba(255,255,255,0.08);color:var(--color-kriya-cream);">
            <button type="submit" class="rounded-full px-5 py-3 text-sm font-semibold transition flex-shrink-0"
                style="background:var(--color-kriya-brown-mid);color:var(--color-kriya-cream);border:1px solid rgba(201,162,39,0.4);">
                Berlangganan
            </button>
        </form>
    </div>
</section>
@endsection
