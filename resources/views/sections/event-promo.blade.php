<section class="bg-[#16233B] min-h-screen py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-8">
        @php
            $featuredPromo = $promoList->first();
            $otherPromos = $promoList->skip(1);
        @endphp

        <!-- Title -->
        <div class="text-center mt-12 md:mt-24">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white">
                Event &
                <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">
                    Promo
                </span>
            </h2>

            <p class="text-gray-400 mt-4 md:mt-5 max-w-3xl mx-auto text-sm md:text-base">
                Jangan lewatkan penawaran menarik dari kami. Gunakan promo di bawah ini untuk
                pengalaman gaming yang lebih hemat.
            </p>
        </div>

        @if($featuredPromo)
            <!-- Featured Promo -->
            <div class="mt-16">
                <div class="bg-gradient-to-r from-[#2B245E] to-[#243B7B] rounded-3xl overflow-hidden border border-purple-500/30 shadow-xl">
                    <div class="grid md:grid-cols-[480px_1fr] min-h-[250px]">
                        <!-- Image -->
                        <div class="relative bg-[#0B1730] overflow-hidden">
                            <img
                                src="{{ $featuredPromo->banner_promo ? Storage::url($featuredPromo->banner_promo) : asset('images/no-image.png') }}"
                                alt="{{ $featuredPromo->nama_promo }}"
                                class="w-full h-full object-cover object-center">
                        </div>

                        <!-- Content -->
                        <div class="p-6 md:p-10 flex flex-col justify-center">
                            <h3 class="text-3xl md:text-5xl font-bold text-white">
                                {{ $featuredPromo->nama_promo }}
                            </h3>

                            <p class="text-gray-300 text-base md:text-xl mt-4 md:mt-5 max-w-3xl">
                                {{ $featuredPromo->deskripsi }}
                            </p>

                            <p class="text-gray-400 mt-8 text-sm">
                                📅 Berlaku hingga: {{ $featuredPromo->tanggal_selesai?->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($otherPromos->count())
            <!-- Promo Lainnya -->
            <div class="mt-12 md:mt-16">
                <h3 class="text-2xl md:text-4xl font-bold text-white mb-6 md:mb-8">
                    Promo Lainnya
                </h3>

                <div class="grid md:grid-cols-2 gap-8">
                   @foreach($otherPromos as $promo)
                        <div class="bg-[#223251] rounded-3xl overflow-hidden shadow-xl">
                            <div class="bg-[#0B1730]">
                                <img
                                    src="{{ $promo->banner_promo ? Storage::url($promo->banner_promo) : asset('images/no-image.png') }}"
                                    alt="{{ $promo->nama_promo }}"
                                    class="w-full aspect-video object-cover">
                            </div>

                            <div class="p-5 md:p-6">
                                <h4 class="text-2xl md:text-3xl font-bold text-white">
                                    {{ $promo->nama_promo }}
                                </h4>

                                <p class="text-gray-300 text-[15px] mt-3 leading-5">
                                    {{ $promo->deskripsi }}
                                </p>

                                <p class="text-gray-500 mt-5 text-sm">
                                    📅 Berlaku hingga: {{ $promo->tanggal_selesai->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>