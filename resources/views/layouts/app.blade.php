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
        html { scroll-behavior: smooth; }

        /* Background modal transparan (bukan hitam) */
        #modalPersetujuan {
            background: rgba(0, 0, 0, 0.25); /* transparan */
        }
    </style>
</head>

<body class="bg-gray-100 m-0 p-0">

    {{-- TOP CONTACT BAR --}}
    <div class="w-full bg-white text-gray-500 text-sm ml-4 py-3 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 flex justify-start items-center gap-8 font-medium">

            <div class="flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-blue-600 text-base"></i>
                <span class="hidden sm:inline">Gedung Pusat Management Lantai 8</span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fas fa-phone text-blue-600 text-base"></i>
                <span class="hidden sm:inline">(022) 605-5092</span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fas fa-envelope text-blue-600 text-base"></i>
                <span class="hidden sm:inline">laporwbs@indonesian-aerospace.com</span>
            </div>

        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="w-full bg-white shadow z-9998 sticky top-0">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

            <div class="flex items-center ml-4 space-x-3">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/Logo-ptdi.png') }}" class="h-10" alt="Logo">
                </a>
            </div>

            <ul class="md:flex hidden space-x-6 font-bold text-[15px] text-black justify-end">
                <li><a href="{{ url('/') }}#home" class="nav-link hover:text-blue-600">HOME</a></li>
                <li><a href="{{ url('/') }}#tentang_wbs" class="nav-link hover:text-blue-600">TENTANG WBS</a></li>
                <li><a href="{{ url('/') }}#cara_pengaduan" class="nav-link hover:text-blue-600">CARA PENGADUAN</a></li>

                <li><a href="#" id="btnNavbarPengaduan" class="hover:text-blue-600">TULIS PENGADUAN</a></li>

                <li><a href="{{ url('/') }}#dasar_wbs" class="nav-link hover:text-blue-600">DASAR WBS</a></li>
                <li><a href="{{ url('/') }}#dashboard" class="nav-link hover:text-blue-600">DASHBOARD</a></li>
                <li><a href="{{ url('/') }}#faq" class="nav-link hover:text-blue-600">FAQ</a></li>
            </ul>

            <button id="menu-btn" class="md:hidden focus:outline-none mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none"
                    viewBox="0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>

        <div id="mobile-menu" class="hidden bg-white px-6 pb-4 shadow text-base font-semibold">
            <a href="{{ url('/') }}#home" class="block py-2 nav-link">HOME</a>
            <a href="{{ url('/') }}#tentang_wbs" class="block py-2 nav-link">TENTANG WBS</a>
            <a href="{{ url('/') }}#cara_pengaduan" class="block py-2 nav-link">CARA PENGADUAN</a>
            <button onclick="openModal()" class="block py-2 text-left w-full">TULIS PENGADUAN</button>
            <a href="{{ url('/') }}#dasar_wbs" class="block py-2 nav-link">DASAR WBS</a>
            <a href="{{ url('/') }}#dashboard" class="block py-2 nav-link">DASHBOARD</a>
            <a href="{{ url('/') }}#faq" class="block py-2 nav-link">FAQ</a>
        </div>
    </nav>

    <!-- MODAL (CENTER + RESPONSIVE) -->
    <div id="modalPersetujuan"
        class="fixed inset-0 hidden flex items-center justify-center z-9999 p-4">

        <div class="bg-white w-full max-w-[600px] max-h-[85vh] overflow-y-auto rounded-xl shadow-xl p-6">

            <h2 class="text-center text-xl font-bold mb-4">
                Kesepakatan Tertulis dengan Pelapor
            </h2>

            <div class="text-sm space-y-3 leading-6">
                <p><b>1.</b> Pelaporan ini saya buat atas itikad baik...</p>
                <p><b>2.</b> Apabila saya melihat dan mendengar...</p>
                <p><b>3.</b> Saya bersedia memberi bukti...</p>
                <p><b>4.</b> Dalam melakukan proses tindak lanjut...</p>
                <p><b>5.</b> Saya paham apabila laporan saya...</p>
                <p><b>6.</b> Pengaduan ini...</p>
            </div>

            <div class="flex justify-end mt-6 gap-3">
                <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white">
                    Batal
                </button>

                <button
                    onclick="goToPengaduan()"
                    class="px-4 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">
                    Setuju & Lanjutkan
                </button>
            </div>

        </div>
    </div>

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

    {{-- BUTTON UP --}}
    <button id="btnUp"
        class="fixed bottom-6 right-6 bg-blue-600 text-white w-12 h-12 flex items-center justify-center rounded-xl shadow-lg hover:bg-blue-700 transition">
        <i class="fas fa-arrow-up text-2xl font-bold"></i>
    </button>

    <script>
        function openModal() {
            const modal = document.getElementById("modalPersetujuan");
            modal.classList.remove("hidden");
        }

        function closeModal() {
            const modal = document.getElementById("modalPersetujuan");
            modal.classList.add("hidden");
        }

        function goToPengaduan() {
            window.location.href = "{{ route('tulis.pengaduan') }}";
        }

        // Navbar button
        document.getElementById("btnNavbarPengaduan")
            ?.addEventListener("click", (e) => {
                e.preventDefault();
                openModal();
            });

        // Mobile menu
        document.getElementById('menu-btn')
            .addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.toggle('hidden');
            });

        // Scroll button
        window.addEventListener("scroll", () => {
            const btnUp = document.getElementById("btnUp");
            if (window.scrollY > 200) btnUp.classList.remove("hidden");
            else btnUp.classList.add("hidden");
        });

        document.getElementById("btnUp").addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>

</body>
</html>
