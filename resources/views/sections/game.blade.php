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
            <form method="GET" action="{{ route('game') }}">
                <div class="bg-[#1B2944] rounded-2xl p-4">
                    <div class="flex flex-col md:flex-row gap-4">

                        <!-- Search -->
                        <div class="relative flex-1">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari game..."
                                onkeyup="clearTimeout(window.gameSearch);
                                        window.gameSearch = setTimeout(() => {
                                            this.form.submit();
                                        }, 500);"
                                class="w-full bg-[#111C32] border border-white/10 rounded-xl pl-5 pr-12 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <!-- Filter Kategori -->
                        <button type="button" id="filterBtn" class="relative w-14 h-14 flex items-center justify-center bg-[#111C32] border border-white/10 rounded-xl text-white hover:border-blue-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 8v5l-4 2v-7L3 6V4z"/>
                            </svg>

                            @if(request('kategori'))
                                <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                            @endif

                        </button>
                    </div>
                </div>

                <div class="relative">
                    <div id="filterPanel" class="hidden absolute top-4 right-0 z-50 w-72 bg-[#111C32] border border-white/10 rounded-2xl p-5 shadow-2xl">
                        <p class="text-white font-medium mb-3">
                            Kategori
                        </p>
                        <div class="grid gap-3">
                            <label class="flex items-center gap-3 text-white cursor-pointer">
                            <input type="radio" name="kategori" value="" onchange="this.form.submit()">
                            Semua
                        </label>
                        @foreach($kategoriList as $kategori)
                            <label class="flex items-center gap-3 text-white cursor-pointer">
                                <input
                                    type="radio"
                                    name="kategori"
                                    value="{{ $kategori }}"
                                    {{ request('kategori') == $kategori ? 'checked' : '' }}
                                    onchange="this.form.submit()">
                                {{ $kategori }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>

        <!-- Games Grid -->
        <div class="grid md:grid-cols-3 gap-8 mt-12">
            @forelse ($games as $game)
                <div class="group">
                    <div class="overflow-hidden rounded-3xl">
                        <img src="{{ $game->cover_image ? asset($game->cover_image) : asset('images/no-image.png') }}"
                            alt="{{ $game->judul_game }}" class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="mt-3">
                        <span class="text-xs px-2 py-1 rounded-full bg-blue-500 text-white hover:scale-105 transition">
                            {{ $game->kategori }}
                        </span>
                        <h3 class="text-white font-semibold mt-2">
                            {{ $game->judul_game }}
                        </h3>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16">
                    <p class="text-gray-400">
                        Belum ada game tersedia.
                    </p>
                </div>
            @endforelse
        </div>

    </div>

    <script>
        const filterBtn = document.getElementById('filterBtn');
        const filterPanel = document.getElementById('filterPanel');

        filterBtn.addEventListener('click', () => {
            filterPanel.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!filterBtn.contains(e.target) && !filterPanel.contains(e.target)) {
                filterPanel.classList.add('hidden');
            }
        });
    </script>

</section>