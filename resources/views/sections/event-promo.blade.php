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
                        <div class="relative bg-[#0B1730] overflow-hidden">
                            <img
                                src="{{ $featuredPromo->banner_promo ? Storage::url($featuredPromo->banner_promo) : asset('images/no-image.png') }}"
                                alt="{{ $featuredPromo->nama_promo }}"
                                class="w-full h-full object-cover object-center">
                        </div>

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
        @else
            <!-- Empty State -->
            <div class="mt-14 md:mt-16">
                <div class="max-w-2xl mx-auto text-center rounded-3xl border border-white/10 bg-white/[0.03] px-6 py-12 md:px-10 md:py-14">
                    <div class="w-16 h-16 mx-auto flex items-center justify-center rounded-2xl bg-gradient-to-br from-purple-500/20 to-blue-500/20 border border-purple-400/20">
                        <svg class="w-8 h-8 text-purple-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 12a2 2 0 0 0 0-4V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v2a2 2 0 0 0 0 4v2a2 2 0 0 0 0 4v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2a2 2 0 0 0 0-4v-2Z"/>
                            <path d="M13 5v2"/>
                            <path d="M13 17v2"/>
                            <path d="M13 11v2"/>
                        </svg>
                    </div>

                    <h3 class="mt-6 text-2xl md:text-3xl font-bold text-white">
                        Belum Ada Promo
                    </h3>

                    <p class="mt-3 text-sm md:text-base text-gray-400 max-w-md mx-auto leading-relaxed">
                        Saat ini belum ada promo yang tersedia. Cek kembali nanti untuk penawaran terbaru.
                    </p>
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