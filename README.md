# Kriya.Lokal

Pitch storefront for a curated Indonesian cultural marketplace (Laravel + Blade + Vite + Tailwind). Cart, checkout (COD / QRIS demo), and seller dashboard use browser `localStorage`—no backend commerce required for demos.

## Run locally

```bash
composer install
cp .env.example .env && php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan serve
```

Open `/` for the site. Add `?demo=1` to any URL for the demo ribbon.

## Product data

Default catalog: `config/kriya_products.php`. Product images live under `public/images/kriya/`.
