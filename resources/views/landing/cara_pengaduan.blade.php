<section id="cara_pengaduan" class="py-30 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">

        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Cara Pengaduan</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
        <div class="flex justify-center py-10 bg-gray-50">
            <div class="bg-white rounded-xl shadow-sm px-8 py-4 w-full max-w-4xl">
                <nav class="flex justify-center space-x-10 border-b border-gray-200">
                    @foreach($steps as $index => $step)
                        <button
                            class="step-btn pb-3 text-sm font-medium transition
                                {{ $index === 0 
                                        ? 'text-blue-600 border-b-2 border-blue-600' 
                                        : 'text-gray-500 hover:text-blue-600 border-b-2 border-transparent' }}"
                            data-step="{{ $step->c_wbls_procord }}">
                            Step#{{ $step->c_wbls_procord }}
                        </button>
                        @endforeach
                </nav>
            </div>
        </div>


        <div id="step-content"
            style="background: #f9f9f9; padding: 25px; border-radius: 10px; text-align: left; font-size: 15px; color: #444; line-height: 1.7;">

            @if($steps->count())
                <h3 style="font-size: 18px; font-weight: bold;">
                    {{ $steps->first()->c_wbls_procord }}. {{ $steps->first()->n_wbls_proc }}
                </h3>
                {!! $steps->first()->e_wbls_proc !!}
            @endif

        </div>

</section>

<script>
    const stepContents = {
        @foreach($steps as $step)
        "{{ $step->c_wbls_procord }}": {
            title: "{{ $step->c_wbls_procord }}. {{ addslashes($step->n_wbls_proc) }}",
            text: `{!! str_replace(["\r", "\n"], '', $step->e_wbls_proc) !!}`
        },
        @endforeach
    };

    document.querySelectorAll(".step-btn").forEach(btn => {
        btn.addEventListener("click", function () {

            // RESET semua tab
            document.querySelectorAll(".step-btn").forEach(b => {
                b.classList.remove(
                    "text-blue-600",
                    "border-blue-600"
                );
                b.classList.add(
                    "text-gray-500",
                    "border-transparent"
                );
            });

            // AKTIFKAN tab yang diklik
            this.classList.remove("text-gray-500", "border-transparent");
            this.classList.add("text-blue-600", "border-blue-600");

            // Update konten
            const step = this.dataset.step;
            const box = document.getElementById("step-content");

            box.innerHTML = `
                <h3 class="text-lg font-bold mb-2">
                    ${stepContents[step].title}
                </h3>
                ${stepContents[step].text}
            `;
        });
    });
</script>
