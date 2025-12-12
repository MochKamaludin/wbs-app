@extends('layouts.app')

@section('content')


{{-- SECTION HERO — gambar --}}
<section id="home" 
    class="h-screen bg-cover bg-center flex items-center justify-center text-white"
    style="background-image: url('{{ asset('images/n219.jpg') }}');">

    <div class="text-center p-6 rounded-xl">
        <h1 class="text-2xl md:text-4xl font-bold mb-3">
            Selamat Datang di Pelaporan Pelanggaran <br>
            (Whistleblowing System)
        </h1>

        <h2 class="text-lg md:text-2xl mb-6">
            PT Dirgantara Indonesia
        </h2>

        <div class="flex justify-center space-x-4">
            <a href="#tentang_wbs" 
               class="px-5 py-2 bg-blue-600 hover:bg-white rounded-lg text-sm text-white hover:text-blue-600 font-semibold">
                Tentang WBS
            </a>

            <a href="#tulis" 
               class="px-5 py-2 bg-white hover:bg-blue-600 rounded-lg text-sm text-blue-600 hover:text-white font-semibold">
                Tulis Pengaduan
            </a>
        </div>
    </div>
</section>


@include('landing.tentang_wbs')
@include('landing.cara_pengaduan')
@include('landing.dasar_wbs')
@include('landing.dashboard')
@include('landing.faq')

@endsection
