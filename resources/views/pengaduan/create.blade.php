@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <h1 class="text-3xl font-bold mb-6">Form Pengaduan WBS</h1>

        @if(session('success'))
            <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST"
              action="{{ route('pengaduan.store') }}"
              enctype="multipart/form-data">
            @csrf

            {{-- URAIAN --}}
            <div class="mb-5">
                <label class="font-semibold block mb-1">Uraian Singkat</label>
                <textarea name="uraian" rows="3"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring focus:ring-blue-300"></textarea>
            </div>

            {{-- TANGGAL KEJADIAN --}}
            <div class="mb-6">
                <label class="font-semibold block mb-1">
                    Perkiraan Waktu Kejadian
                </label>
                <input type="date"
                    name="d_wbls_incident"
                    class="w-full border rounded-lg px-4 py-2
                           focus:ring focus:ring-blue-300">
            </div>

            {{-- KATEGORI --}}
            <div class="mb-6">
                <label class="font-semibold block mb-1">Kategori Pengaduan</label>
                <select id="kategori" name="c_wbls_categ"
                    class="w-full border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->c_wbls_categ }}">
                            {{ $k->n_wbls_categ }}
                        </option>
                    @endforeach
                </select>
            </div>


            {{-- ================= PERTANYAAN ================= --}}
            @foreach($questions as $q)
                <div class="question hidden mb-8"
                     data-kategori="{{ $q->c_wbls_categ }}">

                    <label class="font-semibold block mb-2">
                        {{ $q->n_question }}
                    </label>

                    {{-- TEXT / CURRENCY --}}
                    @if(in_array($q->c_question, [1,6]))
                        <input type="text"
                            name="answers[{{ $q->i_id_question }}]"
                            class="w-full border rounded-lg px-4 py-2">

                    {{-- TEXTAREA --}}
                    @elseif($q->c_question == 3)
                        <textarea
                            name="answers[{{ $q->i_id_question }}]"
                            class="w-full border rounded-lg px-4 py-2"></textarea>

                    {{-- RADIO --}}
                    @elseif($q->c_question == 4)
                        <div class="space-y-2">
                            @foreach($q->choices as $c)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio"
                                        name="answers[{{ $q->i_id_question }}]"
                                        value="{{ $c->i_id_questionchoice }}"
                                        class="text-blue-600">
                                    <span>{{ $c->n_choice }}</span>
                                </label>
                            @endforeach
                        </div>

                    {{-- DROPDOWN --}}
                    @elseif($q->c_question == 5)
                        <select name="answers[{{ $q->i_id_question }}]"
                            class="w-full border rounded-lg px-4 py-2">
                            <option value="">-- pilih --</option>
                            @foreach($q->choices as $c)
                                <option value="{{ $c->i_id_questionchoice }}">
                                    {{ $c->n_choice }}
                                </option>
                            @endforeach
                        </select>

                    {{-- FILE UPLOAD --}}
                    @elseif($q->c_question == 7)
                        <div class="space-y-4">
                            <select
                                name="file_categ[{{ $q->i_id_question }}]"
                                class="w-full border rounded-lg px-3 py-2">
                                <option value="">-- Kategori File --</option>
                                @foreach($fileCateg as $f)
                                    <option value="{{ $f->c_wbls_filecateg }}">
                                        {{ $f->n_wbls_filecateg }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="file"
                                name="files[{{ $q->i_id_question }}]"
                                class="block w-full border rounded-lg px-3 py-2 cursor-pointer">
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- SUBMIT --}}
            <div class="mt-10 text-right">
                <button
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg
                           hover:bg-blue-700">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('kategori').addEventListener('change', function () {
    document.querySelectorAll('.question').forEach(q => {
        q.classList.add('hidden');
        if (q.dataset.kategori === this.value) {
            q.classList.remove('hidden');
        }
    });
});
</script>
@endsection
