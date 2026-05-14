@extends('layouts.kriya')

@section('title', 'Tentang — Kriya.Lokal')

@section('content')

    {{-- ═══════════════════════════════════════════
         HERO TENTANG
    ═══════════════════════════════════════════ --}}
    <section class="relative overflow-hidden kriya-pattern py-20 md:py-28">
        {{-- Corner ornaments --}}
        <div class="kriya-corner-ornament top-left"></div>
        <div class="kriya-corner-ornament top-right"></div>
        <div class="kriya-corner-ornament bottom-left"></div>
        <div class="kriya-corner-ornament bottom-right"></div>

        <div class="relative mx-auto max-w-3xl px-4 text-center md:px-6">
            <span class="kriya-section-label" data-animate="fade-up">
                <i class="fas fa-landmark text-[9px]"></i> Tentang Platform Kami
            </span>
            <h1 class="mt-6 font-serif-display text-4xl md:text-5xl font-bold text-kriya-cream-light" data-animate="fade-up" data-delay="100">
                Tentang <span style="color: var(--color-kriya-gold-soft);">Kriya.Lokal</span>
            </h1>
            <div class="kriya-gold-divider mt-5 max-w-xs mx-auto" data-animate="fade-up" data-delay="150">
                <i class="fas fa-gem text-kriya-gold text-[9px]"></i>
            </div>
            <p class="mt-6 text-kriya-cream/85 font-body-serif leading-relaxed text-lg" data-animate="fade-up" data-delay="200">
                Kami membantu UMKM berbasis budaya lokal mengemas identitas dan nilai budayanya
                melalui <strong class="text-kriya-gold-soft font-semibold">storytelling visual</strong> dan
                engagement digital — agar diferensiasi terasa di pasar digital dan keputusan pembelian
                konsumen semakin kuat.
            </p>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         CERITA KAMI
    ═══════════════════════════════════════════ --}}
    <section class="kriya-pattern-soft py-20 md:py-24">
        <div class="mx-auto grid max-w-6xl gap-14 px-4 md:grid-cols-2 md:items-center md:px-6">

            {{-- Text --}}
            <div>
                <span class="text-xs uppercase tracking-widest font-bold text-kriya-terracotta/70">Latar Belakang</span>
                <h2 class="mt-3 font-serif-display text-3xl md:text-4xl font-bold text-kriya-brown-deep">Cerita Kami</h2>
                <div class="mt-3 mb-6" style="height:2px; width:40px; background: var(--color-kriya-gold); border-radius:1px; opacity:.7;"></div>
                <div class="space-y-4 text-kriya-brown/80 font-body-serif leading-relaxed">
                    <p>
                        Nusantara Kontemporer lahir dari keyakinan bahwa warisan budaya Indonesia memiliki nilai
                        estetika dan ekonomi yang belum sepenuhnya dimanfaatkan. Kami menjembatani pengrajin,
                        ilustrator lokal, dan generasi muda yang mencintai budaya pop.
                    </p>
                    <p>
                        Melalui produk fashion kontemporer — dari hoodie batik fractal hingga jaket grafiti ondel-ondel —
                        kami membuktikan bahwa identitas budaya lokal bisa tampil relevan, menarik, dan kompetitif
                        di pasar digital global.
                    </p>
                    <p>
                        Setiap listing dirancang seperti halaman portofolio mini — bukan sekadar SKU. Karena kami
                        percaya bahwa cerita di balik produk adalah yang membedakan UMKM berbasis budaya dari
                        produk massal biasa.
                    </p>
                </div>
            </div>

            {{-- Images grid --}}
            <div class="grid grid-cols-2 gap-3">
                @foreach ([
                    ['batik-artisan-hero.jpg', 'garuda-cyberpunk.jpg', 'Pengrajin batik'],
                    ['batik-workshop-story.jpg', 'reog-anime.jpg', 'Workshop UMKM'],
                    ['wayang-cultural-art.jpg', 'wayang-comic.jpg', 'Seni wayang'],
                    ['nusantara-craft-collection.jpg', 'borobudur-minimal.jpg', 'Koleksi Nusantara'],
                ] as $imgData)
                    <div class="overflow-hidden rounded-xl kriya-frame-cream"
                        style="aspect-ratio:1/1;">
                        <img src="{{ asset('images/kriya/' . $imgData[0]) }}"
                            alt="{{ $imgData[2] }}"
                            class="w-full h-full object-cover transition duration-500 hover:scale-105"
                            onerror="this.onerror=null;this.src='{{ asset('images/kriya/' . $imgData[1]) }}';">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         MISI & VISI
    ═══════════════════════════════════════════ --}}
    <section class="py-20 md:py-24 relative overflow-hidden" style="background: linear-gradient(135deg, #3d1d0d 0%, #5c3317 100%);">
        <div style="height:1px; position:absolute; top:0; left:0; right:0; background: linear-gradient(to right, transparent, rgba(201,162,39,0.6) 30%, rgba(201,162,39,0.9) 50%, rgba(201,162,39,0.6) 70%, transparent);"></div>
        <div style="height:1px; position:absolute; bottom:0; left:0; right:0; background: linear-gradient(to right, transparent, rgba(201,162,39,0.6) 30%, rgba(201,162,39,0.9) 50%, rgba(201,162,39,0.6) 70%, transparent);"></div>

        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest font-bold text-kriya-gold/60">Tujuan Kami</span>
                <h2 class="mt-3 font-serif-display text-3xl md:text-4xl font-bold text-kriya-cream-light">Misi & Visi</h2>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                {{-- Misi --}}
                <div class="rounded-2xl p-8"
                    style="background: rgba(255,255,255,0.06); border: 1px solid rgba(201,162,39,0.25); backdrop-filter: blur(4px);">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full"
                            style="background: rgba(201,162,39,0.15); border: 1px solid rgba(201,162,39,0.3);">
                            <i class="fas fa-bullseye text-kriya-gold"></i>
                        </div>
                        <h3 class="font-serif-display text-2xl font-bold text-kriya-gold-soft">Misi Kami</h3>
                    </div>
                    <ul class="space-y-3">
                        @foreach ([
                            'Melestarikan dan mempromosikan budaya Indonesia melalui fashion kontemporer.',
                            'Memotivasi penggunaan unsur tradisional seperti batik, wayang, dan musik dalam desain modern.',
                            'Memberdayakan seniman dan desainer lokal untuk berkarya.',
                            'Membangun komunitas yang bangga dengan identitas budaya Indonesia.',
                        ] as $m)
                            <li class="flex items-start gap-3 text-sm text-kriya-cream/80 font-body-serif leading-relaxed">
                                <i class="fas fa-diamond text-kriya-gold/60 mt-1 text-[8px] flex-shrink-0"></i>
                                {{ $m }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Visi --}}
                <div class="rounded-2xl p-8"
                    style="background: rgba(255,255,255,0.06); border: 1px solid rgba(201,162,39,0.25); backdrop-filter: blur(4px);">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full"
                            style="background: rgba(201,162,39,0.15); border: 1px solid rgba(201,162,39,0.3);">
                            <i class="fas fa-eye text-kriya-gold"></i>
                        </div>
                        <h3 class="font-serif-display text-2xl font-bold text-kriya-gold-soft">Visi Kami</h3>
                    </div>
                    <p class="text-sm text-kriya-cream/80 font-body-serif leading-relaxed mb-4">
                        Menjadi platform budaya lokal terdepan yang menginspirasi generasi digital untuk menggali,
                        melestarikan, dan merayakan warisan budaya Indonesia melalui fashion dan digital engagement.
                    </p>
                    <p class="text-sm text-kriya-cream/80 font-body-serif leading-relaxed">
                        Kami membayangkan masa depan di mana setiap orang Indonesia bangga mengenakan produk lokal
                        yang menemukan identitas budaya mereka, sambil tampil stylish dan relevan dengan tren global.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         NILAI-NILAI KAMI
    ═══════════════════════════════════════════ --}}
    <section class="kriya-pattern-soft py-20 md:py-24">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="text-center">
                <span class="text-xs uppercase tracking-widest font-bold text-kriya-terracotta/70">Prinsip Kami</span>
                <h2 class="mt-3 font-serif-display text-3xl md:text-4xl font-bold text-kriya-brown-deep">Nilai-Nilai Kami</h2>
                <div class="kriya-gold-divider mt-4 max-w-xs mx-auto">
                    <i class="fas fa-gem text-kriya-gold text-[9px]"></i>
                </div>
                <p class="mt-4 max-w-xl mx-auto text-sm text-kriya-brown/70 font-body-serif">
                    Empat pilar yang memandu setiap keputusan dan karya kami.
                </p>
            </div>

            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Autentisitas', 'Setiap nilai budaya pada aset lokal yang kami miliki dan kami tampilkan.', 'fa-fingerprint', '#c8611a'],
                    ['Inovasi', 'Kami terus berinovasi dengan ide-ide terkini yang memadukan tradisi dan modernitas.', 'fa-lightbulb', '#c9a227'],
                    ['Komunitas', 'Mendukung dan menghubungkan komunitas lokal berbasis budaya bersama.', 'fa-users', '#8b4513'],
                    ['Kualitas', 'Mengutamakan bahan premium untuk produk terbaik yang mencerminkan keunggulan.', 'fa-gem', '#2c3e6b'],
                ] as $v)
                    <div class="kriya-card p-6 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full mb-4"
                            style="background: rgba({{ $v[3] === '#c8611a' ? '200,97,26' : ($v[3] === '#c9a227' ? '201,162,39' : ($v[3] === '#8b4513' ? '139,69,19' : '44,62,107')) }},0.12); border: 1px solid rgba({{ $v[3] === '#c8611a' ? '200,97,26' : ($v[3] === '#c9a227' ? '201,162,39' : ($v[3] === '#8b4513' ? '139,69,19' : '44,62,107')) }},0.25);">
                            <i class="fas {{ $v[2] }} text-lg" style="color: {{ $v[3] }};"></i>
                        </div>
                        <h3 class="font-serif-display text-lg font-bold text-kriya-brown-deep">{{ $v[0] }}</h3>
                        <div class="my-2 mx-auto" style="height:2px; width:24px; background: {{ $v[3] }}; border-radius:1px; opacity:.6;"></div>
                        <p class="text-sm text-kriya-brown/70 font-body-serif leading-relaxed">{{ $v[1] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         CTA — Bergabunglah
    ═══════════════════════════════════════════ --}}
    <section class="kriya-pattern py-20 md:py-24 relative overflow-hidden">
        <div class="kriya-corner-ornament top-left"></div>
        <div class="kriya-corner-ornament top-right"></div>
        <div class="kriya-corner-ornament bottom-left"></div>
        <div class="kriya-corner-ornament bottom-right"></div>

        <div class="relative mx-auto max-w-3xl px-4 text-center md:px-6">
            <span class="kriya-section-label">
                <i class="fas fa-hands-holding-heart text-[9px]"></i> Bersama Kami
            </span>
            <h2 class="mt-6 font-serif-display text-3xl md:text-4xl font-bold text-kriya-cream-light">
                Bergabunglah dengan<br>Gerakan Kami
            </h2>
            <div class="kriya-gold-divider mt-5 max-w-xs mx-auto">
                <i class="fas fa-gem text-kriya-gold text-[9px]"></i>
            </div>
            <p class="mt-5 text-kriya-cream/80 font-body-serif leading-relaxed">
                Mari bersama kami menjaga dan melestarikan budaya Indonesia untuk generasi mendatang —
                satu produk, satu cerita, satu identitas pada satu waktu.
            </p>
            <div class="mt-9 flex flex-wrap justify-center gap-4">
                <a href="mailto:halo@kriya.lokal"
                    class="kriya-btn-primary">
                    <i class="fas fa-envelope text-xs"></i> Hubungi Kami
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener"
                    class="kriya-btn-outline">
                    <i class="fab fa-instagram text-xs"></i> Follow Instagram
                </a>
            </div>
        </div>
    </section>

@endsection
