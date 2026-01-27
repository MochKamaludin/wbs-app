@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md p-8">

        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Form Pengaduan WBS
        </h1>
        <p class="text-gray-500 mb-6">
            Silakan isi form pengaduan sesuai kategori yang dipilih.
        </p>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 text-green-700 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-lg bg-red-100 text-red-700 px-4 py-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST"
              action="{{ route('pengaduan.store') }}"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            {{-- JUDUL --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Judul Pengaduan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" required
                    class="w-full bg-white rounded-lg border border-gray-300
                           px-3 py-2 shadow-sm
                           focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- URAIAN --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Uraian Singkat
                </label>
                <textarea name="uraian" rows="3"
                    class="w-full bg-white rounded-lg border border-gray-300
                           px-3 py-2 shadow-sm
                           focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            {{-- KATEGORI --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Kategori Pengaduan <span class="text-red-500">*</span>
                </label>
                <select id="kategori" required
                    class="w-full bg-white rounded-lg border border-gray-300
                           px-3 py-2 shadow-sm
                           focus:border-blue-500 focus:ring-blue-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->c_wbls_categ }}">
                            {{ $k->n_wbls_categ }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr class="my-8">

            {{-- PERTANYAAN --}}
            <div class="space-y-6">
                @foreach ($questions as $q)
                    <div class="question-item hidden"
                         data-kategori="{{ $q->c_wbls_categ }}">

                        <label class="block font-semibold text-gray-800 mb-2">
                            {{ $q->n_question }}
                            @if($q->f_required)
                                <span class="text-red-500">*</span>
                            @endif
                        </label>

                        {{-- TEXT --}}
                        @if($q->c_question == 1)
                            <input type="text"
                                name="answers[{{ $q->i_id_question }}]"
                                class="w-full bg-white rounded-lg border border-gray-300
                                       px-3 py-2 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500">

                        {{-- TEXTAREA --}}
                        @elseif($q->c_question == 3)
                            <textarea rows="3"
                                name="answers[{{ $q->i_id_question }}]"
                                class="w-full bg-white rounded-lg border border-gray-300
                                       px-3 py-2 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500"></textarea>

                        {{-- RADIO --}}
                        @elseif($q->c_question == 4)
                            <div class="space-y-2">
                                @foreach($q->choices as $c)
                                    <label class="flex items-center gap-2 text-gray-700">
                                        <input type="radio"
                                            name="answers[{{ $q->i_id_question }}]"
                                            value="{{ $c->n_choice }}"
                                            class="text-blue-600 focus:ring-blue-500">
                                        <span>{{ $c->n_choice }}</span>
                                    </label>
                                @endforeach
                            </div>

                        {{-- SELECT --}}
                        @elseif($q->c_question == 5)
                            <select
                                name="answers[{{ $q->i_id_question }}]"
                                class="w-full bg-white rounded-lg border border-gray-300
                                       px-3 py-2 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- pilih --</option>
                                @foreach($q->choices as $c)
                                    <option value="{{ $c->n_choice }}">
                                        {{ $c->n_choice }}
                                    </option>
                                @endforeach
                            </select>

                        {{-- CURRENCY --}}
                        @elseif($q->c_question == 6)
                            <input type="number" step="0.01"
                                name="answers[{{ $q->i_id_question }}]"
                                class="w-full bg-white rounded-lg border border-gray-300
                                       px-3 py-2 shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500">

                        {{-- FILE --}}
                        @elseif($q->c_question == 7)
                            <input type="file"
                                name="answers[{{ $q->i_id_question }}]"
                                class="block w-full text-sm text-gray-600
                                       border border-gray-300 rounded-lg
                                       file:bg-blue-50 file:border-0
                                       file:px-4 file:py-2 file:font-semibold
                                       file:text-blue-700 hover:file:bg-blue-100">
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- SUBMIT --}}
            <div class="pt-6 text-right">
                <button type="submit"
                    class="inline-flex items-center gap-2
                           bg-blue-600 hover:bg-blue-700
                           text-white font-semibold
                           px-6 py-3 rounded-lg shadow">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT FILTER --}}
<script>
document.getElementById('kategori').addEventListener('change', function () {
    const selected = this.value;

    document.querySelectorAll('.question-item').forEach(el => {
        el.classList.add('hidden');

        if (el.dataset.kategori === selected) {
            el.classList.remove('hidden');
        }
    });
});
</script>
@endsection
