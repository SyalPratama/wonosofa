@extends('layouts.home')

@section('title', 'Hubungi Kami — Wonosofa')

@section('content')

    <!-- HEADER HALAMAN -->
    <section class="pt-32 md:pt-40 pb-12 px-6 md:px-10">
        <div class="max-w-7xl mx-auto">
            <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-4">Kontak</p>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <h1 class="font-display text-4xl md:text-5xl tracking-tight max-w-lg">
                    Ada pertanyaan? Kami senang mendengarnya.
                </h1>
                <p class="text-charcoal-900/60 max-w-sm">
                    Isi formulir di samping atau hubungi kami langsung, tim kami akan merespons
                    dalam 1x24 jam kerja.
                </p>
            </div>
        </div>
    </section>

    <!-- INFO + FORM -->
    <section class="py-16 md:py-20 px-6 md:px-10">
        <div class="max-w-7xl mx-auto grid md:grid-cols-5 gap-8">

            <!-- INFO KONTAK (KIRI) -->
            <div class="md:col-span-2 space-y-6">

                <!-- CARD ALAMAT -->
                <div class="rounded-2xl border border-line bg-stone-50 p-6 space-y-6">
                    <div>
                        <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-3">Alamat</p>
                        <p class="text-charcoal-900/70 leading-relaxed">
                            Jl. Kayu Manis No. 12, Kemang<br>Jakarta Selatan, 12730
                        </p>
                    </div>
                    <div>
                        <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-3">Email</p>
                        <a href="mailto:hello@Wonosofa.id" class="text-charcoal-900/70 hover:text-charcoal-900">
                            hello@Wonosofa.id
                        </a>
                    </div>
                    <div>
                        <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-3">Telepon</p>
                        <a href="tel:+622112345678" class="text-charcoal-900/70 hover:text-charcoal-900">
                            (021) 1234 5678
                        </a>
                    </div>
                    <div>
                        <p class="uppercase tracking-[0.2em] text-xs text-olive-700 font-medium mb-3">Jam Operasional</p>
                        <p class="text-charcoal-900/70 leading-relaxed">
                            Senin – Sabtu, 09.00 – 18.00 WIB
                        </p>
                    </div>
                </div>

                <!-- CARD MAPS -->
                <div class="rounded-2xl border border-line overflow-hidden aspect-[4/3]">
                    <iframe src="https://www.google.com/maps?q=Kemang,Jakarta+Selatan&output=embed"
                        class="w-full h-full border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- FORM (KANAN) -->
            <div class="md:col-span-3">
                <div class="rounded-2xl border border-line bg-stone-50 p-6 md:p-8">

                    @if (session('success'))
                        <div class="mb-6 rounded-xl bg-olive-700/10 text-olive-700 text-sm px-5 py-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="#" class="space-y-5">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label class="text-sm text-charcoal-900/70 mb-2 block">Nama</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-xl border border-line px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                                @error('name')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm text-charcoal-900/70 mb-2 block">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full rounded-xl border border-line px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                                @error('email')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="text-sm text-charcoal-900/70 mb-2 block">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full rounded-xl border border-line px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            @error('phone')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm text-charcoal-900/70 mb-2 block">Pesan</label>
                            <textarea name="message" rows="6" required
                                class="w-full rounded-xl border border-line px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="inline-flex text-sm font-medium bg-charcoal-900 text-stone-50 px-6 py-3 rounded-full hover:bg-olive-700 transition-colors">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

@endsection
