@extends('layouts.app')

@section('content')

@if(session('resi'))
<div class="mb-6 rounded-2xl border border-blue-200 bg-blue-50 p-6 text-center">

    <p class="text-lg font-semibold text-blue-800 mb-4">
        Pengaduan berhasil dikirim
    </p>

    <div class="flex items-center justify-center gap-2 max-w-full">
        <div
            id="resiText"
            class="font-mono text-blue-900 text-lg break-all
                   bg-white rounded-xl px-4 py-3 border flex-1 max-w-md">
            {{ session('resi') }}
        </div>

        <button
            type="button"
            onclick="copyResi()"
            class="shrink-0 rounded-xl border border-blue-300
                   bg-blue-600 text-white px-4 py-3
                   hover:bg-blue-700 transition text-sm font-semibold">
            Copy
        </button>
    </div>

    <p id="copyNotif" class="hidden mt-3 text-sm text-green-600 font-medium">
        Nomor resi berhasil disalin ✔
    </p>

    <p class="text-sm text-slate-600 mt-2">
        Simpan nomor resi ini untuk mengecek status pengaduan.
    </p>
</div>

<script>
function copyResi() {
    const text = document.getElementById('resiText').innerText;
    navigator.clipboard.writeText(text).then(() => {
        const notif = document.getElementById('copyNotif');
        notif.classList.remove('hidden');

        setTimeout(() => {
            notif.classList.add('hidden');
        }, 2000);
    });
}
</script>
@endif

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
                <label class="font-semibold block mb-1">
                    Uraian Singkat <span class="text-red-600">*</span>
                </label>
                <textarea name="uraian" rows="3"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300">{{ old('uraian') }}</textarea>
            </div>

            {{-- TANGGAL KEJADIAN --}}
            <div class="mb-6">
                <label class="font-semibold block mb-1">
                    Perkiraan Waktu Kejadian <span class="text-red-600">*</span>
                </label>
                <input type="date"
                    name="d_wbls_incident"
                    value="{{ old('d_wbls_incident') }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-300">
            </div>

            {{-- KATEGORI --}}
            <div class="mb-6">
                <label class="font-semibold block mb-1">
                    Kategori Pengaduan <span class="text-red-600">*</span>
                </label>
                <select id="kategori" name="c_wbls_categ"
                    class="w-full border rounded-lg px-4 py-2">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->c_wbls_categ }}"
                            {{ old('c_wbls_categ') == $k->c_wbls_categ ? 'selected' : '' }}>
                            {{ $k->n_wbls_categ }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- KATEGORI LAINNYA --}}
            <div class="mb-6 hidden" id="kategori-lainnya-wrapper">
                <label class="font-semibold block mb-1">
                    Kategori Lainnya <span class="text-red-600">*</span>
                </label>
                <input type="text"
                    name="n_wbls_categother"
                    value="{{ old('n_wbls_categother') }}"
                    class="w-full border rounded-lg px-4 py-2"
                    placeholder="Tuliskan kategori lainnya">
            </div>
            {{-- DEBUG --}}



            {{-- ================= PERTANYAAN ================= --}}
            @foreach($questions as $q)
                <div class="question hidden mb-8"
                     data-kategori="{{ $q->c_wbls_categ }}">

                    <label class="font-semibold block mb-2">
                        {{ $q->n_question }}
                        @if($q->f_required == 1)
                            <span class="text-red-600">*</span>
                        @endif
                    </label>

                    {{-- TEXT / CURRENCY --}}
                    @if(in_array($q->c_question, [1,6]))
                        <input type="text"
                            name="answers[{{ $q->i_id_question }}]"
                            value="{{ old('answers.' . $q->i_id_question) }}"
                            class="w-full border rounded-lg px-4 py-2">

                    {{-- TEXTAREA --}}
                    @elseif($q->c_question == 3)
                        <textarea
                            name="answers[{{ $q->i_id_question }}]"
                            class="w-full border rounded-lg px-4 py-2">{{ old('answers.' . $q->i_id_question) }}</textarea>

                    {{-- RADIO --}}
                    @elseif($q->c_question == 2)
                        <div class="space-y-2">
                            @foreach($q->choices as $c)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio"
                                        name="answers[{{ $q->i_id_question }}]"
                                        value="{{ $c->i_id_questionchoice }}"
                                        {{ old('answers.' . $q->i_id_question) == $c->i_id_questionchoice ? 'checked' : '' }}
                                        class="text-blue-600">
                                    <span>{{ $c->n_choice }}</span>
                                </label>
                            @endforeach
                        </div>
                    
                    @elseif($q->c_question == 5)
                        <select name="answers[{{ $q->i_id_question }}]"
                            class="w-full border rounded-lg px-4 py-2">
                            <option value="">-- pilih --</option>
                            @foreach($q->choices as $c)
                                <option value="{{ $c->i_id_questionchoice }}"
                                    {{ old('answers.' . $q->i_id_question) == $c->i_id_questionchoice ? 'selected' : '' }}>
                                    {{ $c->n_choice }}
                                </option>
                            @endforeach
                        </select>
                    
                    {{-- RADIO + TEXTAREA --}}
                    @elseif($q->c_question == 4)
                        <div class="space-y-3">

                            {{-- Radio --}}
                            @foreach($q->choices as $c)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio"
                                        name="answers[{{ $q->i_id_question }}][choice]"
                                        value="{{ $c->i_id_questionchoice }}"
                                        {{ old('answers.' . $q->i_id_question . '.choice') == $c->i_id_questionchoice ? 'checked' : '' }}
                                        class="text-blue-600">
                                    <span>{{ $c->n_choice }}</span>
                                </label>
                            @endforeach

                            {{-- Textarea --}}
                            <textarea
                                name="answers[{{ $q->i_id_question }}][text]"
                                placeholder="Keterangan tambahan..."
                                class="w-full border rounded-lg px-4 py-2">{{ old('answers.' . $q->i_id_question . '.text') }}</textarea>

                        </div>

                    {{-- FILE UPLOAD --}}
                    @elseif($q->c_question == 7)
                    <div class="space-y-4"
                        id="file-wrapper-{{ $q->i_id_question }}">

                        {{-- FILE ROW --}}
                        <div class="file-row flex gap-3 items-start">
                            <select
                                name="files[{{ $q->i_id_question }}][0][categ]"
                                class="w-1/3 border rounded-lg px-3 py-2"
                                required>
                                <option value="">-- Kategori File --</option>
                                @foreach($fileCateg as $f)
                                    <option value="{{ $f->c_wbls_filecateg }}">
                                        {{ $f->n_wbls_filecateg }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="file"
                                name="files[{{ $q->i_id_question }}][0][file]"
                                class="w-2/3 border rounded-lg px-3 py-2"
                                required>
                        </div>

                        {{-- ADD BUTTON --}}
                        <button type="button"
                            onclick="addFile({{ $q->i_id_question }})"
                            class="text-blue-600 text-sm hover:underline">
                            + Tambah File
                        </button>

                        <small class="text-red-500 block">
                            Bukti minimal satu
                        </small>
                    </div>
                    @endif


                </div>
            @endforeach

            {{-- SUBMIT --}}
            <div class="mt-10 text-right">
                <button
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kategori = document.getElementById('kategori');
    const wrapper = document.getElementById('kategori-lainnya-wrapper');
    const inputOther = wrapper.querySelector('input');

    function handleKategoriChange() {
        const selectedValue = kategori.value;

        document.querySelectorAll('.question').forEach(q => {
            const inputs = q.querySelectorAll('input, select, textarea');

            if (q.dataset.kategori === selectedValue) {
                q.classList.remove('hidden');

                inputs.forEach(el => {
                    if (el.dataset.required === 'true') {
                        el.required = true;
                    }
                });
            } else {
                q.classList.add('hidden');

                inputs.forEach(el => {
                    el.required = false;
                });
            }
        });

        if (selectedValue === '8') {
            wrapper.classList.remove('hidden');
            inputOther.required = true;
        } else {
            wrapper.classList.add('hidden');
            inputOther.required = false;
            inputOther.value = '';
        }
    }

    kategori.addEventListener('change', handleKategoriChange);
    handleKategoriChange();
});


let fileIndex = {};

function addFile(questionId) {
    if (!fileIndex[questionId]) {
        fileIndex[questionId] = 1;
    } else {
        fileIndex[questionId]++;
    }

    const wrapper = document.getElementById(`file-wrapper-${questionId}`);

    const div = document.createElement('div');
    div.className = 'file-row flex gap-3 items-start mt-2';

    div.innerHTML = `
        <select
            name="files[${questionId}][${fileIndex[questionId]}][categ]"
            class="w-1/3 border rounded-lg px-3 py-2"
            data-required>
            <option value="">-- Kategori File --</option>
            @foreach($fileCateg as $f)
                <option value="{{ $f->c_wbls_filecateg }}">
                    {{ $f->n_wbls_filecateg }}
                </option>
            @endforeach
        </select>

        <input type="file"
            name="files[${questionId}][${fileIndex[questionId]}][file]"
            class="w-2/3 border rounded-lg px-3 py-2"
            data-required>
    `;

    wrapper.insertBefore(div, wrapper.lastElementChild.previousElementSibling);
}

window.isHalamanPengaduan = true;
</script>

@endsection