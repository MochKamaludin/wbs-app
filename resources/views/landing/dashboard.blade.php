@php
$kategori = [
    ['Korupsi', 0, '0.00%'],
    ['Suap', 1, '7.14%'],
    ['Gratifikasi', 2, '14.29%'],
    ['Benturan Kepentingan', 0, '0.00%'],
    ['Pencurian', 1, '7.14%'],
    ['Kecurangan (Fraud)', 0, '0.00%'],
    ['Pelanggaran Hukum / Kebijakan Perusahaan', 7, '50.00%'],
    ['Perilaku Lainnya', 2, '14.29%'],
];
@endphp

<section id="dashboard" class="py-20 bg-gray-50 reveal">

    {{-- JUDUL SECTION --}}
    <div class="text-center mt-6">
        <h1 class="text-3xl font-bold text-gray-800">Jumlah Laporan WBS</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-2 rounded-full"></div>
    </div>

    {{-- KARTU STATUS --}}
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 px-4">
        <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold">1</div>
            <p class="mt-1 text-sm text-green-300">7.14%</p>
            <p class="font-semibold mt-3">BELUM DIPROSES</p>
        </div>

        <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold">10</div>
            <p class="mt-1 text-sm text-green-300">71.48%</p>
            <p class="font-semibold mt-3">DALAM PROSES</p>
        </div>

        <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold">3</div>
            <p class="mt-1 text-sm text-green-300">21.48%</p>
            <p class="font-semibold mt-3">SELESAI DIPROSES</p>
        </div>
    </div>

    {{-- SECTION KATEGORI --}}
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow mt-10 p-6 px-8">

        <h2 class="font-bold text-lg">JUMLAH LAPORAN BERDASARKAN KATEGORI</h2>

        {{-- FILTER PERIODE --}}
        <div class="flex flex-wrap items-center gap-3 mt-3">
            <button class="px-4 py-1 bg-gray-200 rounded">Clear</button>
            <input type="month" class="border rounded px-3 py-1">
            <button class="px-4 py-1 bg-gray-200 rounded">Clear</button>
            <input type="month" class="border rounded px-3 py-1">
            <button class="px-4 py-1 bg-teal-500 text-white rounded">Cari periode</button>
        </div>

        <p class="mt-3 font-semibold">PERIODE : JANUARI 2000 - DESEMBER 2025</p>

        {{-- KATEGORI CARDS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mt-5">

            @foreach ($kategori as $item)
            <div class="rounded-lg overflow-hidden shadow border bg-white">

                <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white text-center py-4 px-1 text-xs font-semibold leading-tight">
                    {{ strtoupper($item[0]) }}
                </div>

                <div class="text-center py-4 bg-white">
                    <div class="text-2xl font-bold text-gray-800">{{ $item[1] }}</div>
                    <div class="text-green-500 text-sm font-semibold">{{ $item[2] }}</div>
                </div>

            </div>
            @endforeach

        </div>

        {{-- GRAFIK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">

            <div class="bg-white shadow rounded-xl p-5">
                <h3 class="font-semibold mb-3 text-center">GRAFIK LAPORAN WBS</h3>
                <div class="w-full h-72">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl p-5">
                <h3 class="font-semibold mb-3 text-center">GRAFIK LAPORAN PERKATEGORI</h3>
                <div class="w-full h-72">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

        </div>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const barChart = new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: ['Korupsi','Suap','Gratifikasi','Benturan Kepentingan','Pencurian','Kecurangan','Pelanggaran Hukum','Perilaku Lain'],
        datasets: [
            { label: 'Pengaduan Diterima', data: [0,1,2,0,1,0,7,2], backgroundColor: '#4A90E2' },
            { label: 'Pengaduan Diproses', data: [0,0,1,0,0,0,3,1], backgroundColor: '#50E3C2' },
            { label: 'Pengaduan Selesai',  data: [0,1,0,0,1,0,4,0], backgroundColor: '#F5A623' },
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

const pieChart = new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Korupsi','Suap','Gratifikasi','Benturan Kepentingan','Pencurian','Kecurangan','Pelanggaran Hukum','Perilaku Lain'],
        datasets: [{
            data: [0,1,2,0,1,0,7,2],
            backgroundColor: [
                '#4A90E2','#50E3C2','#F5A623','#BD10E0','#B8E986','#F8E71C','#7ED321','#D0021B'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});
</script>