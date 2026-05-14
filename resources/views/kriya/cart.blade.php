@extends('layouts.kriya')

@section('title', 'Keranjang — Kriya.Lokal')

@section('content')
    <section class="border-b border-kriya-brown/10 bg-kriya-cream py-12 md:py-16">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h1 class="font-serif-display text-4xl font-semibold text-kriya-brown-deep">Keranjang Belanja</h1>
            <p class="mt-2 text-sm text-kriya-brown/70">Barang disimpan di peramban Anda untuk demo pitch.</p>

            <div id="kriya-cart-empty"
                class="mt-10 rounded-2xl border border-dashed border-kriya-brown/25 bg-white p-10 text-center text-kriya-brown/70">
                Keranjang masih kosong. <a href="{{ route('kriya.collection') }}"
                    class="font-semibold text-kriya-terracotta underline">Jelajahi koleksi</a>
            </div>

            <div id="kriya-cart-wrapper"
                class="mt-10 hidden grid gap-10 lg:grid-cols-[1fr_360px]">
                <div id="kriya-cart-lines" class="space-y-4" aria-live="polite"></div>

                <aside class="h-fit rounded-2xl border border-kriya-brown/15 bg-white p-6 shadow-sm">
                    <h2 class="font-serif-display text-xl font-semibold text-kriya-brown-deep">Ringkasan</h2>
                    <dl class="mt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt>Subtotal</dt>
                            <dd id="kriya-cart-subtotal">Rp0</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Pengiriman (est.)</dt>
                            <dd id="kriya-cart-shipping">Rp20.000</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt>Diskon</dt>
                            <dd id="kriya-cart-discount">Rp0</dd>
                        </div>
                        <div class="flex justify-between border-t border-kriya-brown/10 pt-3 text-base font-bold">
                            <dt>Total</dt>
                            <dd id="kriya-cart-total">Rp0</dd>
                        </div>
                    </dl>
                    <p class="mt-4 text-xs text-kriya-brown/55">Ongkir final dikonfirmasi di checkout (demo tetap Rp20.000).</p>
                    <a href="{{ route('kriya.checkout') }}"
                        class="mt-6 flex w-full items-center justify-center rounded-full bg-kriya-orange px-6 py-3 text-sm font-semibold text-white hover:bg-kriya-rust transition">
                        Checkout
                    </a>
                </aside>
            </div>
        </div>
    </section>
@endsection
