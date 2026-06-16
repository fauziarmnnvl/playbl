<section class="relative h-screen overflow-hidden">

    <div class="hero-slider absolute inset-0">

        <img src="/images/hero/hero1.png" class="hero-slide active">
        <img src="/images/hero/hero2.jpeg" class="hero-slide">
        <img src="/images/hero/hero3.png" class="hero-slide">
        <img src="/images/hero/hero4.jpeg" class="hero-slide">
        <img src="/images/hero/hero5.jpeg" class="hero-slide">

    </div>

    <div
    class="absolute inset-0"
    style="
        background:
        linear-gradient(
            90deg,
            rgba(8,19,38,.65) 0%,
            rgba(8,19,38,.45) 50%,
            rgba(8,19,38,.65) 100%
        );
    ">
    </div>

    <div class="absolute left-[-250px] top-20 w-[800px] h-[800px] bg-vyan-500/10 blur-[200px] rounded-full"></div>

    <div class="absolute right-[-250px] top-10 w-[700px] h-[700px] bg-blue-500/8 blur-[200px] rounded-full"></div>

    <div class="relative z-10 flex items-center justify-center h-full">

        <div class="text-center max-w-3xl">

            <h1 class="text-7xl md:text-8xl font-extrabold leading-none">

                Play While

                <br>

                You

                <span
                    class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                    Stay
                </span>

            </h1>

            <p class="mt-8 text-gray-300 text-lg max-w-xl mx-auto">
                Nongkrong lebih seru dengan PlayStation yang siap dimainkan kapan saja.
            </p>

            <a
                href="{{ route('booking.info') }}"
                class="inline-block mt-10 px-8 py-4 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 hover:scale-105 duration-300 text-white font-semibold">

                Mulai Booking →

            </a>

        </div>

    </div>

</section>