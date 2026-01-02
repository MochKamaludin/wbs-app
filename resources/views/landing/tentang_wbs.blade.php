<section id="tentang_wbs" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2 text-center">
            {{ $definisi?->n_wbls_about ?? 'Whistleblowing System' }}
        </h4>

        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        {{-- Deskripsi --}}
        <div class="text-black leading-relaxed mb-12 text-justify prose max-w-none">
            {!! $definisi?->e_wbls_about !!}
        </div>


        {{-- 3 Kartu --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

            @forelse ($tujuanWbs as $item)
                <div
                    class="group p-8 border rounded-xl shadow-md bg-white
                        hover:shadow-lg hover:-translate-y-1
                        transition-all duration-300">

                    {{-- <img
                        src="{{ asset('storage/images/tujuan/tujuan_' . $item->c_wbls_purposeord . '.png') }}"
                        onerror="this.src='{{ asset('images/tujuan/default.png') }}'"
                        class="h-24 mx-auto mb-4"
                    > --}}

                    {{-- Judul --}}
                    <h3 class="text-xl font-bold mb-3 text-center">
                        {{ strtoupper($item->n_wbls_purpose) }}
                    </h3>

                    {{-- Deskripsi --}}
                    <div class="text-gray-600 text-sm leading-relaxed text-justify prose max-w-none">
                        {!! $item->e_wbls_purpose !!}
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    Tujuan WBS belum tersedia.
                </div>
            @endforelse

        </div>

    </div>
</section>



{{-- ======================= Siapa saja yang dapat menjadi pelapor dalam WBS ======================= --}}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
<section id="pelapor" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">

        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Siapa saja yang dapat menjadi pelapor dalam WBS?</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        {{-- Grid 4 kolom seperti contoh --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            {{-- Karyawan --}}                                                  
            <div class="bg-blue-600 text-white p-10 rounded-xl shadow-md hover:shadow-xl transition">
                <img src="{{ asset('images/karyawan.png') }}" 
                     class="h-20 mx-auto mb-6 object-contain" alt="">
                <h3 class="text-lg font-semibold">Karyawan (Internal)</h3>
            </div>

            {{-- Pemasok --}}
            <div class="bg-blue-600 text-white p-10 rounded-xl shadow-md hover:shadow-xl transition">
                <img src="{{ asset('images/pemasok.png') }}" 
                     class="h-20 mx-auto mb-6 object-contain" alt="">
                <h3 class="text-lg font-semibold">Pemasok / Supplier</h3>
            </div>

            {{-- Pelanggan --}}
            <div class="bg-blue-600 text-white p-10 rounded-xl shadow-md hover:shadow-xl transition">
                <img src="{{ asset('images/pelanggan.png') }}" 
                     class="h-20 mx-auto mb-6 object-contain" alt="">
                <h3 class="text-lg font-semibold">Pelanggan / Customer</h3>
            </div>

            {{-- Masyarakat --}}
            <div class="bg-blue-600 text-white p-10 rounded-xl shadow-md hover:shadow-xl transition">
                <img src="{{ asset('images/masyarakat.png') }}" 
                     class="h-20 mx-auto mb-6 object-contain" alt="">
                <h3 class="text-lg font-semibold">Masyarakat</h3>
            </div>
        </div>
    </div>
</section>

{{-- ======================= Kapan WBS Dapat Digunakan? ======================= --}}
<section id="kapan_wbs" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Kapan WBS Dapat Digunakan?</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
        <p class="text-gray-700 leading-relaxed mb-8 text-justify">
            Pelaporan Pelanggaran dengan menggunakan WBS digunakan apabila pengaduan atau penyimpangan melalui jalur formal 
            (melalui atasan langsung atau fungsi terkait yaitu Divisi SDM dan SPI) dianggap tidak efektif atau ada keraguan 
            (kerahasiaan dan tindak lanjutnya), maka Pelapor dapat menyampaikan pengaduan melalui Sistem Pelaporan Pelanggaran 
            (Whistleblowing System).
        </p>
    </div>
</section>

{{-- ======================= Jenis Pelanggaran ======================= --}}
<section id="jenis_pelanggaran" class="relative py-32 reveal">
    <!-- Background image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/n219.jpg') }}" 
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

        {{-- Grid Dinamis --}}
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
                    <div class="p-5 text-gray-700 text-sm leading-relaxed text-justify prose max-w-none">
                        {!! $item->e_wbls_req !!}
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>

<section id="perlindungan" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-12">
            <h4 class="text-3xl font-bold mb-2">
                Perlindungan Terhadap Pelapor
            </h4>
            <div class="w-20 h-1 bg-blue-600 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach ($perlindungan as $item)
        <div class="
            bg-white rounded-xl shadow-md p-6
            {{ $perlindungan->count() === 1 ? 'md:col-span-2' : '' }}
        ">
            <h3 class="text-lg font-bold text-center mb-4">
                {{ $item->n_wbls_protect }}
            </h3>

            <div class="
                prose prose-sm max-w-none
                prose-ol:list-decimal
                prose-ol:pl-6
                prose-li:my-1
            ">
                {!! $item->e_wbls_protect !!}
            </div>
        </div>
    @endforeach
</div>

    </div>
</section>


