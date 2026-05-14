import { mergeCatalogById, formatRupiah } from './merge.js';

/**
 * Updates SSR product cards after seller overrides (optional enhancement).
 */
export function hydrateCatalogCards() {
    const map = mergeCatalogById();

    document.querySelectorAll('[data-kriya-product]').forEach((el) => {
        const id = el.getAttribute('data-kriya-product');
        const p = map[id];
        if (!p) {
            el.classList.add('hidden');
            return;
        }
        el.classList.remove('hidden');

        const priceEl = el.querySelector('[data-field="price"]');
        if (priceEl) {
            priceEl.textContent = formatRupiah(p.price);
        }
        const nameEl = el.querySelector('[data-field="name"]');
        if (nameEl && p.name) {
            nameEl.textContent = p.name;
        }
        const catEl = el.querySelector('[data-field="category"]');
        if (catEl && p.category) {
            catEl.textContent = p.category;
        }
        const herEl = el.querySelector('[data-field="heritage"]');
        if (herEl && p.heritage) {
            herEl.textContent = p.heritage;
        }
        const img = el.querySelector('[data-field="image"]');
        if (img && p.image) {
            img.setAttribute('src', `/images/kriya/${p.image}`);
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('[data-kriya-product]')) {
        hydrateCatalogCards();
    }
});

window.addEventListener('kriya-catalog-changed', () => {
    if (document.querySelector('[data-kriya-product]')) {
        hydrateCatalogCards();
    }
});
