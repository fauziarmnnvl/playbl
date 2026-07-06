<section class="relative overflow-hidden py-16 md:py-24">

    <div
    class="absolute inset-0"
    style="
        background:
        linear-gradient(
            115deg,
            #020617 0%,
            #07142F 25%,
            #0B1E46 55%,
            #133A86 100%
        );
    ">
    </div>

    <div
    class="absolute inset-0"
    style="
        background:
        radial-gradient(
            circle at center,
            rgba(0,0,0,.05) 0%,
            rgba(0,0,0,.35) 70%,
            rgba(0,0,0,.55) 100%
        );
    ">
    </div>

    <div
class="absolute
left-[-150px]
md:left-[-250px]
top-1/2
-translate-y-1/2
w-[400px]
h-[400px]
md:w-[760px]
md:h-[760px]
rounded-full"
style="
background:
radial-gradient(
circle,
rgba(124,58,237,.34) 0%,
rgba(124,58,237,.18) 35%,
rgba(124,58,237,.08) 65%,
transparent 100%
);
filter:blur(100px);
/* md:filter:blur(185px) not supported directly in style, so keeping an average blur or just relying on standard filter. Let's keep 185px as it was, it scales okay. Actually Tailwind blur is better but it uses inline style here. */
filter:blur(185px);
">
</div>

<div
class="absolute
left-[50px]
md:left-[180px]
top-[52%]
-translate-y-1/2
w-[150px]
h-[150px]
md:w-[260px]
md:h-[260px]
rounded-full"
style="
background:
radial-gradient(
circle,
rgba(168,85,247,.16) 0%,
rgba(168,85,247,.08) 55%,
transparent 100%
);
filter:blur(90px);
">
</div>

    <div
class="absolute
left-[-200px]
md:left-[-340px]
top-[45%]
-translate-y-1/2
w-[500px]
h-[500px]
md:w-[980px]
md:h-[980px]
rounded-full"
style="
background:
radial-gradient(
circle,
rgba(109,40,217,.18) 0%,
rgba(109,40,217,.10) 38%,
rgba(109,40,217,.05) 65%,
transparent 100%
);
filter:blur(240px);
">
</div>

    <div
    class="absolute
    right-[-100px]
    md:right-[-180px]
    top-1/2
    -translate-y-1/2
    w-[300px]
    h-[300px]
    md:w-[650px]
    md:h-[650px]
    rounded-full"
    style="
    background:
    radial-gradient(
    circle,
    rgba(59,130,246,.45) 0%,
    rgba(59,130,246,.18) 50%,
    transparent 100%
    );
    filter:blur(150px);
    ">
    </div>

    <div
    class="absolute inset-0"
    style="
    box-shadow:
    inset 0 0 180px rgba(0,0,0,.45);
    ">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-10">

        <div class="grid md:grid-cols-2 gap-12 md:gap-20 items-center text-center md:text-left">

            <div>

                <h2
                    class="
                    text-4xl
                    sm:text-[48px]
                    md:text-[64px]
                    font-extrabold
                    leading-[0.9]
                    text-white">

                    Stay. Play.
                    <br>
                    Repeat.

                </h2>

                <p
                    class="
                    mt-8
                    text-gray-300
                    text-base
                    md:text-lg
                    leading-relaxed
                    max-w-md
                    mx-auto
                    md:mx-0">

                    BOXPLAY.ID menghadirkan cara baru menikmati PlayStation langsung dari cafe favoritmu.

                </p>

                <a
                    href="{{ route('booking.info') }}"
                    class="inline-block mt-10 px-8 py-4 rounded-full bg-gradient-to-r from-purple-500 to-blue-500 hover:scale-105 duration-300 text-white font-semibold">

                    Mulai Booking →

                </a>

            </div>

            <div class="relative flex justify-center">

                <!-- Glow belakang gambar -->
                <div
                class="absolute
                w-[300px]
                h-[300px]
                md:w-[500px]
                md:h-[500px]
                rounded-full
                left-1/2
                top-1/2
                -translate-x-1/2
                -translate-y-1/2
                -z-10"
                style="
                background:
                radial-gradient(
                circle,
                rgba(37,99,235,.35) 0%,
                rgba(168,85,247,.25) 45%,
                transparent 100%
                );
                filter:blur(110px);
                ">
                </div>

                <!-- Gambar -->
                <div
                    class="
                    overflow-hidden
                    rounded-[24px]
                    shadow-[0_25px_80px_rgba(0,0,0,.35)]
                    w-full
                    max-w-[460px]
                    aspect-[46/41]
                    md:w-[460px]
                    md:h-[410px]">

                    <img
                        src="{{ asset('images/cta.png') }}"
                        alt="CTA BOXPLAY"
                        class="w-full h-full object-cover">

                </div>

            </div>

        </div>

    </div>

</section>