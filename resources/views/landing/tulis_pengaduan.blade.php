@extends('layouts.app')

@section('content')
<section class="py-24">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl">

        <h2 class="text-2xl font-bold mb-6 text-center">Form Pengaduan</h2>

        <form method="POST" action="#">
            @csrf

            <div class="mb-5">
                <label class="font-semibold text-sm">Nama Pelapor</label>
                <input type="text" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
            </div>

            <div class="mb-5">
                <label class="font-semibold text-sm">Jenis Pelanggaran</label>
                <select class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600">
                    <option>Pilih jenis pelanggaran</option>
                </select>
            </div>

            <div class="mb-5">
                <label class="font-semibold text-sm">Deskripsi Laporan</label>
                <textarea class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600" rows="5"></textarea>
            </div>

            <div class="flex justify-end">
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Kirim Laporan
                </button>
            </div>
        </form>

    </div>
</section>
@endsection
