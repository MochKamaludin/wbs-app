@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4">
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-6 md:p-8">

        <h1 class="text-2xl font-bold text-slate-800 mb-2">
            Cek Status Pengaduan
        </h1>
        <p class="text-slate-600 mb-6">
            Masukkan nomor resi yang Anda terima setelah mengirim pengaduan.
        </p>

        <form method="POST" action="{{ route('cek-status.check') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Nomor Resi
                </label>

                @php
                    $inputClass = $errors->has('resi')
                        ? 'border-red-500 focus:ring-red-500'
                        : 'border-slate-300 focus:ring-blue-500';
                @endphp

                <input
                    type="text"
                    name="resi"
                    value="{{ old('resi', $resi ?? '') }}"
                    placeholder="Contoh: s0M1ZJ8a1Qp2H3z8..."
                    class="w-full rounded-xl border px-4 py-2.5 text-slate-800
                           focus:outline-none focus:ring-2 {{ $inputClass }}"
                >

                @error('resi')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700
                       text-white font-semibold py-2.5 rounded-xl
                       transition duration-200">
                Cek Status
            </button>
        </form>

        @isset($wbls)
        <div class="mt-8 border-t border-slate-200 pt-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">
                Hasil Pengecekan
            </h2>

            @php
                $statusClass = match ((int) ($wbls->c_wbls_stat ?? 0)) {
                    1 => 'bg-slate-100 text-slate-700',
                    2 => 'bg-orange-100 text-orange-700',
                    3 => 'bg-red-100 text-red-700',
                    4 => 'bg-blue-100 text-blue-700',
                    5 => 'bg-green-100 text-green-700',
                    6 => 'bg-emerald-100 text-emerald-700',
                    default => 'bg-gray-100 text-gray-600',
                };
            @endphp

            <div class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-500">No. WBS</span>
                    <span class="font-medium text-slate-800">
                        {{ $wbls->i_wbls }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Tanggal Kejadian</span>
                    <span class="text-slate-800">
                        {{ $wbls->d_wbls_incident }}
                    </span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Status</span>

                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                        {{ $status->n_wbls_stat ?? 'Tidak diketahui' }}
                    </span>
                </div>

                <div>
                    <span class="text-slate-500 block mb-1">
                        Keterangan Status
                    </span>
                    <div class="bg-slate-50 rounded-xl p-4 text-slate-700 text-sm leading-relaxed">
                        {!! $wbls->e_wbls_stat ?? '-' !!}
                    </div>
                </div>
            </div>
        </div>
        @endisset

    </div>
</div>
@endsection