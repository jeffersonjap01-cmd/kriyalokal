import {
    mergeCatalog,
    readOverrides,
    writeOverrides,
    readExtras,
    writeExtras,
    formatRupiah,
} from './merge.js';

function slugify(text) {
    return String(text || '')
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, '')
        .replace(/\s+/g, '-')
        .concat('-', Date.now().toString(36));
}

window.KriyaSeller = {
    mergeCatalog,
    readOverrides,
    writeOverrides,
    readExtras,
    writeExtras,
    formatRupiah,

    /**
     * Soft-delete default catalog item (hidden from storefront).
     */
    deleteProduct(id) {
        const o = readOverrides();
        o[id] = { ...(o[id] || {}), deleted: true };
        writeOverrides(o);
    },

    restoreProduct(id) {
        const o = readOverrides();
        if (o[id]) {
            delete o[id].deleted;
            if (Object.keys(o[id]).length === 0) {
                delete o[id];
            }
        }
        writeOverrides(o);
    },

    upsertOverride(id, partial) {
        const o = readOverrides();
        o[id] = { ...(o[id] || {}), ...partial };
        if (partial.deleted === false) {
            delete o[id].deleted;
        }
        writeOverrides(o);
    },

    /**
     * Create seller-only product (not in PHP defaults).
     */
    addExtraProduct(product) {
        const extras = readExtras();
        const id = product.id || slugify(product.name || 'produk');
        extras.push({
            ...product,
            id,
            featured: Boolean(product.featured),
            stock: Number(product.stock) || 0,
            price: Number(product.price) || 0,
        });
        writeExtras(extras);
        return id;
    },

    replaceExtras(list) {
        writeExtras(Array.isArray(list) ? list : []);
    },

    exportJson() {
        return JSON.stringify(
            {
                overrides: readOverrides(),
                extras: readExtras(),
                exportedAt: new Date().toISOString(),
            },
            null,
            2,
        );
    },

    importJson(jsonText) {
        const data = JSON.parse(jsonText);
        if (data.overrides) {
            writeOverrides(data.overrides);
        }
        if (Array.isArray(data.extras)) {
            writeExtras(data.extras);
        }
    },
};
