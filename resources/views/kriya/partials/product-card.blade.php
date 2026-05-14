@php
    $href = route('kriya.product', $product['id']);
@endphp

<div data-kriya-product="{{ $product['id'] }}"
    class="kriya-product-card group flex flex-col">

    {{-- Image area --}}
    <a href="{{ $href }}" class="relative overflow-hidden" style="aspect-ratio: 4/5; display:block; background: var(--color-kriya-brown-deep);">
        <img src="{{ asset('images/kriya/' . $product['image']) }}"
            alt="{{ $product['name'] }}"
            data-field="image"
            class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.05]"
            onerror="this.onerror=null;this.src='{{ asset('images/kriya/placeholder.svg') }}';">

        {{-- Gradient overlay --}}
        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(61,29,13,0.6) 0%, transparent 45%); opacity:0; transition: opacity 0.35s ease;" data-img-overlay></div>

        {{-- Category badge --}}
        <span class="absolute left-3 top-3 rounded-full text-[10px] font-bold uppercase tracking-wider px-2.5 py-1"
            style="background: rgba(61,29,13,0.85); color: var(--color-kriya-gold-soft); border: 1px solid rgba(201,162,39,0.3);"
            data-field="category">{{ $product['category'] }}</span>

        {{-- Heritage badge --}}
        <span class="absolute right-3 top-3 rounded-full text-[10px] font-medium px-2.5 py-1"
            style="background: rgba(255,255,255,0.92); color: var(--color-kriya-brown); border: 1px solid rgba(92,51,23,0.1);"
            data-field="heritage">{{ $product['heritage'] }}</span>

        {{-- Quick add overlay (shows on hover) --}}
        <div class="absolute bottom-3 left-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <button type="button"
                class="kriya-add-cart w-full rounded-full text-xs font-bold py-2 text-center"
                style="background: var(--color-kriya-gold-soft); color: var(--color-kriya-brown-deep);"
                data-product-id="{{ $product['id'] }}">
                <i class="fas fa-cart-plus mr-1"></i> Tambah ke Keranjang
            </button>
        </div>
    </a>

    {{-- Info area --}}
    <div class="flex flex-1 flex-col gap-1.5 p-4" style="border-top: 1px solid rgba(92,51,23,0.08);">
        <a href="{{ $href }}"
            class="font-body-serif text-base font-semibold text-kriya-brown-deep hover:text-kriya-rust transition leading-snug"
            data-field="name">{{ $product['name'] }}</a>

        <p class="line-clamp-2 text-xs leading-relaxed text-kriya-brown/65 font-sans">{{ $product['description'] }}</p>

        <div class="mt-auto flex items-center justify-between pt-3"
            style="border-top: 1px solid rgba(92,51,23,0.08);">
            <span class="font-bold text-base text-kriya-terracotta" data-field="price">
                Rp{{ number_format($product['price'], 0, ',', '.') }}
            </span>
            <button type="button"
                class="kriya-add-cart inline-flex items-center gap-1.5 rounded-full text-[11px] font-bold px-3.5 py-1.5 transition"
                style="background: var(--color-kriya-brown-deep); color: var(--color-kriya-cream);"
                data-product-id="{{ $product['id'] }}">
                <i class="fas fa-cart-plus text-[10px]"></i> Tambah
            </button>
        </div>
    </div>
</div>
