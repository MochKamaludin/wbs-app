<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - PT DIRGANTARA INDONESIA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- TOP CONTACT BAR --}}
    <div class="w-full bg-white text-gray-500 text-sm ml-4 py-3 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 flex justify-start items-center gap-8 font-medium">

            <!-- Lokasi -->
            <div class="flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-blue-600 text-base"></i>
                <span class="hidden sm:inline">Gedung Pusat Management Lantai 8</span>
            </div>

            <!-- Telepon -->
            <div class="flex items-center gap-2">
                <i class="fas fa-phone text-blue-600 text-base"></i>
                <span class="hidden sm:inline">(022) 605-5092</span>
            </div>

            <!-- Email -->
            <div class="flex items-center gap-2">
                <i class="fas fa-envelope text-blue-600 text-base"></i>
                <span class="hidden sm:inline">laporwbs@indonesian-aerospace.com</span>
            </div>

        </div>
    </div>


    {{-- NAVBAR --}}
    <nav class="w-full bg-white shadow z-50 sticky top-0">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

            {{-- LOGO LEFT (benar-benar mepet kiri) --}}
            <div class="flex items-center ml-4 space-x-3">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/Logo-ptdi.png') }}" class="h-10" alt="Logo">
                </a>
            </div>

            {{-- MENU DESKTOP RIGHT --}}
            <ul class="md:flex hidden space-x-6 font-bold text-[15px] text-black justify-end">
                <li><a href="#home" class="nav-link hover:text-blue-600">HOME</a></li>
                <li><a href="#tentang_wbs" class="nav-link hover:text-blue-600">TENTANG WBS</a></li>
                <li><a href="#cara_pengaduan" class="nav-link hover:text-blue-600">CARA PENGADUAN</a></li>
                <li><a href="#tulis_pengaduan" class="nav-link hover:text-blue-600">TULIS PENGADUAN</a></li>
                <li><a href="#dasar_wbs" class="nav-link hover:text-blue-600">DASAR WBS</a></li>
                <li><a href="#dashboard" class="nav-link hover:text-blue-600">DASHBOARD</a></li>
                <li><a href="#faq" class="nav-link hover:text-blue-600">FAQ</a></li>
            </ul>

            {{-- MOBILE BUTTON --}}
            <button id="menu-btn" class="md:hidden focus:outline-none mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>

        {{-- MOBILE MENU --}}
        <div id="mobile-menu" class="hidden bg-white px-6 pb-4 shadow text-base font-semibold">
            <a href="#home" class="block py-2 nav-link">HOME</a>
            <a href="#tentang_wbs" class="block py-2 nav-link">TENTANG WBS</a>
            <a href="#cara_pengaduan" class="block py-2 nav-link">CARA PENGADUAN</a>
            <a href="#tulis_pengaduan" class="block py-2 nav-link">TULIS PENGADUAN</a>
            <a href="#dasar_wbs" class="block py-2 nav-link">DASAR WBS</a>
            <a href="#dashboard" class="block py-2 nav-link">DASHBOARD</a>
            <a href="#faq" class="block py-2 nav-link">FAQ</a>
        </div>
    </nav>


    {{-- CONTENT WRAPPER (space abu-abu dihapus) --}}
    <div class="pt-0 mt-0">
        @yield('content')
    </div>

    <footer>
    <div class="w-full bg-blue-600 text-white py-6 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            &copy; {{ date('Y') }} PT Dirgantara Indonesia. All rights reserved.
        </div>
    </div>
    </footer>


    {{-- TOMBOL UP (ikon) --}}
    <button id="btnUp"
        class="fixed bottom-6 right-6 bg-blue-600 text-white w-12 h-12 flex items-center justify-center rounded-xl shadow-lg hover:bg-blue-700 transition">
        
        {{-- Icon panah --}}
        <i class="fas fa-arrow-up text-2xl font-bold"></i>
    </button>
    

    <script>
    // Munculkan tombol ketika scroll turun 200px
    window.addEventListener("scroll", () => {
        const btn = document.getElementById("btnUp");
        if (window.scrollY > 200) btn.classList.remove("hidden");
        else btn.classList.add("hidden");
    });

    // Scroll ke atas saat klik
    document.getElementById("btnUp").addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });

    {{-- SCRIPT ACTIVE MENU + MOBILE MENU --}}
        // Toggle menu mobile
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Active Link on click
        const links = document.querySelectorAll('.nav-link');

        links.forEach(link => {
            link.addEventListener('click', function () {
                links.forEach(l => l.classList.remove('text-blue-600', 'font-bold'));
                this.classList.add('text-blue-600', 'font-bold');

                menu.classList.add('hidden'); // tutup menu mobile
            });
        });
    </script>

</body>
</html>
