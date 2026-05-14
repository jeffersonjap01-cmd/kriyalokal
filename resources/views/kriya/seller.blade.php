@extends('layouts.kriya')

@section('title', 'Dashboard Penjual — Kriya.Lokal')

@section('content')

    {{-- ═══════════════════════════════════════════
         DASHBOARD HEADER
    ═══════════════════════════════════════════ --}}
    <section class="kriya-pattern py-12 md:py-16">
        <div class="kriya-corner-ornament top-left" style="opacity:.12;"></div>
        <div class="kriya-corner-ornament top-right" style="opacity:.12;"></div>

        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <span class="kriya-section-label">
                        <i class="fas fa-store text-[9px]"></i> Panel Kelola
                    </span>
                    <h1 class="mt-4 font-serif-display text-3xl md:text-4xl font-bold text-kriya-cream-light">
                        Dashboard Penjual
                    </h1>
                    <p class="mt-2 text-sm text-kriya-cream/65 font-body-serif">
                        Kelola produk UMKM budaya Anda — setiap perubahan muncul langsung di etalase publik.
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <button type="button" id="kriya-seller-add-open"
                        class="kriya-btn-primary">
                        <i class="fas fa-plus text-xs"></i> Produk Baru
                    </button>
                    <button type="button" id="kriya-seller-export"
                        class="inline-flex items-center gap-1.5 rounded-full border text-sm font-semibold px-4 py-2.5 transition"
                        style="border-color: rgba(201,162,39,0.35); color: var(--color-kriya-cream); background: rgba(255,255,255,0.07);">
                        <i class="fas fa-file-export text-xs"></i> Export JSON
                    </button>
                    <button type="button" id="kriya-seller-import"
                        class="inline-flex items-center gap-1.5 rounded-full border text-sm font-semibold px-4 py-2.5 transition"
                        style="border-color: rgba(201,162,39,0.35); color: var(--color-kriya-cream); background: rgba(255,255,255,0.07);">
                        <i class="fas fa-file-import text-xs"></i> Import JSON
                    </button>
                    <input type="file" id="kriya-seller-import-file" accept="application/json" class="hidden">
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════
         STATS + TABLE
    ═══════════════════════════════════════════ --}}
    <section class="kriya-pattern-soft py-10 md:py-14">
        <div class="mx-auto max-w-6xl px-4 md:px-6">

            {{-- Stat cards --}}
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ([
                    ['Pesanan (mock)', '128', 'fa-receipt', '#c8611a'],
                    ['Pendapatan Bulan Ini', 'Rp42jt', 'fa-chart-line', '#c9a227'],
                    ['Produk Aktif', count($products), 'fa-shirt', '#8b4513'],
                ] as $stat)
                    <div class="kriya-card p-5">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl flex-shrink-0"
                                style="background: rgba({{ $stat[3] === '#c8611a' ? '200,97,26' : ($stat[3] === '#c9a227' ? '201,162,39' : '139,69,19') }}, 0.12);">
                                <i class="fas {{ $stat[2] }} text-base" style="color: {{ $stat[3] }};"></i>
                            </div>
                            <div>
                                <p class="text-[11px] uppercase tracking-wider font-semibold text-kriya-brown/55">{{ $stat[0] }}</p>
                                <p class="text-2xl font-bold text-kriya-brown-deep font-serif-display mt-0.5">{{ $stat[1] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ─── PRODUK TABLE (fixed spacing) ─── --}}
            <div class="mt-8 kriya-card overflow-hidden">
                <div class="px-6 py-4 flex flex-wrap justify-between gap-2 items-center"
                    style="border-bottom: 1px solid rgba(92,51,23,0.10); background: var(--color-kriya-cream-light);">
                    <div>
                        <h2 class="font-serif-display text-lg font-bold text-kriya-brown-deep">Produk Anda</h2>
                        <p class="text-xs text-kriya-brown/50 mt-0.5">Tambah, edit, atau hapus produk dari katalog Anda</p>
                    </div>
                    <span class="text-xs text-kriya-brown/50 hidden md:block">CRUD menyatu dengan etalase publik setelah refresh.</span>
                </div>

                {{-- Scrollable table wrapper --}}
                <div class="overflow-x-auto">
                    <table class="kriya-table">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Nama Produk</th>
                                <th style="width: 20%;">Kategori</th>
                                <th class="col-price" style="width: 20%;">Harga</th>
                                <th class="col-stock" style="width: 10%;">Stok</th>
                                <th class="col-action" style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kriya-seller-tbody">
                            {{-- Rows injected by seller-page.js --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tip --}}
            <p class="mt-6 text-center text-xs text-kriya-brown/50">
                <i class="fas fa-lightbulb mr-1 text-kriya-gold/60"></i>
                Tips demo: tambahkan produk baru lalu buka
                <a href="{{ route('kriya.collection') }}" class="underline font-semibold text-kriya-terracotta">Koleksi</a>
                di tab lain untuk melihat kartu baru muncul.
            </p>
        </div>
    </section>

    {{-- ─── ADD / EDIT DIALOG ─── --}}
    <dialog id="kriya-seller-dialog"
        class="w-[min(100%,540px)] rounded-2xl p-0 shadow-2xl"
        style="border: 1px solid rgba(92,51,23,0.15);">
        <form id="kriya-seller-form" class="flex max-h-[90vh] flex-col">

            {{-- Dialog header --}}
            <div class="flex justify-between items-center px-6 py-4"
                style="border-bottom: 1px solid rgba(92,51,23,0.10); background: linear-gradient(135deg, #3d1d0d, #5c3317);">
                <h3 class="font-serif-display text-lg font-bold text-kriya-cream-light">Detail Produk</h3>
                <button type="button"
                    onclick="document.getElementById('kriya-seller-dialog').close()"
                    class="text-kriya-cream/60 hover:text-kriya-cream transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Dialog body --}}
            <div class="overflow-y-auto px-6 py-5 space-y-4 bg-white">
                <input type="hidden" name="id" value="">

                {{-- Nama --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">Nama Produk</label>
                    <input name="name" required class="kriya-input">
                </div>

                {{-- Price + Stock --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">Harga (Rp)</label>
                        <input name="price" type="number" min="0" required class="kriya-input">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">Stok</label>
                        <input name="stock" type="number" min="0" class="kriya-input">
                    </div>
                </div>

                {{-- Category + Heritage --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">Kategori</label>
                        <input name="category" class="kriya-input" placeholder="T-Shirt">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">Warisan / Motif</label>
                        <input name="heritage" class="kriya-input">
                    </div>
                </div>

                {{-- Image file --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">
                        File gambar <span class="font-normal lowercase normal-case text-kriya-brown/45">(nama file di /public/images/kriya/)</span>
                    </label>
                    <input name="image" class="kriya-input" placeholder="contoh.jpg">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" class="kriya-input" style="resize:vertical;"></textarea>
                </div>

                {{-- Story --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wide text-kriya-brown/70 mb-1.5">
                        Cerita Budaya <span class="font-normal lowercase normal-case text-kriya-brown/45">(storytelling produk)</span>
                    </label>
                    <textarea name="story" rows="3" class="kriya-input" style="resize:vertical;"></textarea>
                </div>

                {{-- Featured --}}
                <label class="flex items-center gap-2.5 text-sm text-kriya-brown/80 cursor-pointer">
                    <input type="checkbox" name="featured" value="1"
                        class="rounded text-kriya-orange"
                        style="border-color: rgba(92,51,23,0.3);">
                    <span>Tampil sebagai koleksi unggulan di beranda</span>
                </label>
            </div>

            {{-- Dialog footer --}}
            <div class="flex justify-end gap-2 px-6 py-4"
                style="border-top: 1px solid rgba(92,51,23,0.10); background: var(--color-kriya-cream-light);">
                <button type="button"
                    onclick="document.getElementById('kriya-seller-dialog').close()"
                    class="rounded-full px-5 py-2.5 text-sm font-semibold text-kriya-brown/70 hover:bg-white transition border border-kriya-brown/15">
                    Batal
                </button>
                <button type="submit"
                    class="kriya-btn-primary" style="padding: 0.625rem 1.5rem;">
                    <i class="fas fa-save text-xs"></i> Simpan
                </button>
            </div>
        </form>
    </dialog>

@endsection
