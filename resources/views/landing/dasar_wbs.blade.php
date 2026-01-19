<section id="dasar_wbs" class="py-24 bg-linear-to-b from-white via-blue-50 to-white reveal">

    {{-- Judul --}}
    <div class="max-w-5xl mx-auto text-center px-6 mb-14">
        <h4 class="text-3xl font-bold text-gray-900 mb-3">
            {{ $dasarWbs->n_wbls_about ?? 'Dasar WBS' }}
        </h4>
        <div class="w-24 h-1 bg-linear-to-r from-blue-500 to-indigo-600 mx-auto rounded-full"></div>
    </div>

    {{-- List --}}
    <div class="max-w-5xl mx-auto px-6 space-y-8">
        @forelse ($items as $index => $item)
            <div
                class="
                    relative
                    rounded-2xl
                    p-6
                    bg-linear-to-r from-blue-600 to-indigo-700
                    shadow-lg
                    transition
                    hover:-translate-y-3 hover:shadow-2xl
                "
            >
                <div class="flex flex-col md:flex-row md:items-center gap-5">

                    {{-- Nomor --}}
                    <div
                        class="
                            w-12 h-12 shrink-0
                            flex items-center justify-center
                            rounded-full
                            bg-linear-to-br from-blue-400 to-indigo-500
                            text-white font-bold text-lg
                            shadow-md
                        "
                    >
                        {{ $index + 1 }}
                    </div>

                    {{-- Garis --}}
                    <div class="hidden md:block flex-1 relative">
                        <div class="absolute inset-y-1/2 w-full border-t-2 border-dashed border-blue-300/50"></div>
                    </div>

                    {{-- Konten --}}
                    <div class="md:w-1/2 text-white text-left leading-relaxed">
                        {!! $item !!}
                    </div>

                </div>

                {{-- efek glow --}}
                <div class="absolute inset-0 rounded-2xl ring-1 ring-white/10 pointer-events-none"></div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-8">
                <p>Belum ada data Dasar WBS. Silakan tambahkan data melalui admin panel.</p>
            </div>
        @endforelse
    </div>

</section>
