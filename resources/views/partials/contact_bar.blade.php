{{-- TOP CONTACT BAR --}}
<div class="w-full bg-white text-gray-500 text-sm py-3 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 flex flex-wrap items-center justify-between gap-4 font-medium">

        <!-- LEFT INFO -->
        <div class="flex flex-wrap items-center gap-4">

            <div class="flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-blue-600"></i>
                <span class="hidden sm:inline">
                    Gedung Pusat Management Lantai 8
                </span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fas fa-phone text-blue-600"></i>
                <span class="hidden sm:inline">
                    (022) 605-5092
                </span>
            </div>

            <div class="flex items-center gap-2">
                <i class="fas fa-envelope text-blue-600"></i>
                <span class="hidden sm:inline">
                    laporwbs@indonesian-aerospace.com
                </span>
            </div>

        </div>

        <!-- RIGHT AUTH -->
        <div class="flex items-center gap-4 text-blue-600 font-semibold">

            <!-- LOGIN -->
            <a href="{{ url('/admin/login') }}"
               class="flex items-center gap-1 hover:text-blue-800 transition">
                <i class="fas fa-right-to-bracket"></i>
                <span>Login</span>
            </a>

            {{-- <!-- REGISTER -->
            <a href="#"
               class="flex items-center gap-1 hover:text-blue-800 transition">
                <i class="fas fa-user-plus"></i>
                <span>Register</span>
            </a> --}}

        </div>
    </div>
</div>