<section id="dasar_wbs" class="py-30 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Dasar WBS</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
    </div>

    <div class="max-w-4xl mx-auto mt-10 space-y-6 px-6">
        @foreach([
            'Undang-Undang Nomor 28 Tahun 1999',
            'Undang-Undang Nomor 31 Tahun 1999',
            'Undang-Undang Nomor 19 Tahun 1999',
            'Undang-Undang Nomor 13 Tahun 1999',
            'Undang-Undang Nomor 40 Tahun 2007',
            'Peraturan Pemerintah Nomor 45 Tahun 2005',
            'Peraturan Menteri BUMN PER-01/MBU/2011 tanggal 1 Agustus 2011',
            'Keputusan Sekretaris Kementerian BUMN Nomor SK-16/S-MBU/2012 tanggal 6 Juni 2012',
            'Perjanjian Kerja Bersama PT Dirgantara Indonesia (Persero) Periode Tahun 2020',
            'Boed Manual PT Dirgantara Indonesia (Persero) Nomor 08-ML-0050 tentang Pedoman Perilaku dan Etika Bisnis (Code of Conduct) Tahun 2020',
            'Surat Keputusan Direksi PTDI Nomor: SKEP/653/30.02/UT0000/PTD/08/2019 tentang Pedoman Sistem Pelaporan Pelanggaran (WHISTLEBLOWING SYSTEM)'
        ] as $index => $item)

        <div class="bg-white shadow-md p-4 rounded-xl">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                
                {{-- Nomor --}}
                <div class="w-10 h-10 shrink-0 flex items-center justify-center bg-blue-600 text-white font-bold rounded-full">
                    {{ $index + 1 }}
                </div>

                {{-- Garis (desktop saja) --}}
                <div class="hidden md:block flex-1 border-b-2 border-dashed border-blue-300"></div>

                {{-- Teks --}}
                <p class="text-gray-700 md:w-1/2 text-left wrap-break-words">
                    {{ $item }}
                </p>
            </div>
        </div>

        @endforeach

    </div>
</section>
