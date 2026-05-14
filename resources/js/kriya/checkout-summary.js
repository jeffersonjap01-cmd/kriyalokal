import { mergeCatalogById, formatRupiah } from './merge.js';
import { getCart, cartTotals } from './cart.js';

function fulfillmentShipping(el) {
    if (!el) {
        return 20000;
    }
    return el.value === 'pickup' ? 0 : 20000;
}

function discountFromCode(code, subtotal) {
    const c = String(code || '').trim().toUpperCase();
    if (c === 'BUDAYA10') {
        return Math.round((subtotal * 10) / 100);
    }
    if (c === 'NUSANTARA') {
        return Math.min(subtotal, 25000);
    }
    return 0;
}

function renderCheckoutSummary() {
    const linesRoot = document.getElementById('kriya-checkout-lines');
    if (!linesRoot) {
        return;
    }

    const fulfillmentEl = document.querySelector('input[name="fulfillment"]:checked');
    const discountInput = document.querySelector('[name="discount_code"]');
    const shipping = fulfillmentShipping(fulfillmentEl);

    const cart = getCart();
    const byId = mergeCatalogById();

    linesRoot.innerHTML = '';
    let subtotal = 0;

    for (const line of cart) {
        const p = byId[line.id];
        if (!p) {
            continue;
        }
        const lt = (Number(p.price) || 0) * (line.qty || 1);
        subtotal += lt;

        const row = document.createElement('div');
        row.className = 'flex gap-3 border-b border-kriya-brown/10 py-3 text-sm';
        row.innerHTML = `
          <img src="/images/kriya/${p.image}" class="h-14 w-14 rounded-lg object-cover" onerror="this.onerror=null;this.src='/images/kriya/placeholder.svg';" alt="">
          <div class="flex-1">
            <p class="font-semibold text-kriya-brown-deep">${p.name}</p>
            <p class="text-xs text-kriya-brown/60">${line.qty ?? 1}x · ${formatRupiah(p.price)}</p>
          </div>
          <div class="font-semibold text-kriya-brown-deep">${formatRupiah(lt)}</div>
        `;
        linesRoot.appendChild(row);
    }

    const discount = discountFromCode(discountInput?.value, subtotal);
    const totals = cartTotals(shipping, discount);

    const set = (id, val) => {
        const n = document.getElementById(id);
        if (n) {
            n.textContent = val;
        }
    };

    set('kriya-sum-subtotal', formatRupiah(totals.subtotal));
    set('kriya-sum-shipping', formatRupiah(totals.shipping));
    set('kriya-sum-discount', formatRupiah(totals.discount));
    set('kriya-sum-total', formatRupiah(totals.total));
}

document.addEventListener('DOMContentLoaded', () => {
    if (!document.getElementById('kriya-checkout-lines')) {
        return;
    }
    renderCheckoutSummary();
    document.querySelectorAll('input[name="fulfillment"]').forEach((el) => {
        el.addEventListener('change', renderCheckoutSummary);
    });
    const disc = document.querySelector('[name="discount_code"]');
    if (disc) {
        disc.addEventListener('input', renderCheckoutSummary);
    }
    window.addEventListener('kriya-cart-changed', renderCheckoutSummary);
});
