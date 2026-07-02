<footer class="bg-[#071224] py-8">
<div class="max-w-6xl mx-auto px-6">

    <div class="grid md:grid-cols-4 gap-10">

        <div>

            <div class="flex items-center">

                <img
                    src="{{ asset('images/logo-boxplay.png') }}"
                    alt="BOXPLAY.ID"
                    class="h-11 w-auto object-contain">

            </div>

            <p class="text-gray-400 mt-4 text-sm leading-relaxed">
                Platform rental PlayStation self-service terbaik.
                Nikmati pengalaman bermain PlayStation dengan mudah,
                cepat, dan nyaman di cafe favoritmu.
            </p>

            <div class="flex gap-4 mt-5 text-gray-400 text-lg">

                <a href="https://www.instagram.com/boxplay.id_/"
                target="_blank"
                class="hover:text-pink-500 hover:scale-125 transition duration-300">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="https://wa.me/6285262939746?text=Halo%20BoxPlay,%20saya%20ingin%20bertanya%20tentang%20booking%20Playbox"
                target="_blank"
                class="hover:text-green-500 hover:scale-125 transition duration-300">

                    <i class="bi bi-whatsapp"></i>

                </a>

            </div>

        </div>

        <div>

            <h4 class="font-semibold mb-4">
                Quick Links
            </h4>

            <ul class="space-y-3 text-gray-400 text-sm">

                <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>

                <li><a href="{{ route('branch') }}" class="hover:text-white">Branch Locations</a></li>

                <li><a href="{{ route('event-promo') }}" class="hover:text-white">Events & Promos</a></li>

            </ul>

        </div>

        <div>

            <h4 class="font-semibold mb-4">
                Support
            </h4>

            <ul class="space-y-3 text-gray-400 text-sm">

                <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>

                <li><a href="{{ route('booking.info') }}" class="hover:text-white">Cara Booking</a></li>

            </ul>

        </div>

        <div>

            <h4 class="font-semibold mb-4">
                Contact
            </h4>

            <div class="space-y-3 text-gray-400 text-sm">

                <div class="flex items-center gap-3">

                    <i class="bi bi-geo-alt-fill text-blue-400"></i>

                    <span>Padang</span>

                </div>

                <div class="flex items-center gap-3">

                    <i class="bi bi-telephone-fill text-blue-400"></i>

                    <span>+62 852-6293-9746</span>

                </div>

                <div class="flex items-center gap-3">

                    <i class="bi bi-envelope-fill text-blue-400"></i>

                    <span>@boxplayid@gmail.com</span>

                </div>

            </div>

        </div>

    </div>

    <div class="border-t border-white/10 mt-8 pt-5 text-center text-gray-500 text-sm">

        © 2026 BOXPLAY.ID. All rights reserved.

    </div>

</div>
</footer>
