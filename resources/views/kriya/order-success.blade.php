@extends('layouts.kriya')

@section('title', 'Pesanan berhasil — Kriya.Lokal')

@section('content')
    <section class="border-b border-kriya-brown/10 bg-kriya-cream-dark py-16 md:py-24">
        <div class="mx-auto max-w-2xl px-4 text-center md:px-6">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-600/15 text-emerald-700">
                <i class="fas fa-check text-2xl"></i>
            </div>
            <h1 class="mt-6 font-serif-display text-3xl font-semibold text-kriya-brown-deep">Terima kasih!</h1>
            <p class="mt-3 text-kriya-brown/80">Pesanan demo Anda telah dicatat di peramban.</p>

            <div id="kriya-order-summary"
                class="mt-10 rounded-2xl border border-kriya-brown/15 bg-white p-6 text-left text-sm shadow-sm hidden">
            </div>

            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="{{ route('kriya.collection') }}"
                    class="rounded-full bg-kriya-orange px-6 py-3 font-semibold text-white hover:bg-kriya-rust transition">Lanjut
                    belanja</a>
                <a href="{{ route('kriya.home') }}?demo=1"
                    class="rounded-full border border-kriya-brown/25 px-6 py-3 font-semibold text-kriya-brown-deep hover:bg-white transition">Kembali
                    beranda</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const raw = sessionStorage.getItem('kriya_last_order_v1');
            const box = document.getElementById('kriya-order-summary');
            if (!raw || !box) return;
            let data;
            try {
                data = JSON.parse(raw);
            } catch {
                return;
            }
            box.classList.remove('hidden');
            const pay = data.payment === 'tunai' ? 'Uang tunai (COD)' : 'QRIS';
            const ff = data.fulfillment === 'pickup' ? 'Pick up' : 'Delivery';
            const fmt = (n) => new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(Number(n) || 0);
            box.innerHTML = `
                <p class="font-semibold text-kriya-brown-deep mb-2">Ringkasan pesanan</p>
                <p><strong>Metode:</strong> ${pay}</p>
                <p><strong>Fulfillment:</strong> ${ff}</p>
                <p><strong>Diskon:</strong> ${data.discount_code || '-'} </p>
                <p class="mt-2"><strong>Total:</strong> ${fmt(data.totals?.total)}</p>
                <p class="mt-4 text-xs text-kriya-brown/60">Retention: nantikan promo koleksi baru melalui newsletter & DM Instagram @KriyaLokal.</p>
            `;
        });
    </script>
@endpush
