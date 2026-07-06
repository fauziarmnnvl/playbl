<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOXPLAY.ID</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>
    <body class="bg-[#081326] text-white font-[Poppins] overflow-x-clip">

    <x-navbar />

    <!-- Scroll Indicator — hidden on mobile/tablet -->
    @if(request()->routeIs('home'))
    <div id="scroll-indicator"
        class="fixed right-8 top-1/2 -translate-y-1/2 z-50 hidden lg:flex flex-col gap-4">

        <span class="dot active" data-target="0"></span>
        <span class="dot" data-target="1"></span>
        <span class="dot" data-target="2"></span>
        <span class="dot" data-target="3"></span>
        <span class="dot" data-target="4"></span>

    </div>
    @endif

    <main>
        @yield('content')
    </main>

    <x-footer />

</body>
</html>