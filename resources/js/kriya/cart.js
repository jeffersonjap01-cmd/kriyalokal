import { mergeCatalogById, formatRupiah } from './merge.js';

const CART_KEY = 'kriya_cart_v1';

export function getCart() {
    try {
        const raw = JSON.parse(localStorage.getItem(CART_KEY) || '[]');
        return Array.isArray(raw) ? raw : [];
    } catch {
        return [];
    }
}

export function setCart(items) {
    localStorage.setItem(CART_KEY, JSON.stringify(items));
    window.dispatchEvent(new CustomEvent('kriya-cart-changed'));
    updateBadge();
}

export function addToCart(productId, qty = 1) {
    const cart = getCart();
    const row = cart.find((l) => l.id === productId);
    if (row) {
        row.qty = (row.qty || 1) + qty;
    } else {
        cart.push({ id: productId, qty });
    }
    setCart(cart);
}

export function updateLineQty(productId, qty) {
    const cart = getCart().filter((l) => l.id !== productId);
    if (qty > 0) {
        cart.push({ id: productId, qty });
    }
    setCart(cart);
}

export function removeLine(productId) {
    setCart(getCart().filter((l) => l.id !== productId));
}

export function clearCart() {
    setCart([]);
}

export function cartLineCount() {
    return getCart().reduce((s, l) => s + (l.qty || 0), 0);
}

export function cartTotals(shipping = 20000, discount = 0) {
    const byId = mergeCatalogById();
    let subtotal = 0;
    for (const line of getCart()) {
        const p = byId[line.id];
        if (!p) {
            continue;
        }
        subtotal += (Number(p.price) || 0) * (line.qty || 1);
    }
    const total = Math.max(0, subtotal + shipping - discount);
    return { subtotal, shipping, discount, total };
}

export function updateBadge() {
    const el = document.getElementById('kriya-cart-badge');
    if (!el) {
        return;
    }
    const n = cartLineCount();
    el.textContent = String(n);
    el.classList.toggle('hidden', n === 0);
    el.classList.toggle('flex', n > 0);
}

document.addEventListener('DOMContentLoaded', () => {
    updateBadge();
});

document.addEventListener('click', (e) => {
    const btn = e.target.closest('.kriya-add-cart');
    if (!btn || !window.KriyaCart) {
        return;
    }
    e.preventDefault();
    const id = btn.getAttribute('data-product-id');
    if (id) {
        window.KriyaCart.addToCart(id, 1);
        // Resolve product name for toast
        const catalog = window.__KRIYA_CATALOG__ || [];
        const product = catalog.find(p => p.id === id);
        const name = product?.name || 'Produk';
        window.dispatchEvent(new CustomEvent('kriya-cart-added', { detail: { id, name } }));
        // Visual feedback on button
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Ditambahkan!';
        btn.style.background = 'var(--color-kriya-gold-soft)';
        btn.style.color = 'var(--color-kriya-brown-deep)';
        setTimeout(() => { btn.innerHTML = orig; btn.style.background = ''; btn.style.color = ''; }, 1800);
    }
});

window.KriyaCart = {
    getCart,
    setCart,
    addToCart,
    updateLineQty,
    removeLine,
    clearCart,
    cartLineCount,
    cartTotals,
    updateBadge,
    formatRupiah,
};
