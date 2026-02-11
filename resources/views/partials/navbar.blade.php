<style>
    .nav-link.active {
        color: #2563eb;
        font-weight: 700;
        border-bottom: 2px solid #2563eb;
        padding-bottom: 2px;
    }
</style>

<nav class="w-full bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

        <!-- LOGO -->
        <div class="flex items-center space-x-3">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/Logo-ptdi.png') }}" class="h-10" alt="Logo">
            </a>
        </div>

        <!-- DESKTOP MENU -->
        <ul class="hidden lg:flex space-x-6 font-bold text-[15px] text-black">
            <li><a href="{{ url('/') }}#home" class="nav-link hover:text-blue-600">HOME</a></li>
            <li><a href="{{ url('/') }}#tentang_wbs" class="nav-link hover:text-blue-600">TENTANG WBS</a></li>
            <li><a href="{{ url('/') }}#cara_pengaduan" class="nav-link hover:text-blue-600">CARA PENGADUAN</a></li>
            <li><a href="#" id="btnNavbarPengaduan" class="nav-link hover:text-blue-600">TULIS PENGADUAN</a></li>
            <li><a href="{{ route('cek-status.index') }}" class="nav-link hover:text-blue-600">CEK STATUS</a></li>
            <li><a href="{{ url('/') }}#dasar_wbs" class="nav-link hover:text-blue-600">DASAR WBS</a></li>
            <li><a href="{{ url('/') }}#dashboard" class="nav-link hover:text-blue-600">DASHBOARD</a></li>
            <li><a href="{{ url('/') }}#faq" class="nav-link hover:text-blue-600">FAQ</a></li>
        </ul>

        <button id="menu-btn" class="lg:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu"
        class="hidden lg:hidden bg-white px-6 pb-4 shadow text-base font-semibold">

        <a href="{{ url('/') }}#home" class="block py-2 nav-link">HOME</a>
        <a href="{{ url('/') }}#tentang_wbs" class="block py-2 nav-link">TENTANG WBS</a>
        <a href="{{ url('/') 1}}#cara_pengaduan" class="block py-2 nav-link">CARA PENGADUAN</a>
        <button onclick="openModal()" class="block py-2 text-left w-full nav-link">
            TULIS PENGADUAN
        </button>
        <a href="{{ route('cek-status.index') }}" class="block py-2 nav-link">CEK STATUS</a>
        <a href="{{ url('/') }}#dasar_wbs" class="block py-2 nav-link">DASAR WBS</a>
        <a href="{{ url('/') }}#dashboard" class="block py-2 nav-link">DASHBOARD</a>
        <a href="{{ url('/') }}#faq" class="block py-2 nav-link">FAQ</a>
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.forEach(l => l.classList.remove('active'));
            link.classList.add('active');

            mobileMenu.classList.add('hidden');
        });
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            mobileMenu.classList.add('hidden');
        }
    });

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