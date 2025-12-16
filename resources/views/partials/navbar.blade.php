<style>
    .nav-link.active {
        color: #2563eb; /* blue-600 */
        font-weight: 700;
        border-bottom: 2px solid #2563eb;
        padding-bottom: 2px;
    }
</style>

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

    <script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Toggle mobile menu
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Active menu + auto close mobile
    navLinks.forEach(link => {
        link.addEventListener('click', () => {

            // hapus active dari semua
            navLinks.forEach(l => l.classList.remove('active'));

            // set active ke yang diklik
            link.classList.add('active');

            // tutup mobile menu
            if (window.innerWidth < 768) {
                mobileMenu.classList.add('hidden');
            }
        });
    });

    // Auto close mobile menu saat resize ke desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Active menu berdasarkan hash URL (refresh / load)
    function setActiveByHash() {
        const hash = window.location.hash;
        if (!hash) return;

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href')?.includes(hash)) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('load', setActiveByHash);
    window.addEventListener('hashchange', setActiveByHash);
    </script>