<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-3xl mx-auto px-5">

        <div class="mt-5 rounded-full backdrop-blur-md bg-white/5 border border-white/10">

            <div class="flex justify-between items-center px-8 py-2">

                <div class="flex items-center gap-3">

                    <div class="flex items-center pl-2">
                        <img
                            src="{{ asset('images/logo-boxplay.png') }}"
                            alt="BOXPLAY.ID"
                            class="h-8 w-auto object-contain">
                    </div>

                </div>

                <ul class="flex items-center gap-8">

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

                <a
                    href="{{ route('booking.info') }}"
                    class="px-7 py-2.5 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 font-medium text-white
{{ request()->routeIs('booking.*') ? 'ring-2 ring-purple-400 shadow-[0_0_15px_rgba(139,92,246,0.5)]' : 'hover:scale-105 transition' }}">
                    Book Now
                </a>

            </div>

        </div>

    </div>
</nav>