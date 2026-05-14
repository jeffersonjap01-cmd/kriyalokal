import { mergeCatalogById, formatRupiah } from './merge.js';
import { getCart, updateLineQty, removeLine, cartTotals } from './cart.js';

function renderCartPage() {
    const root = document.getElementById('kriya-cart-lines');
    const summarySub = document.getElementById('kriya-cart-subtotal');
    const summaryShip = document.getElementById('kriya-cart-shipping');
    const summaryDisc = document.getElementById('kriya-cart-discount');
    const summaryTot = document.getElementById('kriya-cart-total');
    const emptyEl = document.getElementById('kriya-cart-empty');
    const wrapEl = document.getElementById('kriya-cart-wrapper');

    if (!root) {
        return;
    }

    const cart = getCart();
    const byId = mergeCatalogById();

    if (!cart.length) {
        root.innerHTML = '';
        if (emptyEl) {
            emptyEl.classList.remove('hidden');
        }
        if (wrapEl) {
            wrapEl.classList.add('hidden');
        }
        return;
    }

    if (emptyEl) {
        emptyEl.classList.add('hidden');
    }
    if (wrapEl) {
        wrapEl.classList.remove('hidden');
    }

    root.innerHTML = '';
    let subtotal = 0;

    for (const line of cart) {
        const p = byId[line.id];
        if (!p) {
            continue;
        }
        const lineTotal = (Number(p.price) || 0) * (line.qty || 1);
        subtotal += lineTotal;

        const row = document.createElement('div');
        row.className =
            'flex flex-col gap-4 rounded-2xl border border-kriya-brown/10 bg-white p-4 shadow-sm sm:flex-row sm:items-center';
        row.innerHTML = `
            <img src="/images/kriya/${p.image}" alt="" class="h-28 w-full rounded-xl object-cover sm:h-24 sm:w-24"
              onerror="this.onerror=null;this.src='/images/kriya/placeholder.svg';" />
            <div class="flex-1">
              <p class="font-serif-display text-lg font-semibold text-kriya-brown-deep">${p.name}</p>
              <p class="text-xs text-kriya-brown/65">${p.heritage ?? ''}</p>
              <p class="mt-2 font-semibold text-kriya-terracotta">${formatRupiah(p.price)}</p>
            </div>
            <div class="flex items-center gap-3">
              <label class="text-xs font-semibold text-kriya-brown/70">Qty</label>
              <input type="number" min="1" value="${line.qty || 1}" class="kriya-qty w-20 rounded-lg border border-kriya-brown/20 px-2 py-1 text-sm" data-id="${p.id}" />
              <button type="button" class="kriya-remove text-sm font-semibold text-red-700 hover:underline" data-id="${p.id}">Hapus</button>
            </div>
        `;
        root.appendChild(row);
    }

    root.querySelectorAll('.kriya-qty').forEach((input) => {
        input.addEventListener('change', () => {
            const id = input.getAttribute('data-id');
            const qty = Math.max(1, parseInt(input.value, 10) || 1);
            updateLineQty(id, qty);
            renderCartPage();
        });
    });

    root.querySelectorAll('.kriya-remove').forEach((btn) => {
        btn.addEventListener('click', () => {
            removeLine(btn.getAttribute('data-id'));
            renderCartPage();
        });
    });

    const shipping = 20000;
    const discount = 0;
    const t = cartTotals(shipping, discount);

    if (summarySub) {
        summarySub.textContent = formatRupiah(t.subtotal);
    }
    if (summaryShip) {
        summaryShip.textContent = formatRupiah(t.shipping);
    }
    if (summaryDisc) {
        summaryDisc.textContent = formatRupiah(t.discount);
    }
    if (summaryTot) {
        summaryTot.textContent = formatRupiah(t.total);
    }
}

document.addEventListener('DOMContentLoaded', renderCartPage);
window.addEventListener('kriya-cart-changed', renderCartPage);
