<section class="bg-[#16233B] min-h-screen py-24">

    <div class="max-w-7xl mx-auto px-8">

        <!-- Heading -->
        <div class="text-center mt-24">

            <h2 class="text-5xl md:text-6xl font-bold text-white">
                Semua
                <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">
                    Game
                </span>
            </h2>

            <p class="text-gray-400 mt-5 max-w-3xl mx-auto">
                Jelajahi koleksi game kami. Dari kompetisi sengit hingga petualangan santai,
                temukan game favoritmu untuk dimainkan bareng teman.
            </p>

        </div>

        <!-- Search & Filter -->
        <div class="mt-12">

            <div class="bg-[#1B2944] rounded-2xl p-4">

                <div class="flex flex-col md:flex-row gap-4">

                <!-- Filter Kategori -->
                <div class="flex flex-wrap gap-3">

                    <button class="px-5 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-blue-500 text-white font-medium">
                        Semua
                    </button>

                    <button class="px-5 py-3 rounded-xl bg-[#111C32] border border-white/10 text-white hover:border-blue-500 transition">
                        Aksi & Petualangan
                    </button>

                    <button class="px-5 py-3 rounded-xl bg-[#111C32] border border-white/10 text-white hover:border-blue-500 transition">
                        Olahraga
                    </button>

                </div>

            <!-- Search Box -->
            <div class="relative flex-1">

                <input
                    type="text"
                    placeholder="Cari game..."
                    class="w-full bg-[#111C32] border border-transparent rounded-xl pl-5 pr-14 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 hover:border-blue-500 transition">

                <!-- Search Icon -->
                <button
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

</div>

        <!-- Games Grid -->
        <div class="grid md:grid-cols-3 gap-8 mt-12">

            <!-- Game Card -->
            <div class="group">

                <div class="overflow-hidden rounded-3xl">

                    <img
                        src="{{ asset('images/games/A-WAY-OUT.jpeg') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">

                </div>

                <div class="mt-3">

                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition ">
                        Aksi & Petualangan
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        A Way Out
                    </h3>

                </div>

            </div>

            <!-- Game Card -->
            <div class="group">

                <div class="overflow-hidden rounded-3xl">

                    <img
                        src="{{ asset('images/games/E-FOOTBALL.jpeg') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">

                </div>

                <div class="mt-3">

                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition">
                        Olahraga
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        eFootball Mourinho Edition 2026
                    </h3>

                </div>

            </div>

            <!-- Game Card -->
            <div class="group">

                <div class="overflow-hidden rounded-3xl">

                    <img
                        src="{{ asset('images/games/FC26.jpeg') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">

                </div>

                <div class="mt-3">

                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition">
                        Olahraga
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        FC26
                    </h3>

                </div>

            </div>

            <!-- Baris 2 -->

            <div class="group">
                <div class="overflow-hidden rounded-3xl">
                    <img src="{{ asset('images/games/IT-TAKES-TWO.png') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">
                </div>

                <div class="mt-3">
                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition">
                        Aksi & Petualangan
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        It Takes Two
                    </h3>
                </div>
            </div>

            <div class="group">
                <div class="overflow-hidden rounded-3xl">
                    <img src="{{ asset('images/games/MOTO-GP.png') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">
                </div>

                <div class="mt-3">
                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition">
                        Olahraga
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        Moto GP 24
                    </h3>
                </div>
            </div>

            <div class="group">
                <div class="overflow-hidden rounded-3xl">
                    <img src="{{ asset('images/games/NARUTO-CONNEC.png') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">
                </div>

                <div class="mt-3">
                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition">
                        Aksi & Petualangan
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        Naruto Storm Connections
                    </h3>
                </div>
            </div>

            <div class="group">
                <div class="overflow-hidden rounded-3xl">
                    <img src="{{ asset('images/games/SPIDER-MAN.jpeg') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">
                </div>

                <div class="mt-3">
                    <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white
                    hover:scale-105 transition">
                        Aksi & Petualangan
                    </span>

                    <h3 class="text-white font-semibold mt-2">
                        Spider-Man 2
                    </h3>
                </div>
            </div>

        </div>

    </div>

</section>