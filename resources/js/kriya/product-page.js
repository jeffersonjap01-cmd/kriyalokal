import { mergeCatalogById, formatRupiah } from './merge.js';

function fillProductShell() {
    const shell = document.getElementById('kriya-product-shell');
    if (!shell) {
        return;
    }
    const slug = shell.getAttribute('data-slug');
    const p = mergeCatalogById()[slug];
    if (!p) {
        shell.innerHTML =
            '<p class="text-center text-red-800 py-12 font-semibold">Produk tidak ditemukan di etalase.</p>';
        return;
    }

    const setText = (sel, text) => {
        const el = shell.querySelector(sel);
        if (el) {
            el.textContent = text ?? '';
        }
    };

    shell.classList.remove('hidden');

    setText('[data-slot="title"]', p.name ?? '');
    setText('[data-slot="heritage"]', p.heritage ?? '');
    setText('[data-slot="category"]', p.category ?? '');
    setText('[data-slot="price"]', formatRupiah(p.price));
    setText('[data-slot="description"]', p.description ?? '');
    setText('[data-slot="story"]', p.story ?? '');

    const img = shell.querySelector('[data-slot="image"]');
    if (img) {
        img.setAttribute('src', `/images/kriya/${p.image}`);
        img.setAttribute('alt', p.name ?? '');
    }

    const btn = shell.querySelector('.kriya-add-cart');
    if (btn) {
        btn.setAttribute('data-product-id', p.id);
    }
}

document.addEventListener('DOMContentLoaded', fillProductShell);
window.addEventListener('kriya-catalog-changed', fillProductShell);
