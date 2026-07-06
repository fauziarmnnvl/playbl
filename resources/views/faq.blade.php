@extends('layouts.app')

@section('content')

<section class="min-h-screen py-20 md:py-32 px-4 md:px-8">

    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-16">

            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4">
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

                <summary class="flex justify-between items-start md:items-center cursor-pointer px-5 py-4 md:px-6 md:py-5 text-white font-semibold text-base md:text-lg">

                    Bagaimana cara melakukan booking?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-5 pb-4 md:px-6 md:pb-5 text-slate-400 text-sm md:text-base leading-relaxed">

                    Klik tombol Book Now, isi informasi pemain, pilih cabang, pilih Playbox,
                    tentukan durasi bermain, lalu lanjutkan ke pembayaran.

                </div>

            </details>

            {{-- FAQ 2 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-start md:items-center cursor-pointer px-5 py-4 md:px-6 md:py-5 text-white font-semibold text-base md:text-lg">

                    Metode pembayaran apa yang tersedia?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-5 pb-4 md:px-6 md:pb-5 text-slate-400 text-sm md:text-base leading-relaxed">

                    Pembayaran dilakukan menggunakan QRIS yang dapat dibayar
                    melalui semua e-wallet dan mobile banking yang mendukung QRIS.

                </div>

            </details>

            {{-- FAQ 3 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-start md:items-center cursor-pointer px-5 py-4 md:px-6 md:py-5 text-white font-semibold text-base md:text-lg">

                    Apa itu sesi fleksibel?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-5 pb-4 md:px-6 md:pb-5 text-slate-400 text-sm md:text-base leading-relaxed">

                    Sesi fleksibel memungkinkan pelanggan bermain terlebih dahulu.
                    Tagihan akan dihitung berdasarkan durasi penggunaan dan dibayar
                    setelah sesi selesai.

                </div>

            </details>

            {{-- FAQ 4 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-start md:items-center cursor-pointer px-5 py-4 md:px-6 md:py-5 text-white font-semibold text-base md:text-lg">

                    Bagaimana cara mengakhiri sesi fleksibel?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-5 pb-4 md:px-6 md:pb-5 text-slate-400 text-sm md:text-base leading-relaxed">

                    Tekan tombol "Akhiri Sesi" pada halaman sesi bermain.
                    Sistem akan menghitung total tagihan dan menampilkan QRIS pembayaran.

                </div>

            </details>

            {{-- FAQ 5 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-start md:items-center cursor-pointer px-5 py-4 md:px-6 md:py-5 text-white font-semibold text-base md:text-lg">

                    Bagaimana jika Playbox mengalami kerusakan?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-5 pb-4 md:px-6 md:pb-5 text-slate-400 text-sm md:text-base leading-relaxed">

                    Segera hubungi petugas cafe atau operator BoxPlay agar dapat dilakukan
                    pengecekan dan penanganan lebih lanjut.

                </div>

            </details>

            {{-- FAQ 6 --}}
            <details class="group bg-[#172742] rounded-2xl border border-white/10 overflow-hidden">

                <summary class="flex justify-between items-start md:items-center cursor-pointer px-5 py-4 md:px-6 md:py-5 text-white font-semibold text-base md:text-lg">

                    Bagaimana cara menghubungi BoxPlay?

                    <span class="transition group-open:rotate-180">
                        ▼
                    </span>

                </summary>

                <div class="px-5 pb-4 md:px-6 md:pb-5 text-slate-400 text-sm md:text-base leading-relaxed">

                    Hubungi kami melalui WhatsApp di nomor
                    +62 852-6293-9746 atau melalui Instagram resmi BoxPlay.

                </div>

            </details>

        </div>

    </div>

</section>

@endsection