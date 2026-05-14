@extends('layouts.kriya')

@section('title', 'Checkout — Kriya.Lokal')

@section('content')
    <section class="border-b border-kriya-brown/10 bg-kriya-cream-dark py-10 md:py-14" x-data="{ payment: 'qris' }">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <h1 class="font-serif-display text-4xl font-semibold text-kriya-brown-deep">Checkout</h1>

            <div class="mt-10 grid gap-10 lg:grid-cols-[1fr_380px]">
                <form id="kriya-checkout-form" class="space-y-8 rounded-2xl border border-kriya-brown/10 bg-white p-6 shadow-sm"
                    data-success-url="{{ route('kriya.order-success') }}">

                    <div class="flex items-center gap-2 text-kriya-brown-deep">
                        <i class="fas fa-location-dot text-kriya-terracotta"></i>
                        <h2 class="font-semibold text-lg">Detail Pesanan</h2>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-kriya-brown/20 px-4 py-3 has-[:checked]:border-kriya-terracotta has-[:checked]:bg-kriya-cream-dark">
                            <input type="radio" name="fulfillment" value="delivery" class="text-kriya-terracotta"
                                checked>
                            <i class="fas fa-truck"></i>
                            <span class="text-sm font-medium">Delivery</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-kriya-brown/20 px-4 py-3 has-[:checked]:border-kriya-terracotta has-[:checked]:bg-kriya-cream-dark">
                            <input type="radio" name="fulfillment" value="pickup" class="text-kriya-terracotta">
                            <i class="fas fa-box"></i>
                            <span class="text-sm font-medium">Pick up</span>
                        </label>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Nama
                                lengkap</label>
                            <input name="name" required
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Email</label>
                            <input type="email" name="email" required
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Nomor
                                telepon</label>
                            <input name="phone" required placeholder="+62 …"
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Negara</label>
                            <select name="country"
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                                <option value="ID" selected>Indonesia</option>
                                <option value="OTHER">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Kota</label>
                            <input name="city" required
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Provinsi</label>
                            <input name="province" required
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Kode
                                pos</label>
                            <input name="postal" required
                                class="mt-1 w-full rounded-lg border border-kriya-brown/20 px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                        </div>
                    </div>

                    <div class="border-t border-kriya-brown/10 pt-6">
                        <h3 class="font-semibold text-kriya-brown-deep mb-3">Metode pembayaran</h3>
                        <div class="flex flex-wrap gap-3">
                            <label
                                class="flex cursor-pointer items-center gap-2 rounded-xl border border-kriya-brown/20 px-4 py-3 has-[:checked]:border-kriya-orange has-[:checked]:bg-kriya-cream-dark">
                                <input type="radio" name="payment" value="tunai" class="text-kriya-orange"
                                    x-model="payment">
                                <span class="text-sm font-medium">Uang tunai (COD)</span>
                            </label>
                            <label
                                class="flex cursor-pointer items-center gap-2 rounded-xl border border-kriya-brown/20 px-4 py-3 has-[:checked]:border-kriya-orange has-[:checked]:bg-kriya-cream-dark">
                                <input type="radio" name="payment" value="qris" class="text-kriya-orange"
                                    x-model="payment">
                                <span class="text-sm font-medium">QRIS</span>
                            </label>
                        </div>

                        <div x-show="payment === 'tunai'" x-transition class="mt-4 rounded-xl bg-kriya-cream-dark p-4 text-sm text-kriya-brown/85 border border-kriya-brown/10">
                            <p><strong>COD:</strong> Siapkan pembayaran tunai saat paket tiba. Kurir akan mengonfirmasi nominal dari ringkasan pesanan ini.</p>
                        </div>

                        <div x-show="payment === 'qris'" x-transition class="mt-4 flex flex-col items-center gap-3 rounded-xl border border-kriya-brown/15 bg-white p-6">
                            <p class="text-sm text-center text-kriya-brown/80">Scan kode QR berikut (placeholder demo). Nominal mengikuti total checkout.</p>
                            <img src="{{ asset('images/kriya/qris-placeholder.svg') }}" alt="QRIS"
                                class="h-44 w-44 object-contain"
                                onerror="this.onerror=null;this.src='{{ asset('images/kriya/placeholder.svg') }}';">
                            <p class="text-xs text-kriya-brown/55">Integrasi gateway asli dapat ditambahkan pada fase produksi.</p>
                        </div>
                    </div>

                    <label class="flex cursor-pointer items-start gap-3 text-sm text-kriya-brown/85">
                        <input type="checkbox" name="terms" class="mt-1 rounded border-kriya-brown/30 text-kriya-orange focus:ring-kriya-gold/40">
                        <span>Saya setuju dengan syarat dan ketentuan website ini.</span>
                    </label>

                    <button type="submit"
                        class="w-full rounded-full bg-kriya-orange py-3.5 font-serif-display text-lg font-semibold text-white shadow-lg hover:bg-kriya-rust transition">
                        Bayar Sekarang
                    </button>
                </form>

                <aside class="space-y-6">
                    <div class="rounded-2xl border border-kriya-brown/15 bg-white p-6 shadow-sm">
                        <h2 class="font-serif-display text-xl font-semibold text-kriya-brown-deep">Keranjang belanja</h2>
                        <div id="kriya-checkout-lines" class="mt-4 max-h-72 overflow-y-auto"></div>
                        <div class="mt-4 border-t border-kriya-brown/10 pt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span id="kriya-sum-subtotal">Rp0</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Pengiriman</span>
                                <span id="kriya-sum-shipping">Rp0</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Diskon</span>
                                <span id="kriya-sum-discount">Rp0</span>
                            </div>
                            <div class="flex justify-between text-base font-bold pt-2 border-t border-kriya-brown/10">
                                <span>Total</span>
                                <span id="kriya-sum-total">Rp0</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-kriya-brown/15 bg-white p-6 shadow-sm">
                        <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70">Kode diskon</label>
                        <div class="mt-2 flex gap-2">
                            <input type="text" name="discount_code" form="kriya-checkout-form"
                                placeholder="Coba BUDAYA10 atau NUSANTARA"
                                class="flex-1 rounded-lg border border-kriya-brown/20 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-kriya-gold/40">
                            <span class="rounded-lg border border-kriya-brown/20 px-3 py-2 text-xs text-kriya-brown/55 whitespace-nowrap flex items-center">Auto</span>
                        </div>
                        <p class="mt-2 text-xs text-kriya-brown/55">Diskon diterapkan otomatis saat Anda mengetik kode.</p>
                    </div>

                    <div class="rounded-xl bg-kriya-brown-deep/5 p-4 text-xs text-kriya-brown/70 leading-relaxed">
                        <strong class="text-kriya-brown-deep">BoFu:</strong> transaksi ini menyimulasikan pengalaman aman
                        mendukung pengrajin — kemasan dan material bermutu menjadi janji merek kami.
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
