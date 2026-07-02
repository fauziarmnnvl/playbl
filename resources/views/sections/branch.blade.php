<section class="bg-[#16233B] min-h-screen py-24">

<div class="max-w-7xl mx-auto px-8">

    <!-- Title -->
    <div class="text-center mt-24">

        <h2 class="text-5xl md:text-6xl font-bold text-white">
            Cafe
            <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">
                Partner
            </span>
        </h2>

        <p class="text-gray-400 mt-5 max-w-2xl mx-auto">
            Nikmati pengalaman bermain PlayStation di cafe partner terbaik BoxPlay.id
        </p>

    </div>

    <!-- Cards -->
   <div class="grid md:grid-cols-2 gap-8 mt-16">
        @foreach($cabangs as $cabang)
        <div class="bg-[#223251] rounded-3xl overflow-hidden shadow-xl">
            <img
                src="{{ $cabang->foto_cabang
                    ? asset($cabang->foto_cabang)
                    : asset('images/branch/default.jpg') }}"
                class="w-full h-64 object-cover">
            <div class="p-6">
                <div class="flex items-center justify-between">

                    <h3 class="text-2xl font-bold text-white">
                        {{ $cabang->nama_cabang }}
                    </h3>

                    @if($cabang->status_buka)
                        <span class="bg-green-500 text-xs px-3 py-1 rounded-full">
                            AKTIF
                        </span>
                    @else
                        <span class="bg-red-500 text-xs px-3 py-1 rounded-full">
                            NONAKTIF
                        </span>
                    @endif
                </div>
                <p class="text-gray-400 mt-4">
                    {{ $cabang->alamat_cabang }}
                </p>

                <div class="flex justify-between mt-6">
                    <div>
                        <p class="text-gray-500 text-sm">
                            Jam Operasional
                        </p>

                        <p class="text-white">
                            {{ $cabang->jam_operasional }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">
                            Playbox
                        </p>

                        <p class="text-blue-400 font-semibold">
                            {{ $cabang->playbox_count }} Unit
                        </p>
                    </div>
                </div>

                @if($cabang->link_maps)
                <a
                    href="{{ $cabang->link_maps }}"
                    target="_blank"
                    class="block w-full mt-6 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-blue-500 hover:scale-105 transition text-center text-white font-medium">
                    Kunjungi Lokasi
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>

</section>
