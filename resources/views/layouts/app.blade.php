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
        /* ===== SCROLL REVEAL ===== */
        html { scroll-behavior: smooth; }

        #modalPersetujuan {
            background: rgba(0, 0, 0, 0.25);
        }

        /* ===== SCROLL REVEAL ===== */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

    </style>
</head>

<body class="bg-gray-100 m-0 p-0">
    
    {{-- CONTACT BAR --}}
    @include('partials.contact_bar')

    {{-- NAVBAR --}}
    @include('partials.navbar')

    <!-- MODAL PERSETUJUAN -->
    @include('partials.modal_persetujuan')

    <div class="pt-0 mt-0">
        @yield('content')

        {{-- BUTTON UP --}}
        @include('partials.button_up')
    </div>

    <!-- FOOTER -->
    @include('partials.footer')

    <script>
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.reveal');
            const windowHeight = window.innerHeight;
            const revealPoint = 120;

            reveals.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;

                if (elementTop < windowHeight - revealPoint) {
                    el.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', revealOnScroll);
        window.addEventListener('load', revealOnScroll);
    </script>

</body>
</html>