const OVERRIDES_KEY = 'kriya_seller_overrides_v1';
const EXTRAS_KEY = 'kriya_seller_extras_v1';

export function readOverrides() {
    try {
        return JSON.parse(localStorage.getItem(OVERRIDES_KEY) || '{}');
    } catch {
        return {};
    }
}

export function writeOverrides(obj) {
    localStorage.setItem(OVERRIDES_KEY, JSON.stringify(obj));
}

export function readExtras() {
    try {
        return JSON.parse(localStorage.getItem(EXTRAS_KEY) || '[]');
    } catch {
        return [];
    }
}

export function writeExtras(arr) {
    localStorage.setItem(EXTRAS_KEY, JSON.stringify(arr));
}

/**
 * Default catalog from Blade + seller overrides + seller-created products.
 */
export function mergeCatalog() {
    const defaults = Array.isArray(window.__KRIYA_CATALOG__) ? [...window.__KRIYA_CATALOG__] : [];
    const overrides = readOverrides();
    const extras = readExtras();

    const map = Object.fromEntries(defaults.map((p) => [p.id, { ...p }]));

    Object.keys(overrides).forEach((id) => {
        if (!map[id]) {
            return;
        }
        map[id] = { ...map[id], ...overrides[id] };
    });

    extras.forEach((p) => {
        if (p && p.id) {
            map[p.id] = { ...p };
        }
    });

    return Object.values(map).filter((p) => !p.deleted);
}

export function mergeCatalogById() {
    const list = mergeCatalog();
    return Object.fromEntries(list.map((p) => [p.id, p]));
}

export function formatRupiah(n) {
    const num = Number(n) || 0;
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
}
