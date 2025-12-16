<section id="tentang_wbs" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Whistleblowing System</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        {{-- Deskripsi --}}
        <p class="text-black leading-relaxed mb-12 text-justify">
            Whistleblowing System / Pelaporan Pelanggaran / Pengaduan adalah aplikasi yang disediakan oleh 
            Satuan Pengawasan Intern PT Dirgantara Indonesia bagi Anda yang memiliki informasi dan ingin 
            melaporkan suatu perbuatan berindikasi pelanggaran yang terjadi di lingkungan PT Dirgantara 
            Indonesia. Identitas Anda akan <span class="font-bold bg-gray-200 px-1">DIRAHASIAKAN</span>. 
        </p>

        {{-- 3 Kartu --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

            {{-- Kartu 1 --}}
            <div class="group p-8 border rounded-xl shadow-md bg-white hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <img src="{{ asset('images/acuan.png') }}" class="h-24 w-auto mx-auto mb-4 group-hover:scale-110 transition" alt="">
                <h3 class="text-xl font-bold mb-3">ACUAN</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Menjadi acuan dalam tata cara penanganan pengaduan (Whistleblowing System) di lingkungan PTDI.
                </p>
            </div>

            {{-- Kartu 2 --}}
            <div class="group p-8 border rounded-xl shadow-md bg-white hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <img src="{{ asset('images/upaya.png') }}" class="h-24 w-auto mx-auto mb-4 group-hover:scale-110 transition" alt="">
                <h3 class="text-xl font-bold mb-3">UPAYA</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Mengungkap pelanggaran yang tidak sesuai standar etika dan hukum sebelum meluas.
                </p>
            </div>

            {{-- Kartu 3 --}}
            <div class="group p-8 border rounded-xl shadow-md bg-white hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <img src="{{ asset('images/risiko.png') }}" class="h-24 w-auto mx-auto mb-4 group-hover:scale-110 transition" alt="">
                <h3 class="text-xl font-bold mb-3">MENGURANGI RISIKO</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Mengurangi risiko operasional, keuangan, dan reputasi perusahaan.
                </p>
            </div>

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
        <h4 class="text-3xl font-bold mb-2">Syarat Melaporkan Dugaan Pelanggaran & Bukti Pendukung</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        <!-- Dua Kolom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

        {{-- Identitas Diri --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="flex justify-center mt-6">
                <img src="{{ asset('images/identitas.png') }}" alt="Identitas Diri" class="w-14">
            </div>

            <div class="bg-blue-600 text-white py-4 text-center mt-4">
                <h3 class="text-lg font-bold">Identitas Diri</h3>
            </div>

            <div class="p-5 text-gray-700 text-sm leading-relaxed text-justify">
                <p>Pelapor dapat mencantumkan identitas diri berupa:</p>
                <ul class="list-decimal pl-5 mt-2 space-y-1">
                    <li>Alamat rumah/kantor</li>
                    <li>Alamat e-mail</li>
                    <li>Faksimile</li>
                    <li>Nomor kontak yang dapat dihubungi</li>
                    <li>Dapat juga tanpa mencantumkan data diri (anonim)</li>
                </ul>
            </div>
        </div>

        {{-- Bukti Pendukung --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="flex justify-center mt-6">
                <img src="{{ asset('images/bukti_pendukung.png') }}" alt="Bukti Pendukung" class="w-14">
            </div>

            <div class="bg-blue-600 text-white py-4 text-center mt-4">
                <h3 class="text-lg font-bold">Bukti Pendukung</h3>
            </div>

            <div class="p-5 text-gray-700 text-sm leading-relaxed text-justify">
                <p>Laporan harus disertai bukti pendukung, meliputi:</p>
                <ul class="list-decimal pl-5 mt-2 space-y-1">
                    <li>Pokok masalah yang diadukan</li>
                    <li>Pihak-pihak yang terlibat dan yang dirugikan/diuntungkan</li>
                    <li>Waktu dan lokasi kejadian</li>
                    <li>Kronologis kasus</li>
                    <li>Dokumen pendukung terkait</li>
                </ul>
            </div>
        </div>

    </div>

    </div>
</section>

<section id="perlindungan" class="py-20 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Perlindungan Terhadap Pelapor</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
        
        <!-- Grid 2 Kolom -->
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        ">

            <!-- Kolom Kiri -->
            <div class="leading-relaxed text-[15px] text-black text-justify">

                <h3 class="font-bold text-[16px] mb-3">
                    Perlindungan Pelapor & Pelaksana Investigasi
                </h3>

                <p>
                    Perusahaan dalam kapasitasnya secara maksimal akan memberikan perlindungan 
                    dan informasi kepada pelapor pelanggaran (whistleblower), sebagai berikut:
                </p>

                <ul class="list-disc pl-6 mt-3 space-y-1">
                    <li>Perlindungan kerahasiaan atas identitas Pelapor.</li>
                    <li>
                        Perlindungan dari pemecatan, penurunan jabatan atau grade, penundaan kenaikan grade,
                        tekanan, tindakan fisik sesuai situasi dan kondisi.
                    </li>
                    <li>
                        Perlindungan catatan merugikan dalam file data pribadinya (personal file record).
                    </li>
                    <li>
                        Informasi mengenai proses tindak lanjut yang sedang dilakukan. Informasi ini disampaikan 
                        secara rahasia kepada Pelapor.
                    </li>
                </ul>

                <p class="mt-3">
                    Poin 2 dan 3 juga berlaku bagi pihak yang melaksanakan investigasi maupun pihak-pihak yang 
                    memberikan informasi terkait pengaduan/penyingkapan.
                </p>

            </div>

            <!-- Kolom Kanan -->
            <div class="leading-relaxed text-[15px] text-black text-justify">

                <p>
                    Dalam hal Pelapor merasa perlu, ia juga dapat meminta bantuan pada Lembaga
                    Perlindungan Saksi dan Korban (LPSK).
                </p>

                <p class="mt-3">
                    Pihak yang melanggar prinsip kerahasiaan tersebut akan diberikan sanksi yang berat 
                    sesuai ketentuan yang berlaku di perusahaan.
                </p>

                <p class="mt-3">
                    Kebijakan perlindungan dan jaminan kerahasiaan tidak diberikan pada Pelapor yang 
                    terbukti melakukan pelaporan palsu dan/atau fitnah.
                </p>

                <p class="mt-3">
                    Apabila hasil Investigasi Terkait Pelaporan Pelanggaran (Whistleblowing) terbukti 
                    laporan palsu, fitnah, tanpa dasar yang jelas, maka Pelapor dapat digugat balik atau 
                    dikenai sanksi sesuai dengan peraturan perundangan yang berlaku terkait perbuatan 
                    tidak menyenangkan atau pencemaran nama baik, serta peraturan internal perusahaan.
                </p>

            </div>


        </div>
    </div>
</section>



