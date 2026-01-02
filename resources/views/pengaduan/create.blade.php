@extends('layouts.app')

@section('content')

{{-- QUILL --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<div class="max-w-4xl mx-auto bg-white p-6 md:p-8 rounded-xl shadow mt-16">

    {{-- TITLE --}}
    <div class="text-center mt-6">
        <h1 class="text-3xl font-bold text-gray-800">Pengaduan Baru</h1>
        <div class="w-24 h-1 bg-blue-600 mx-auto mt-2 rounded-full"></div>
    </div>

    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf

        {{-- PERIHAL --}}
        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Perihal <span class="text-red-500">*</span>
            </label>
            <select class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                <option>Gratifikasi</option>
                <option value="">Suap</option>
                <option value="">Konflik Kepentingan</option>
            </select>
        </div>

        {{-- KETERANGAN --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Hubungan dengan Pemberi dan alasan pemberian
            </label>

            {{-- Toolbar --}}
            <div id="toolbar" class="rounded-t-lg">
                <select class="ql-font"></select>
                <select class="ql-size"></select>

                <button class="ql-bold"></button>
                <button class="ql-italic"></button>
                <button class="ql-underline"></button>

                <button class="ql-list" value="ordered"></button>
                <button class="ql-list" value="bullet"></button>

                <button class="ql-link"></button>
                <button class="ql-image"></button>
                <button class="ql-clean"></button>
            </div>

            {{-- Editor --}}
            <div id="editor"
                 class="bg-white border border-t-0 rounded-b-lg"
                 style="min-height: 150px;"></div>

            {{-- Hidden Input --}}
            <input type="hidden" name="alasan_pemberian" id="alasan_pemberian">
        </div>

        {{-- INPUT GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <input class="border rounded-lg px-3 py-2" placeholder="Jenis Pemberian">
            <input class="border rounded-lg px-3 py-2" placeholder="Lainnya">
            <input class="border rounded-lg px-3 py-2" placeholder="Bentuk Pemberian">
            <input class="border rounded-lg px-3 py-2" placeholder="Lainnya">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <input class="border rounded-lg px-3 py-2" placeholder="Nilai Ekvivalen Rupiah">
            <input type="date" class="border rounded-lg px-3 py-2">
        </div>

        {{-- TERLAPOR --}}
        <div class="mb-6">
            <div class="flex justify-between items-center mb-3">
                <span class="font-semibold">Terlapor</span>
                <button type="button"
                        onclick="openModal()"
                        class="text-blue-600 hover:text-blue-800 text-xl">
                    <i class="fas fa-user-plus"></i>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border text-sm">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Nama</th>
                            <th class="px-3 py-2">Nama Perusahaan</th>
                            <th class="px-3 py-2">Alamat</th>
                            <th class="px-3 py-2">Nomor Telepon</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-400">
                                Belum ada data
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FILE --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                File Pendukung <span class="text-red-500">*</span>
            </label>
            <input type="file" class="border rounded-lg px-3 py-2 w-full">

            <p class="text-xs text-red-500 mt-2 leading-relaxed">
                File Document Max 3Mb (doc, excel, pdf & ppt)<br>
                File Video Max 30Mb (mp4, mkv & avi)<br>
                File Image Max 1Mb (jpg, png & bmp)
            </p>
        </div>
    
        {{-- KETERANGAN --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">
                Keterangan Tambahan
            </label>
            <textarea class="border rounded-lg px-3 py-2 w-full h-24"
                      placeholder="Keterangan Tambahan"></textarea>
        </div>
        {{-- CAPTCHA --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Kode Captcha</label>

            <div class="flex items-center gap-3">
                <!-- CAPTCHA BOX -->
                <div id="captchaBox"
                    class="select-none bg-gray-200 px-4 py-2 rounded-lg font-bold tracking-widest text-lg text-gray-800">
                </div>

                <!-- REFRESH -->
                <button type="button"
                        onclick="generateCaptcha()"
                        class="text-blue-600 hover:text-blue-800 text-sm">
                    <i class="fas fa-rotate-right"></i>
                </button>
            </div>
        </div>

        <div class="mb-8">
            <input id="captchaInput"
                name="captcha"
                class="border rounded-lg px-3 py-2 w-full"
                placeholder="Ketikkan Kode Captcha"
                required>
        </div>

        <input type="hidden" id="captchaValue" name="captcha_value">

        <script>
            function generateCaptcha() {
                const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                let captcha = '';

                for (let i = 0; i < 6; i++) {
                    captcha += chars.charAt(Math.floor(Math.random() * chars.length));
                }

                document.getElementById('captchaBox').innerText = captcha;
                document.getElementById('captchaValue').value = captcha;
            }

            // generate saat halaman load
            document.addEventListener('DOMContentLoaded', generateCaptcha);
        </script>

        {{-- Controller --}}
        {{-- $request->validate([
            'captcha' => ['required'],
        ]);

        if ($request->captcha !== $request->captcha_value) {
            return back()->withErrors([
                'captcha' => 'Kode captcha tidak sesuai'
            ])->withInput();
        } --}}

        {{-- BUTTON --}}
        <div class="flex flex-wrap gap-3">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>

            <a href="{{ url('/') }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-black px-6 py-2 rounded-lg">
                Kembali
            </a>
        </div>
    </form>
</div>

{{-- QUILL INIT --}}
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: '#toolbar'
        }
    });

    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('alasan_pemberian').value = quill.root.innerHTML;
    });
</script>

{{-- MODAL TERLAPOR --}}
@include('pengaduan.modal_terlapor')

@endsection