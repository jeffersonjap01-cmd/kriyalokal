@extends('layouts.kriya')

@section('title', ($product ? $product['name'] : 'Produk') . ' — Kriya.Lokal')

@section('content')

@php
/* Per-product extra data: sizes, material specs, cultural origins */
$extraData = [
    'garuda-cyberpunk-tee' => [
        'sizes'    => ['S','M','L','XL','XXL'],
        'material' => ['100% Cotton Combed 30s', 'Sablon: Teknik screen printing presisi', 'Perawatan: Cuci dengan air dingin, jangan gunakan pemutih', 'Produksi: Dimanufaktur di Indonesia'],
        'origin'   => 'Barung Garuda — Lambang Negara Indonesia',
        'style'    => 'Cyberpunk aesthetic, neon colors, futuristic design',
        'bg_story' => 'Garuda sebagai simbol kekuatan dan kemerdekaan Indonesia bertemu dengan estetika cyberpunk yang menggambarkan masa depan. Desain ini merepresentasikan bahwa Indonesia yang terus berkembang sambil mempertahankan akar budayanya.',
    ],
    'wayang-comic-tee' => [
        'sizes'    => ['S','M','L','XL','XXL'],
        'material' => ['100% Cotton Combed 30s', 'Sablon: DTF (Direct to Film) full color', 'Perawatan: Cuci tangan, tidak perlu dry clean', 'Produksi: UMKM Lokal Yogyakarta'],
        'origin'   => 'Wayang Kulit — Seni Pertunjukan Jawa',
        'style'    => 'Comic book aesthetic, bold contrast, graphic storytelling',
        'bg_story' => 'Wayang Kulit telah menjadi medium bercerita selama ribuan tahun di Jawa. Melalui desain ini, narasi epik Mahabharata dan Ramayana hadir kembali dalam bahasa visual komik modern yang familiar bagi generasi digital.',
    ],
    'batik-fractal-hoodie' => [
        'sizes'    => ['S','M','L','XL','XXL'],
        'material' => ['80% Cotton 20% Polyester Fleece', 'Sablon: AOP (All-Over Print) digital', 'Perawatan: Cuci dengan air dingin, balik sebelum dicuci', 'Produksi: Kolaborasi pengrajin batik Solo'],
        'origin'   => 'Batik Kawung & Parang — Motif Keraton Yogyakarta',
        'style'    => 'Fractal geometry, infinite pattern, contemporary batik',
        'bg_story' => 'Motif batik tradisional mengandung filosofi mendalam tentang harmoni dan keberlanjutan. Dengan pola fraktal — geometri yang berulang tanpa batas — desain ini mengekspresikan bahwa budaya batik adalah sesuatu yang terus hidup dan berkembang.',
    ],
    'reog-anime-streetwear' => [
        'sizes'    => ['XS','S','M','L','XL'],
        'material' => ['100% Cotton Combed 30s', 'Sablon: Rubber tinggi tiga dimensi', 'Perawatan: Cuci dengan air dingin, hindari mesin pengering', 'Produksi: Studio kolaborasi Ponorogo'],
        'origin'   => 'Reog Ponorogo — Seni Pertunjukan Jawa Timur',
        'style'    => 'Anime-inspired illustration, bold linework, cultural fusion',
        'bg_story' => 'Reog Ponorogo dengan Singa Barong dan Jathil-nya adalah perwujudan keberanian dan kebebasan. Dalam desain ini, energi pertunjukan Reog ditransformasi menjadi estetika anime yang dikenal dan dicintai generasi muda global.',
    ],
    'borobudur-minimalist-tee' => [
        'sizes'    => ['S','M','L','XL','XXL'],
        'material' => ['100% Organic Cotton Combed 40s', 'Sablon: Water-based environmentally friendly', 'Perawatan: Mesin cuci gentle cycle, air dingin', 'Produksi: Kolaborasi komunitas sekitar Magelang'],
        'origin'   => 'Candi Borobudur — Warisan Dunia UNESCO',
        'style'    => 'Minimalist line art, zen aesthetic, spiritual motif',
        'bg_story' => 'Borobudur, candi Buddha terbesar di dunia, adalah monumen keagungan peradaban Indonesia. Desain minimalis ini menangkap esensi ketenangan spiritual Borobudur — bahwa keindahan sejati tidak memerlukan ornamen berlebihan.',
    ],
    'ondel-graffiti-jacket' => [
        'sizes'    => ['S','M','L','XL'],
        'material' => ['100% Cotton Canvas Jacket', 'Sablon & bordir: kombinasi teknik premium', 'Perawatan: Dry clean disarankan, atau cuci tangan hati-hati', 'Produksi: Artisan Jakarta'],
        'origin'   => 'Ondel-Ondel — Ikon Budaya Betawi',
        'style'    => 'Urban graffiti, street art, Betawi cultural expression',
        'bg_story' => 'Ondel-Ondel adalah penjaga kota Jakarta, simbol pelindung masyarakat Betawi dari roh-roh jahat. Dalam desain ini, wajah Ondel-Ondel yang ekspresif dilukis ulang dalam gaya graffiti urban — identitas Betawi yang hidup di ritme dan jalanan kota.',
    ],
    'long-sleeve-parang' => [
        'sizes'    => ['S','M','L','XL','XXL'],
        'material' => ['100% Cotton Combed 30s long-sleeve', 'Sablon: Digital print premium', 'Perawatan: Cuci normal, setrika dengan kain pelapis', 'Produksi: Kolaborasi batik Pekalongan'],
        'origin'   => 'Batik Parang — Motif Kesultanan Mataram',
        'style'    => 'Subtle all-over pattern, moody palette, everyday wear',
        'bg_story' => 'Motif Parang adalah salah satu motif batik tertua dan paling dihormati, berasal dari Kesultanan Mataram. Filosofinya: gelombang yang tidak pernah berhenti bergerak melambangkan semangat yang tidak pernah menyerah. Desain ini memaknai perjalanan sebagai inti dari identitas.',
    ],
];
$extra = $extraData[$product['id'] ?? ''] ?? [
    'sizes'    => ['S','M','L','XL','XXL'],
    'material' => ['100% Cotton', 'Produksi: Indonesia'],
    'origin'   => $product['heritage'] ?? '',
    'style'    => 'Contemporary Indonesian design',
    'bg_story' => $product['story'] ?? '',
];
/* Related products: exclude current, take up to 3 */
$allProducts = $catalog ?? [];
$related = array_filter($allProducts, fn($p) => ($p['id'] ?? '') !== ($product['id'] ?? ''));
$related = array_values(array_slice($related, 0, 3));
@endphp

@if ($product)
<section class="kriya-pattern-soft py-12 md:py-16">
    {{-- Breadcrumb --}}
    <div class="mx-auto max-w-6xl px-4 md:px-6 mb-8">
        <a href="{{ route('kriya.collection') }}" class="inline-flex items-center gap-2 text-sm text-kriya-brown/60 hover:text-kriya-terracotta transition">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke Koleksi
        </a>
    </div>

    <div class="mx-auto max-w-6xl px-4 md:px-6">
        <div class="grid gap-12 md:grid-cols-2">

            {{-- ─ Left: Product Image ─ --}}
            <div class="space-y-4" data-animate="fade-right">
                <div class="overflow-hidden rounded-2xl kriya-frame-gold bg-kriya-brown-deep/10">
                    <img src="{{ asset('images/kriya/' . $product['image']) }}"
                        alt="{{ $product['name'] }}"
                        data-field="image"
                        class="aspect-[3/4] w-full object-cover"
                        onerror="this.onerror=null;this.src='{{ asset('images/kriya/placeholder.svg') }}';">
                </div>

                {{-- Cultural story card --}}
                <div class="rounded-2xl p-6" style="background:linear-gradient(135deg,#3d1d0d,#5c3317);border:1px solid rgba(201,162,39,0.3);">
                    <p class="text-[10px] uppercase tracking-widest text-kriya-gold/70 font-semibold mb-3">
                        <i class="fas fa-scroll mr-1.5"></i>Cerita di Balik Desain
                    </p>
                    <p class="text-sm leading-relaxed text-kriya-cream/85 font-body-serif">{{ $extra['bg_story'] }}</p>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div class="rounded-xl p-3" style="background:rgba(255,255,255,0.06);border:1px solid rgba(201,162,39,0.15);">
                            <p class="text-[10px] uppercase tracking-wider text-kriya-gold/60 mb-1">Cerita Dasar</p>
                            <p class="text-xs text-kriya-cream/80 font-body-serif">{{ $extra['origin'] }}</p>
                        </div>
                        <div class="rounded-xl p-3" style="background:rgba(255,255,255,0.06);border:1px solid rgba(201,162,39,0.15);">
                            <p class="text-[10px] uppercase tracking-wider text-kriya-gold/60 mb-1">Gaya Modern</p>
                            <p class="text-xs text-kriya-cream/80 font-body-serif">{{ $extra['style'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ─ Right: Product Info ─ --}}
            <div class="flex flex-col gap-5" data-animate="fade-left">
                {{-- Badges --}}
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide"
                        style="background:rgba(61,29,13,0.1);color:var(--color-kriya-terracotta);"
                        data-field="category">{{ $product['category'] }}</span>
                    <span class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-medium"
                        style="background:rgba(201,162,39,0.12);color:var(--color-kriya-brown);"
                        data-field="heritage">{{ $product['heritage'] }}</span>
                </div>

                <h1 class="font-serif-display text-3xl md:text-4xl font-bold text-kriya-brown-deep" data-field="name">
                    {{ $product['name'] }}
                </h1>

                <p class="text-2xl font-bold text-kriya-terracotta" data-field="price">
                    Rp{{ number_format($product['price'], 0, ',', '.') }}
                </p>

                <p class="text-kriya-brown/80 leading-relaxed font-body-serif" data-field="description">
                    {{ $product['description'] }}
                </p>

                {{-- Size Selector --}}
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-xs font-bold uppercase tracking-widest text-kriya-brown/70">Pilih Ukuran</p>
                        <button type="button" class="text-xs text-kriya-terracotta hover:underline font-medium">
                            Panduan Ukuran <i class="fas fa-ruler text-[10px]"></i>
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2" id="size-selector">
                        @foreach ($extra['sizes'] as $sz)
                            <button type="button" class="kriya-size-btn {{ $loop->first ? 'active' : '' }}"
                                onclick="document.querySelectorAll('.kriya-size-btn').forEach(b=>b.classList.remove('active'));this.classList.add('active');document.getElementById('selected-size').textContent=this.textContent;">
                                {{ $sz }}
                            </button>
                        @endforeach
                    </div>
                    <p class="mt-2 text-xs text-kriya-brown/55">
                        Ukuran dipilih: <span id="selected-size" class="font-semibold text-kriya-brown-deep">{{ $extra['sizes'][0] }}</span>
                    </p>
                </div>

                {{-- Add to Cart --}}
                <button type="button"
                    class="kriya-add-cart w-full inline-flex items-center justify-center gap-2 rounded-full font-semibold text-base py-4 shadow-lg transition"
                    style="background:var(--color-kriya-brown-deep);color:var(--color-kriya-cream);box-shadow:0 6px 24px rgba(61,29,13,0.30);"
                    data-product-id="{{ $product['id'] }}">
                    <i class="fas fa-shopping-bag"></i> Tambah ke Keranjang
                </button>

                <a href="{{ route('kriya.collection') }}"
                    class="text-center rounded-full py-3 text-sm font-semibold text-kriya-brown/70 hover:text-kriya-brown-deep border border-kriya-brown/15 hover:border-kriya-brown/35 transition">
                    Kembali ke Koleksi
                </a>

                {{-- Product Details --}}
                <div class="rounded-2xl kriya-card p-5">
                    <p class="text-xs font-bold uppercase tracking-widest text-kriya-brown/60 mb-3">
                        <i class="fas fa-tag mr-1.5 text-kriya-gold/70"></i>Detail Produk
                    </p>
                    <ul class="space-y-2">
                        @foreach ($extra['material'] as $spec)
                            <li class="flex items-start gap-2 text-sm text-kriya-brown/75 font-body-serif">
                                <i class="fas fa-diamond text-kriya-gold/50 text-[8px] mt-1.5 flex-shrink-0"></i>
                                {{ $spec }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ RELATED PRODUCTS ═══ --}}
@if (count($related))
<section style="background:linear-gradient(160deg,#3d1d0d 0%,#5c3317 100%);" class="py-16 md:py-20">
    <div style="height:1px;background:linear-gradient(to right,transparent,rgba(201,162,39,0.7) 50%,transparent);"></div>
    <div class="mx-auto max-w-6xl px-4 md:px-6 pt-2">
        <h2 class="font-serif-display text-2xl md:text-3xl font-bold text-kriya-cream-light mb-8" data-animate="fade-up">
            Produk Terkait
        </h2>
        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($related as $rp)
                <div data-animate="fade-up" data-delay="{{ ($loop->index + 1) * 100 }}">
                    @include('kriya.partials.product-card', ['product' => $rp])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@else
{{-- Fallback for JS-hydrated product --}}
<section class="kriya-pattern-soft py-12 md:py-16">
    <div class="mx-auto max-w-6xl px-4 md:px-6 mb-8">
        <a href="{{ route('kriya.collection') }}" class="inline-flex items-center gap-2 text-sm text-kriya-brown/60 hover:text-kriya-terracotta transition">
            <i class="fas fa-arrow-left text-xs"></i> Kembali ke Koleksi
        </a>
    </div>
    <div id="kriya-product-shell" data-slug="{{ $slug }}"
        class="mx-auto hidden max-w-6xl gap-10 px-4 md:grid md:grid-cols-2 md:px-6">
        <div class="space-y-4">
            <div class="overflow-hidden rounded-2xl kriya-frame-gold">
                <img data-slot="image" src="{{ asset('images/kriya/placeholder.svg') }}" alt="" class="aspect-[3/4] w-full object-cover">
            </div>
        </div>
        <div class="flex flex-col gap-5">
            <span data-slot="category" class="inline-flex w-fit rounded-full px-3 py-1 text-xs font-bold uppercase" style="background:rgba(61,29,13,0.1);color:var(--color-kriya-terracotta);"></span>
            <h1 class="font-serif-display text-4xl font-bold text-kriya-brown-deep" data-slot="title"></h1>
            <p class="text-2xl font-bold text-kriya-terracotta" data-slot="price"></p>
            <p class="text-kriya-brown/80 font-body-serif" data-slot="description"></p>
            <div class="flex flex-wrap gap-3 pt-2">
                <button type="button" class="kriya-add-cart inline-flex flex-1 min-w-[200px] items-center justify-center gap-2 rounded-full font-semibold py-4"
                    style="background:var(--color-kriya-brown-deep);color:var(--color-kriya-cream);" data-product-id="">
                    <i class="fas fa-shopping-bag"></i> Tambah ke Keranjang
                </button>
                <a href="{{ route('kriya.collection') }}" class="inline-flex items-center justify-center rounded-full border border-kriya-brown/25 px-6 py-3 text-sm font-semibold">
                    Kembali ke Koleksi
                </a>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
