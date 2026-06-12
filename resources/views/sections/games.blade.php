<section class="relative bg-black py-28 overflow-hidden">

    <div class="max-w-7xl mx-auto px-8">

        <h2 class="text-5xl md:text-6xl font-bold text-center">
            Koleksi

            <span
                class="
                bg-gradient-to-r
                from-[#A855F7]
                via-[#8B5CF6]
                to-[#60A5FA]
                bg-clip-text
                text-transparent
                drop-shadow-[0_0_15px_rgba(139,92,246,0.5)]">
                Game
            </span>
        </h2>

        <p class="text-gray-400 text-center mt-4">
            Pilih game favoritmu
        </p>

    </div>

    <div class="stars"></div>
    <div class="game-glow-left"></div>
    <div class="game-glow-right"></div>

    <div class="swiper gameSwiper mt-16">

        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <img src="{{ asset('images/games/A-WAY-OUT.jpeg') }}">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/games/E-FOOTBALL.jpeg') }}">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/games/FC26.jpeg') }}">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/games/IT-TAKES-TWO.jpeg') }}">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/games/MOTO-GP.jpeg') }}">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/games/NARUTO-CONNEC.jpeg') }}">
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/games/SPIDER-MAN.jpeg') }}">
            </div>
            
        </div>

    </div>

</section>

<script>
window.addEventListener("load", () => {

    new Swiper(".gameSwiper", {

        effect: "coverflow",

        centeredSlides: true,

        slidesPerView: 3,

        spaceBetween: 30,

        loop: true,

        grabCursor: true,

        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

        coverflowEffect: {

            rotate: 0,
            stretch: 0,
            depth: 250,
            modifier: 1,
            scale: 0.85,
            slideShadows: false,

        },

    });

});
</script>