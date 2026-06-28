<section class="bg-[#16233B] min-h-screen py-24">

    <div class="max-w-7xl mx-auto px-8">
        @php
            $featuredPromo = $promoList->first();
            $otherPromos = $promoList->skip(1);
        @endphp

        <!-- Title -->
        <div class="text-center mt-24">

            <h2 class="text-5xl md:text-6xl font-bold text-white">
                Event &
                <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">
                    Promo
                </span>
            </h2>

            <p class="text-gray-400 mt-5 max-w-3xl mx-auto">
                Jangan lewatkan penawaran menarik dari kami. Gunakan promo di bawah ini untuk
                pengalaman gaming yang lebih hemat.
            </p>

        </div>

        <!-- Featured Promo -->
        <div class="mt-16">

            <div class="bg-gradient-to-r from-[#2B245E] to-[#243B7B]
                        rounded-3xl overflow-hidden
                        border border-purple-500/30
                        shadow-xl">

                <div class="grid md:grid-cols-[280px_1fr]">

                    <!-- Image -->
                    <div class="relative">

                        <img
                            src="{{ $featuredPromo && $featuredPromo->banner_promo ? asset($featuredPromo->banner_promo) : asset('images/no-image.png') }}"
                            class="w-full h-full object-cover">

                        <span class="absolute top-4 left-4
                                     bg-gradient-to-r from-purple-500 to-blue-500
                                     text-white text-sm
                                     px-4 py-2 rounded-full font-medium">

                            @if($featuredPromo)
                                @if($featuredPromo->tipe_diskon == 'Persentase')
                                    {{ (int)$featuredPromo->nilai_diskon }}% OFF
                                @else
                                    Rp {{ number_format($featuredPromo->nilai_diskon,0,',','.') }}
                                @endif
                            @endif

                        </span>
                    </div>

                    <!-- Content -->
                    <div class="p-10 flex flex-col justify-center">

                        <h3 class="text-5xl font-bold text-white">
                            {{ $featuredPromo?->nama_promo }}
                        </h3>

                        <p class="text-gray-300 text-xl mt-5 max-w-3xl">
                            Diskon spesial untuk penyewaan minimal 3 jam di akhir pekan.
                            Ajak teman-temanmu mabar sekarang!
                        </p>

                        <p class="text-gray-400 mt-8 text-sm">
                            📅 Berlaku hingga: {{ $featuredPromo?->tanggal_selesai?->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Promo Lainnya -->
        <div class="mt-16">

            <h3 class="text-4xl font-bold text-white mb-8">
                Promo Lainnya
            </h3>

            <div class="grid md:grid-cols-2 gap-8">
                @foreach($otherPromos as $promo)
                <div class="bg-[#223251] rounded-3xl overflow-hidden shadow-xl">
                    <div class="grid grid-cols-[220px_1fr]">

                        <div class="relative">
                            <img
                                src="{{ $promo->banner_promo ? asset($promo->banner_promo) : asset('images/no-image.png') }}"
                                class="w-full h-full object-cover">

                            <span class="absolute top-3 left-3 bg-gradient-to-r from-purple-500 to-blue-500 text-white text-xs px-3 py-1 rounded-full">
                                @if($promo->tipe_diskon == 'Persentase')
                                    {{ (int)$promo->nilai_diskon }}% OFF
                                @else
                                    Rp {{ number_format($promo->nilai_diskon,0,',','.') }}
                                @endif
                            </span>
                        </div>

                        <div class="p-5">
                            <h4 class="text-3xl font-bold text-white">
                                {{ $promo->nama_promo }}
                            </h4>

                            <p class="text-gray-300 text-[15px] mt-3 leading-5">
                            Siang hari bukan berarti sepi. Nikmati promo Happy Hour dan mabar dengan harga lebih hemat!
                            </p>

                            <p class="text-gray-500 mt-5 text-sm">
                                📅 Berlaku hingga: {{ $promo->tanggal_selesai->format('d M Y') }}
                            </p>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>