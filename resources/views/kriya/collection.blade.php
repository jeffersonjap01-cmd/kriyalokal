@extends('layouts.kriya')

@section('title', 'Koleksi Lengkap — Kriya.Lokal')

@section('content')
    @php
        $categories = collect($products)->pluck('category')->unique()->sort()->values();
    @endphp

    {{-- ═══════════════════════════════════════════
         HERO KOLEKSI
    ═══════════════════════════════════════════ --}}
    <section class="relative overflow-hidden kriya-pattern py-16 md:py-20">
        <div class="kriya-corner-ornament top-left"></div>
        <div class="kriya-corner-ornament top-right"></div>

        {{-- Background motif --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden" style="opacity:.04;">
            <svg viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg"
                style="position:absolute; right:-2%; top:50%; transform:translateY(-50%); width:60%; fill:none; stroke:rgba(201,162,39,1); stroke-width:0.8;">
                <circle cx="400" cy="150" r="200"/>
                <circle cx="400" cy="150" r="150"/>
                <circle cx="400" cy="150" r="100"/>
                <path d="M200 150 L600 150 M400 0 L400 300"/>
            </svg>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 md:px-6">
            <span class="kriya-section-label">
                <i class="fas fa-store text-[9px]"></i> Katalog Budaya Digital
            </span>
            <h1 class="mt-5 font-serif-display text-4xl md:text-5xl font-bold text-kriya-cream-light">Koleksi Lengkap</h1>
            <div class="mt-4 flex items-center gap-3">
                <div style="height:1px; width:40px; background: linear-gradient(to right, transparent, rgba(201,162,39,0.7));"></div>
                <i class="fas fa-diamond text-[8px] text-kriya-gold/60"></i>
                <div style="height:1px; width:80px; background: linear-gradient(to right, rgba(201,162,39,0.5), transparent);"></div>
            </div>
            <p class="mt-4 max-w-2xl text-kriya-cream/80 font-body-serif leading-relaxed">
                Jelajahi seluruh koleksi kami yang menggabungkan warisan budaya Indonesia dengan desain kontemporer.
                Setiap produk memiliki cerita uniknya sendiri.
            </p>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         FILTER + GRID
    ═══════════════════════════════════════════ --}}
    <section class="py-8 border-b"
        style="background: var(--color-kriya-cream-light); border-color: rgba(92,51,23,0.10);"
        x-data="{ cat: 'Semua' }">

        {{-- Filter bar --}}
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="flex flex-wrap items-center gap-2.5">
                <span class="text-xs uppercase tracking-wider font-bold text-kriya-brown/60 mr-1">
                    <i class="fas fa-sliders mr-1.5"></i> Filter:
                </span>
                <button type="button"
                    @click="cat = 'Semua'"
                    :class="cat === 'Semua'
                        ? 'bg-kriya-brown-deep text-kriya-cream border-kriya-brown-deep shadow-md'
                        : 'bg-white text-kriya-brown border-kriya-brown/20 hover:border-kriya-brown/40'"
                    class="rounded-full border px-4 py-1.5 text-xs font-semibold transition">
                    Semua
                </button>
                @foreach ($categories as $c)
                    <button type="button"
                        @click="cat = '{{ $c }}'"
                        :class="cat === '{{ $c }}'
                            ? 'bg-kriya-brown-deep text-kriya-cream border-kriya-brown-deep shadow-md'
                            : 'bg-white text-kriya-brown border-kriya-brown/20 hover:border-kriya-brown/40'"
                        class="rounded-full border px-4 py-1.5 text-xs font-semibold transition">
                        {{ $c }}
                    </button>
                @endforeach
            </div>

            {{-- Count label --}}
            <p class="mt-5 text-xs text-kriya-brown/55">
                Menampilkan <span x-text="cat === 'Semua' ? '{{ count($products) }}' : '...'"></span> produk
            </p>

            {{-- Product grid --}}
            <div class="mt-6 mb-10 grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div x-show="cat === 'Semua' || cat === '{{ $product['category'] }}'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100">
                        @include('kriya.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
