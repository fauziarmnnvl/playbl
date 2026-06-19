@extends('layouts.app')

@section('content')

<section class="min-h-screen py-32 px-4">

    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-16">

            <h1 class="text-5xl font-bold text-white mb-4">
                Frequently Asked Questions
            </h1>

            <p class="text-slate-400">
                Temukan jawaban untuk pertanyaan yang sering ditanyakan pengguna BoxPlay.
            </p>

        </div>

        {{-- FAQ Accordion --}}
        <div class="space-y-4">

            {{-- FAQ 1 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-center cursor-pointer px-6 py-5 text-white font-semibold text-lg">

                    Bagaimana cara melakukan booking?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-6 pb-5 text-slate-400">

                    Klik tombol Book Now, isi informasi pemain, pilih cabang, pilih Playbox,
                    tentukan durasi bermain, lalu lanjutkan ke pembayaran.

                </div>

            </details>

            {{-- FAQ 2 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-center cursor-pointer px-6 py-5 text-white font-semibold text-lg">

                    Metode pembayaran apa yang tersedia?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-6 pb-5 text-slate-400">

                    Pembayaran dilakukan menggunakan QRIS yang dapat dibayar
                    melalui semua e-wallet dan mobile banking yang mendukung QRIS.

                </div>

            </details>

            {{-- FAQ 3 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-center cursor-pointer px-6 py-5 text-white font-semibold text-lg">

                    Apa itu sesi fleksibel?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-6 pb-5 text-slate-400">

                    Sesi fleksibel memungkinkan pelanggan bermain terlebih dahulu.
                    Tagihan akan dihitung berdasarkan durasi penggunaan dan dibayar
                    setelah sesi selesai.

                </div>

            </details>

            {{-- FAQ 4 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-center cursor-pointer px-6 py-5 text-white font-semibold text-lg">

                    Bagaimana cara mengakhiri sesi fleksibel?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-6 pb-5 text-slate-400">

                    Tekan tombol "Akhiri Sesi" pada halaman sesi bermain.
                    Sistem akan menghitung total tagihan dan menampilkan QRIS pembayaran.

                </div>

            </details>

            {{-- FAQ 5 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-center cursor-pointer px-6 py-5 text-white font-semibold text-lg">

                    Bagaimana jika Playbox mengalami kerusakan?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-6 pb-5 text-slate-400">

                    Segera hubungi petugas cafe atau operator BoxPlay agar dapat dilakukan
                    pengecekan dan penanganan lebih lanjut.

                </div>

            </details>

            {{-- FAQ 6 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-center cursor-pointer px-6 py-5 text-white font-semibold text-lg">

                    Bagaimana cara menghubungi BoxPlay?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-6 pb-5 text-slate-400">

                    Hubungi kami melalui WhatsApp di nomor
                    +62 852-6293-9746 atau melalui Instagram resmi BoxPlay.

                </div>

            </details>

        </div>

    </div>

</section>

@endsection