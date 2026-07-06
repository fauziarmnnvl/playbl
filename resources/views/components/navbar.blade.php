<nav class="absolute top-0 left-0 w-full z-50" x-data="{ open: false }">
    <div class="max-w-3xl mx-auto px-4 sm:px-5">

        <div class="mt-5 rounded-full backdrop-blur-md bg-white/5 border border-white/10">

            <div class="flex justify-between items-center px-4 sm:px-6 lg:px-8 py-2">

                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <div class="flex items-center pl-1 lg:pl-2">
                        <img
                            src="{{ asset('images/logo-boxplay.png') }}"
                            alt="BOXPLAY.ID"
                            class="h-7 sm:h-8 w-auto object-contain">
                    </div>
                </div>

                {{-- Desktop Navigation (lg+) --}}
                <ul class="hidden lg:flex items-center gap-8">

                    <li>
                        <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-[#7C3AED]' : 'text-white hover:text-[#7C3AED]' }} transition duration-300">
                        Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('branch') }}"
                        class="{{ request()->routeIs('branch') ? 'text-[#7C3AED]' : 'text-white hover:text-[#7C3AED]' }} transition duration-300">
                        Branch</a>
                    </li>

                    <li>
                        <a href="{{ route('event-promo') }}"
                        class="{{ request()->routeIs('event-promo') ? 'text-[#7C3AED]' : 'text-white hover:text-[#7C3AED]' }} transition duration-300">
                        Event & Promo</a></li>

                    <li>
                        <a href="{{ route('game') }}"
                        class="{{ request()->routeIs('game') ? 'text-[#7C3AED]' : 'text-white hover:text-[#7C3AED]' }} transition duration-300">
                        Games</a></li>

                </ul>

                {{-- Desktop Book Now (lg+) --}}
                <a
                    href="{{ route('booking.info') }}"
                    class="hidden lg:inline-block px-7 py-2.5 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 font-medium text-white {{ request()->routeIs('booking.*') ? 'ring-2 ring-purple-400 shadow-[0_0_15px_rgba(139,92,246,0.5)]' : 'hover:scale-105 transition' }}">
                    Book Now
                </a>

                {{-- Mobile Hamburger (below lg) --}}
                <button
                    type="button"
                    class="lg:hidden flex items-center justify-center w-11 h-11 rounded-lg text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-purple-400/50 transition"
                    @click="open = !open"
                    :aria-expanded="open.toString()"
                    aria-label="Buka menu navigasi">

                    {{-- Hamburger Icon --}}
                    <svg x-show="!open" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>

                    {{-- Close Icon --}}
                    <svg x-show="open" x-cloak class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>

                </button>

            </div>

        </div>

        {{-- Mobile Menu (below lg) --}}
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.outside="open = false"
            class="lg:hidden mt-2 rounded-2xl backdrop-blur-md bg-[#0a1a3a]/95 border border-white/10 shadow-xl overflow-hidden">

            <div class="px-4 py-4 space-y-1">

                <a href="{{ route('home') }}" @click="open = false"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('home') ? 'text-[#7C3AED] bg-purple-500/10' : 'text-white hover:bg-white/5 hover:text-[#7C3AED]' }}">
                    Home
                </a>

                <a href="{{ route('branch') }}" @click="open = false"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('branch') ? 'text-[#7C3AED] bg-purple-500/10' : 'text-white hover:bg-white/5 hover:text-[#7C3AED]' }}">
                    Branch
                </a>

                <a href="{{ route('event-promo') }}" @click="open = false"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('event-promo') ? 'text-[#7C3AED] bg-purple-500/10' : 'text-white hover:bg-white/5 hover:text-[#7C3AED]' }}">
                    Event & Promo
                </a>

                <a href="{{ route('game') }}" @click="open = false"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('game') ? 'text-[#7C3AED] bg-purple-500/10' : 'text-white hover:bg-white/5 hover:text-[#7C3AED]' }}">
                    Games
                </a>

            </div>

            <div class="px-4 pb-4">
                <a href="{{ route('booking.info') }}" @click="open = false"
                    class="block w-full text-center px-6 py-3 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 font-medium text-white hover:scale-[1.02] transition shadow-lg">
                    Book Now
                </a>
            </div>

        </div>

    </div>

</nav>
