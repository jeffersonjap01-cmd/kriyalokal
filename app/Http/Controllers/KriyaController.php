<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class KriyaController extends Controller
{
    private function catalog(): array
    {
        return array_values(config('kriya_products', []));
    }

    private function productById(string $id): ?array
    {
        foreach ($this->catalog() as $p) {
            if (($p['id'] ?? '') === $id) {
                return $p;
            }
        }

        return null;
    }

    public function home(): View
    {
        $products = $this->catalog();
        $featured = array_values(array_filter($products, fn ($p) => ! empty($p['featured'])));

        return view('kriya.home', [
            'catalog' => $products,
            'products' => $products,
            'featuredProducts' => array_slice($featured, 0, 3),
            'catalogJson' => json_encode($products),
        ]);
    }

    public function collection(): View
    {
        $products = $this->catalog();

        return view('kriya.collection', [
            'catalog' => $products,
            'products' => $products,
            'catalogJson' => json_encode($products),
        ]);
    }

    public function product(string $slug): View
    {
        $product = $this->productById($slug);

        return view('kriya.product', [
            'catalog' => $this->catalog(),
            'product' => $product,
            'slug' => $slug,
            'catalogJson' => json_encode($this->catalog()),
        ]);
    }

    public function about(): View
    {
        return view('kriya.about', [
            'catalog' => $this->catalog(),
            'catalogJson' => json_encode($this->catalog()),
        ]);
    }

    public function cart(): View
    {
        return view('kriya.cart', [
            'catalog' => $this->catalog(),
            'catalogJson' => json_encode($this->catalog()),
        ]);
    }

    public function checkout(): View
    {
        return view('kriya.checkout', [
            'catalog' => $this->catalog(),
            'catalogJson' => json_encode($this->catalog()),
        ]);
    }

    public function orderSuccess(): View
    {
        return view('kriya.order-success', [
            'catalog' => $this->catalog(),
            'catalogJson' => json_encode($this->catalog()),
        ]);
    }

    public function seller(): View
    {
        $catalog = $this->catalog();

        return view('kriya.seller', [
            'catalog' => $catalog,
            'products' => $catalog,
            'catalogJson' => json_encode($catalog),
        ]);
    }
}
