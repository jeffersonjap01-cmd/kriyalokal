import {
    mergeCatalog,
    formatRupiah,
    readOverrides,
    readExtras,
    writeExtras,
} from './merge.js';

function defaultsOnly() {
    return Array.isArray(window.__KRIYA_CATALOG__) ? [...window.__KRIYA_CATALOG__] : [];
}

function refreshSellerTable() {
    const tbody = document.getElementById('kriya-seller-tbody');
    if (!tbody || !window.KriyaSeller) {
        return;
    }

    const items = mergeCatalog().sort((a, b) => String(a.name).localeCompare(String(b.name)));

    tbody.innerHTML = '';
    for (const p of items) {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>
            <span class="product-name">${p.name}</span>
            <span class="product-category">${p.heritage ?? ''}</span>
          </td>
          <td>
            <span style="display:inline-flex; align-items:center; gap:4px; padding: 2px 10px; border-radius:9999px; font-size:11px; font-weight:700; letter-spacing:0.04em; text-transform:uppercase; background: rgba(92,51,23,0.08); color: var(--color-kriya-brown);">
              ${p.category ?? '—'}
            </span>
          </td>
          <td class="col-price">${formatRupiah(p.price)}</td>
          <td class="col-stock">${p.stock ?? '—'}</td>
          <td class="col-action">
            <button type="button" class="kriya-seller-edit" data-id="${p.id}"
              style="display:inline-flex; align-items:center; gap:4px; padding:4px 12px; border-radius:9999px; font-size:11px; font-weight:700; background: rgba(200,97,26,0.10); color: var(--color-kriya-terracotta); border:1px solid rgba(200,97,26,0.2); margin-right:4px; transition: background 0.15s;">
              <i class="fas fa-edit" style="font-size:9px;"></i> Edit
            </button>
            <button type="button" class="kriya-seller-del" data-id="${p.id}"
              style="display:inline-flex; align-items:center; gap:4px; padding:4px 12px; border-radius:9999px; font-size:11px; font-weight:700; background: rgba(180,30,30,0.08); color: #b91c1c; border:1px solid rgba(180,30,30,0.18); transition: background 0.15s;">
              <i class="fas fa-archive" style="font-size:9px;"></i> Arsip
            </button>
          </td>
        `;
        tbody.appendChild(tr);
    }

    tbody.querySelectorAll('.kriya-seller-edit').forEach((btn) => {
        btn.addEventListener('click', () => openEdit(btn.getAttribute('data-id')));
    });
    tbody.querySelectorAll('.kriya-seller-del').forEach((btn) => {
        btn.addEventListener('click', () => {
            if (confirm('Sembunyikan produk dari etalase?')) {
                window.KriyaSeller.deleteProduct(btn.getAttribute('data-id'));
                refreshSellerTable();
                window.dispatchEvent(new CustomEvent('kriya-catalog-changed'));
            }
        });
    });
}

function openEdit(id) {
    const map = Object.fromEntries(mergeCatalog().map((p) => [p.id, p]));
    const p = map[id];
    if (!p) {
        return;
    }
    const dlg = document.getElementById('kriya-seller-dialog');
    if (!dlg) {
        return;
    }
    const form = document.getElementById('kriya-seller-form');
    if (!form) {
        return;
    }
    form.elements.namedItem('id').value = p.id;
    form.elements.namedItem('name').value = p.name ?? '';
    form.elements.namedItem('price').value = p.price ?? 0;
    form.elements.namedItem('category').value = p.category ?? '';
    form.elements.namedItem('heritage').value = p.heritage ?? '';
    form.elements.namedItem('description').value = p.description ?? '';
    form.elements.namedItem('story').value = p.story ?? '';
    form.elements.namedItem('image').value = p.image ?? '';
    form.elements.namedItem('stock').value = p.stock ?? 0;
    const feat = form.elements.namedItem('featured');
    if (feat) {
        feat.checked = Boolean(p.featured);
    }
    dlg.showModal();
}

function wireSellerPage() {
    const tb = document.getElementById('kriya-seller-tbody');
    if (!tb) {
        return;
    }

    refreshSellerTable();

    document.getElementById('kriya-seller-add-open')?.addEventListener('click', () => {
        const dlg = document.getElementById('kriya-seller-dialog');
        const form = document.getElementById('kriya-seller-form');
        if (!form || !dlg) {
            return;
        }
        form.reset();
        form.elements.namedItem('id').value = '';
        dlg.showModal();
    });

    document.getElementById('kriya-seller-form')?.addEventListener('submit', (e) => {
        e.preventDefault();
        const form = e.target;
        const id = String(form.elements.namedItem('id').value || '').trim();
        const payload = {
            name: form.elements.namedItem('name').value,
            price: Number(form.elements.namedItem('price').value || 0),
            category: form.elements.namedItem('category').value,
            heritage: form.elements.namedItem('heritage').value,
            description: form.elements.namedItem('description').value,
            story: form.elements.namedItem('story').value,
            image: form.elements.namedItem('image').value,
            stock: Number(form.elements.namedItem('stock').value || 0),
            featured: Boolean(form.elements.namedItem('featured')?.checked),
            deleted: false,
        };

        const defaultsIds = new Set(defaultsOnly().map((p) => p.id));

        if (id && defaultsIds.has(id)) {
            window.KriyaSeller.upsertOverride(id, payload);
        } else if (id) {
            const extras = readExtras().filter((p) => p.id !== id);
            extras.push({ ...payload, id });
            writeExtras(extras);
        } else {
            window.KriyaSeller.addExtraProduct(payload);
        }

        document.getElementById('kriya-seller-dialog')?.close();
        refreshSellerTable();
        window.dispatchEvent(new CustomEvent('kriya-catalog-changed'));
    });

    document.getElementById('kriya-seller-export')?.addEventListener('click', () => {
        const blob = new Blob([window.KriyaSeller.exportJson()], { type: 'application/json' });
        const a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'kriya-seller-backup.json';
        a.click();
        URL.revokeObjectURL(a.href);
    });

    document.getElementById('kriya-seller-import')?.addEventListener('click', () => {
        document.getElementById('kriya-seller-import-file')?.click();
    });

    document.getElementById('kriya-seller-import-file')?.addEventListener('change', (e) => {
        const file = e.target.files?.[0];
        if (!file) {
            return;
        }
        file.text().then((txt) => {
            window.KriyaSeller.importJson(txt);
            refreshSellerTable();
            window.dispatchEvent(new CustomEvent('kriya-catalog-changed'));
        });
    });
}

document.addEventListener('DOMContentLoaded', wireSellerPage);
window.addEventListener('kriya-catalog-changed', refreshSellerTable);
