import { mergeCatalog, formatRupiah } from './merge.js';
import { hydrateCatalogCards } from './hydrate.js';

function cardTemplate(p) {
    const price = formatRupiah(p.price);
    const url = `/koleksi/${encodeURIComponent(p.id)}`;
    const catJson = JSON.stringify(p.category ?? '');
    return `
<div class="contents">
  <div x-show="cat === 'Semua' || cat === ${catJson}">
<div data-kriya-product="${p.id}" class="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-kriya-cream-dark shadow-md transition hover:-translate-y-0.5 hover:shadow-xl">
  <a href="${url}" class="relative aspect-[4/5] overflow-hidden bg-kriya-brown-deep/10">
    <img src="/images/kriya/${p.image}" alt="${p.name}" data-field="image"
      class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]"
      onerror="this.onerror=null;this.src='/images/kriya/placeholder.svg';">
    <span class="absolute left-3 top-3 rounded-full bg-kriya-brown-deep/85 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-kriya-cream" data-field="category">${p.category ?? ''}</span>
    <span class="absolute right-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-[11px] font-medium text-kriya-brown shadow-sm" data-field="heritage">${p.heritage ?? ''}</span>
  </a>
  <div class="flex flex-1 flex-col gap-2 p-4">
    <a href="${url}" class="font-serif-display text-lg font-semibold text-kriya-brown-deep hover:text-kriya-rust">
      <span data-field="name">${p.name}</span>
    </a>
    <p class="line-clamp-2 text-sm text-kriya-brown/75">${p.description ?? ''}</p>
    <div class="mt-auto flex items-center justify-between pt-2">
      <span class="font-semibold text-kriya-terracotta" data-field="price">${price}</span>
      <button type="button" class="kriya-add-cart inline-flex items-center gap-1 rounded-full bg-kriya-brown-deep px-3 py-1.5 text-xs font-semibold text-kriya-cream hover:bg-kriya-terracotta transition" data-product-id="${p.id}">
        <i class="fas fa-cart-plus"></i> Tambah
      </button>
    </div>
    </div>
</div>
  </div>
</div>`;
}

document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('kriya-collection-grid');
    if (!grid) {
        return;
    }

    const existing = new Set(
        [...document.querySelectorAll('[data-kriya-product]')].map((el) =>
            el.getAttribute('data-kriya-product'),
        ),
    );

    mergeCatalog().forEach((p) => {
        if (existing.has(p.id)) {
            return;
        }
        const wrap = document.createElement('div');
        wrap.innerHTML = cardTemplate(p).trim();
        const card = wrap.firstElementChild;
        if (card) {
            grid.appendChild(card);
            existing.add(p.id);
            if (window.Alpine && typeof window.Alpine.initTree === 'function') {
                window.Alpine.initTree(card);
            }
        }
    });

    hydrateCatalogCards();
});

window.addEventListener('kriya-catalog-changed', () => {
    const grid = document.getElementById('kriya-collection-grid');
    if (!grid) {
        return;
    }

    const existing = new Set(
        [...document.querySelectorAll('[data-kriya-product]')].map((el) =>
            el.getAttribute('data-kriya-product'),
        ),
    );

    mergeCatalog().forEach((p) => {
        if (existing.has(p.id)) {
            return;
        }
        const wrap = document.createElement('div');
        wrap.innerHTML = cardTemplate(p).trim();
        const card = wrap.firstElementChild;
        if (card) {
            grid.appendChild(card);
            existing.add(p.id);
            if (window.Alpine && typeof window.Alpine.initTree === 'function') {
                window.Alpine.initTree(card);
            }
        }
    });

    hydrateCatalogCards();
});
