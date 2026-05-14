import { mergeCatalogById } from './merge.js';

const DISCOUNT_CODES = {
    BUDAYA10: { type: 'percent', value: 10 },
    NUSANTARA: { type: 'fixed', value: 25000 },
};

function computeDiscount(code, subtotal) {
    const rule = DISCOUNT_CODES[String(code || '').toUpperCase()];
    if (!rule) {
        return 0;
    }
    if (rule.type === 'percent') {
        return Math.round((subtotal * rule.value) / 100);
    }
    return Math.min(subtotal, rule.value);
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('kriya-checkout-form');
    if (!form) {
        return;
    }

    if (window.KriyaCart && window.KriyaCart.getCart().length === 0) {
        window.location.href = '/keranjang';
        return;
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const cart = window.KriyaCart.getCart();
        if (!cart.length) {
            alert('Keranjang kosong.');
            return;
        }

        const fd = new FormData(form);
        const fulfillment = fd.get('fulfillment') || 'delivery';
        const shipping = fulfillment === 'pickup' ? 0 : 20000;

        const discountCode = String(fd.get('discount_code') || '').trim();
        const byId = mergeCatalogById();
        let subtotal = 0;
        for (const line of cart) {
            const p = byId[line.id];
            if (!p) {
                continue;
            }
            subtotal += (Number(p.price) || 0) * (line.qty || 1);
        }
        const discount = computeDiscount(discountCode, subtotal);
        const totals = window.KriyaCart.cartTotals(shipping, discount);

        const payload = {
            customer: {
                name: fd.get('name'),
                email: fd.get('email'),
                phone: fd.get('phone'),
                country: fd.get('country'),
                city: fd.get('city'),
                province: fd.get('province'),
                postal: fd.get('postal'),
            },
            fulfillment,
            payment: fd.get('payment'),
            terms: fd.get('terms') === 'on',
            discount_code: discountCode || null,
            cart,
            totals,
            createdAt: new Date().toISOString(),
        };

        if (!payload.terms) {
            alert('Harap setujui syarat & ketentuan.');
            return;
        }
        if (!payload.payment) {
            alert('Pilih metode pembayaran.');
            return;
        }

        sessionStorage.setItem('kriya_last_order_v1', JSON.stringify(payload));
        window.KriyaCart.clearCart();

        const url = form.getAttribute('data-success-url') || '/pesanan-berhasil';
        window.location.href = url;
    });
});

window.KriyaCheckoutDiscounts = DISCOUNT_CODES;
