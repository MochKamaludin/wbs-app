<section id="tentang_wbs" class="py-24 bg-white reveal">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-16 items-center">

            <div>
                <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-gray-900">
                    {{ $definisi?->n_wbls_about }}
                </h2>

                <div class="mt-6 text-gray-900 text-base leading-relaxed text-justify">
                    {!! $definisi?->e_wbls_about !!}
                </div>

                <dl class="mt-14 grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-12">
                    @foreach ($tujuanWbs as $item)
                        <div class="pt-4 border-t border-gray-200">
                            <dt class="text-sm font-semibold text-gray-900 tracking-wide">
                                {{ strtoupper($item->n_wbls_purpose) }}
                            </dt>
                            <dd class="mt-3 text-sm text-gray-600 leading-relaxed text-justify">
                                {!! $item->e_wbls_purpose !!}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="flex justify-center">
                <div class="grid grid-cols-2 grid-rows-2 gap-6 max-w-md w-full">

                    <img
                        src="{{ asset('images/acuan.png') }}"
                        alt="Acuan"
                        class="w-full aspect-square rounded-xl object-cover"
                    />

                    <img
                        src="{{ asset('images/upaya.png') }}"
                        alt="Upaya"
                        class="w-full aspect-square rounded-xl object-cover"
                    />

                    <img
                        src="{{ asset('images/risiko.png') }}"
                        alt="Risiko"
                        class="w-full aspect-2/1 col-span-2 rounded-xl object-cover"
                    />

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ======================= Siapa saja yang dapat menjadi pelapor dalam WBS ======================= --}}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
<section id="pelapor" class="bg-white">

    <!-- Judul -->
    <div class="py-16 text-center px-6">
        <h4 class="text-3xl font-bold mb-3">
            Siapa saja yang dapat menjadi pelapor dalam WBS?
        </h4>
        <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 w-full">
        <!-- Karyawan -->
        <div
            class="bg-blue-700 text-white flex flex-col items-center justify-center py-24 border-b md:border-b-0 md:border-r border-white/40">
            <img src="{{ asset('images/karyawan.png') }}" class="h-16 mb-5" alt="">
            <h3 class="text-lg font-semibold text-center">
                Karyawan (Internal)
            </h3>
        </div>

        <!-- Pemasok -->
        <div
            class="bg-blue-600 text-white flex flex-col items-center justify-center py-24 border-b md:border-b-0 md:border-r border-white/40">
            <img src="{{ asset('images/pemasok.png') }}" class="h-16 mb-5" alt="">
            <h3 class="text-lg font-semibold text-center">
                Pemasok / Supplier
            </h3>
        </div>

        <!-- Pelanggan -->
        <div
            class="bg-blue-500 text-white flex flex-col items-center justify-center py-24 border-b md:border-b-0 md:border-r border-white/40">
            <img src="{{ asset('images/pelanggan.png') }}" class="h-16 mb-5" alt="">
            <h3 class="text-lg font-semibold text-center">
                Pelanggan / Customer
            </h3>
        </div>

        <!-- Masyarakat -->
        <div
            class="bg-blue-400 text-white flex flex-col items-center justify-center py-24">
            <img src="{{ asset('images/masyarakat.png') }}" class="h-16 mb-5" alt="">
            <h3 class="text-lg font-semibold text-center">
                Masyarakat
            </h3>
        </div>

    </div>
</section>


{{-- ======================= Kapan WBS Dapat Digunakan? ======================= --}}
<section id="kapan_wbs" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">
            {{ $kapanDigunakan?->n_wbls_about }}
        </h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
        <div class="text-black leading-relaxed mb-12 text-justify prose max-w-none">
            {!! $kapanDigunakan?->e_wbls_about !!}
        </div>
    </div>
</section>

{{-- ======================= Jenis Pelanggaran ======================= --}}
<section id="jenis_pelanggaran" class="relative py-32 reveal">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/background/bg2.jpeg') }}" 
             class="w-full h-full object-cover opacity-100" 
             alt="Background jenis pelanggaran">
    </div>

    <div class="relative max-w-6xl mx-auto text-center px-6">
        <h2 class="text-3xl font-bold text-white mb-2">Jenis Pelanggaran</h2>
        <div class="w-24 h-1 bg-blue-600 mx-auto mb-10"></div>

        <!-- Grid Card -->
        <div class="max-w-5xl mx-auto 
                    grid grid-cols-2 md:grid-cols-4 
                    gap-6 place-items-stretch">

            @php
                $items = [
                    ['icon' => 'fa-hand-holding-dollar', 'label' => 'KORUPSI'],
                    ['icon' => 'fa-money-bill-wave', 'label' => 'SUAP'],
                    ['icon' => 'fa-gift', 'label' => 'GRATIFIKASI'],
                    ['icon' => 'fa-people-carry', 'label' => 'BENTURAN KEPENTINGAN'],
                    ['icon' => 'fa-mask', 'label' => 'PENCURIAN'],
                    ['icon' => 'fa-theater-masks', 'label' => 'KECURANGAN (FRAUD)'],
                    ['icon' => 'fa-gavel', 'label' => 'PELANGGARAN HUKUM / PERATURAN / KEBIJAKAN / PROSEDUR PERUSAHAAN'],
                    ['icon' => 'fa-ellipsis-v', 'label' => 'PERIHAL LAINNYA'],
                ];
            @endphp

            @foreach ($items as $item)
            <div class="group flex flex-col items-center justify-between
                bg-transparent border border-white/40
                rounded-xl p-6 shadow-lg transition-all duration-300
                hover:bg-white hover:text-blue-700 
                hover:border-white hover:shadow-2xl
                h-44">

                <!-- Icon -->
                <div class="flex items-center justify-center w-16 h-16 
                    rounded-full bg-blue-600 group-hover:bg-blue-600 mb-4">
                    <i class="fas {{ $item['icon'] }} text-white fa-2x"></i>
                </div>

                <!-- Label -->
                <span class="text-sm font-semibold text-white group-hover:text-blue-700 text-center leading-tight">
                    {{ $item['label'] }}
                </span>
            </div>
            @endforeach

        </div>
    </div>
</section>



<section id="laporkan" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">

        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">
            Syarat Melaporkan Dugaan Pelanggaran & Bukti Pendukung
        </h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

            @foreach ($syaratMelapor as $item)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">

                    <div class="flex justify-center mt-6">
                        <img
                            src="{{ asset(
                                $loop->iteration == 1
                                    ? 'images/identitas.png'
                                    : 'images/bukti_pendukung.png'
                            ) }}"
                            class="w-14"
                            alt="{{ $item->n_wbls_req }}"
                        >
                    </div>

                    {{-- Header --}}
                    <div class="bg-blue-600 text-white py-4 text-center mt-4">
                        <h3 class="text-lg font-bold">
                            {{ $item->n_wbls_req }}
                        </h3>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="p-5 text-gray-700 text-sm leading-relaxed text-justify editor-content prose prose-sm max-w-none">
                        {!! $item->e_wbls_req !!}
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>

<section id="perlindungan" class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Judul -->
        <div class="text-center mb-14">
            <h4 class="text-3xl font-bold mb-3 text-gray-900">
                Perlindungan Terhadap Pelapor
            </h4>
            <div class="w-24 h-1 bg-blue-600 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @foreach ($perlindungan as $item)
                <div
                    class="
                        bg-white rounded-2xl shadow-sm hover:shadow-md transition
                        p-8
                        {{ $perlindungan->count() === 1 ? 'md:col-span-2 max-w-4xl mx-auto' : '' }}
                    "
                >
                
                    <div
                        class="
                            editor-content prose prose-sm max-w-none
                            md:columns-2 md:gap-8
                            text-justify
                        "
                    >
                    <h3 class="text-xl font-semibold text-justify text-black mb-6">
                        
                        {{ $item->n_wbls_protect }}
                    </h3>
                        {!! $item->e_wbls_protect !!}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
