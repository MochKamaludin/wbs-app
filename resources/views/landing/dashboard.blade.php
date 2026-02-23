<section id="dashboard" class="py-20 bg-gray-50 reveal">

    <div class="text-center mt-6">
        <h1 class="text-3xl font-bold text-gray-800">Jumlah Laporan WBS</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-2 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 px-4">
        <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold">{{ $belumDiproses }}</div>
            <p class="mt-1 text-sm text-green-300">{{ $persenBelum }}%</p>
            <p class="font-semibold mt-3">BELUM DIPROSES</p>
        </div>

        <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold">{{ $dalamProses }}</div>
            <p class="mt-1 text-sm text-green-300">{{ $persenProses }}%</p>
            <p class="font-semibold mt-3">DALAM PROSES</p>
        </div>

        <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold">{{ $selesaiDiproses }}</div>
            <p class="mt-1 text-sm text-green-300">{{ $persenSelesai }}%</p>
            <p class="font-semibold mt-3">SELESAI DIPROSES</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow mt-10 p-6 px-8">

        <h2 class="font-bold text-lg">JUMLAH LAPORAN BERDASARKAN KATEGORI</h2>
        <form method="GET" action="{{ url('/#dashboard') }}"
              class="flex flex-wrap items-center gap-3 mt-3">

            <button type="button"
                onclick="window.location='{{ url('/#dashboard') }}'"
                class="px-4 py-1 bg-gray-200 rounded">
                Clear
            </button>

            <input type="month"
                name="start"
                value="{{ request('start') }}"
                class="border rounded px-3 py-1">

            <input type="month"
                name="end"
                value="{{ request('end') }}"
                class="border rounded px-3 py-1">

            <button type="submit"
                class="px-4 py-1 bg-teal-500 text-white rounded">
                Cari periode
            </button>
        </form>

        <p class="mt-3 font-semibold">
            PERIODE :
            @if(request('start'))
                {{ \Carbon\Carbon::parse(request('start'))->translatedFormat('F Y') }}
            @else
                SEMUA DATA
            @endif
            -
            @if(request('end'))
                {{ \Carbon\Carbon::parse(request('end'))->translatedFormat('F Y') }}
            @endif
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mt-5">

            @php
                $grandTotal = $belumDiproses + $dalamProses + $selesaiDiproses;
            @endphp

            @foreach ($kategoriData as $item)
            <div class="rounded-lg overflow-hidden shadow border bg-white">
                <div class="bg-linear-to-b from-blue-800 to-blue-600 text-white text-center py-4 px-1 text-xs font-semibold leading-tight">
                    {{ strtoupper($item->n_wbls_categ) }}
                </div>
                <div class="text-center py-4 bg-white">
                    <div class="text-2xl font-bold text-gray-800">
                        {{ $item->jumlah }}
                    </div>
                    <div class="text-green-500 text-sm font-semibold">
                        {{ $grandTotal > 0 
                            ? round(($item->jumlah / $grandTotal) * 100, 2) . '%' 
                            : '0%' }}
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">

            <div class="bg-white shadow rounded-xl p-5">
                <h3 class="font-semibold mb-3 text-center">GRAFIK LAPORAN WBS</h3>
                <div class="w-full h-72">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl p-5">
                <h3 class="font-semibold mb-3 text-center">GRAFIK LAPORAN PER KATEGORI</h3>
                <div class="w-full h-72">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>

        </div>

    </div>

</section>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json($labels);
const dataKategori = @json($dataKategori);

new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Jumlah Laporan',
            data: dataKategori,
            backgroundColor: '#4A90E2'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: dataKategori,
            backgroundColor: [
                '#4A90E2','#50E3C2','#F5A623','#BD10E0',
                '#B8E986','#F8E71C','#7ED321','#D0021B',
                '#9013FE','#417505','#F5515F','#9B9B9B'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});
</script>