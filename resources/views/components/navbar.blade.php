<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mt-6 rounded-full backdrop-blur-md bg-white/5 border border-white/10">

            <div class="flex justify-between items-center px-8 py-4">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-purple-500 to-blue-500 flex items-center justify-center">

                        🎮

                    </div>

                    <span class="font-bold text-lg">
                        BOXPLAY.ID
                    </span>

                </div>

                <ul class="flex items-center gap-10">

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
                    
                    <li><a href="#" class="hover:text-purple-400">Event / Promo</a></li>
                    <li><a href="#" class="hover:text-purple-400">Games</a></li>

                </ul>

                <button class="px-7 py-2.5 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 font-medium">
                    Book Now
                </button>

            </div>

        </div>

    </div>
</nav>