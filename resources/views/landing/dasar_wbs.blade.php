<section id="dasar_wbs" class="py-24 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">
        <h4 class="text-3xl font-bold mb-2">
            {{ $dasarWbs->n_wbls_about }}
        </h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-12"></div>
    </div>

    <div class="max-w-5xl mx-auto px-6 space-y-6">
        @foreach ($items as $index => $item)
            <div class="bg-white shadow-md rounded-xl p-5">
                <div class="flex flex-col md:flex-row md:items-center gap-4">

                    {{-- Nomor --}}
                    <div class="w-10 h-10 shrink-0 flex items-center justify-center
                                bg-blue-600 text-white font-bold rounded-full">
                        {{ $index + 1 }}
                    </div>

                    {{-- Garis --}}
                    <div class="hidden md:block flex-1 border-b-2 border-dashed border-blue-300"></div>

                    {{-- Teks --}}
                    <p class="md:w-1/2 text-gray-700 text-left">
                        {!! $item !!}
                    </p>

                </div>
            </div>
        @endforeach
    </div>
</section>
