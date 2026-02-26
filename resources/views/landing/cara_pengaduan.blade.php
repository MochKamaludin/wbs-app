<section
    id="cara_pengaduan"
    class="py-25 bg-linear-to-b from-white via-blue-50 to-white reveal"
>
    <div class="max-w-5xl mx-auto text-center px-6">

        <h4 class="text-3xl font-bold text-gray-900 mb-3">
            Cara Pengaduan
        </h4>
        <div
            class="w-24 h-1 bg-linear-to-r from-blue-500 to-indigo-600 mx-auto rounded-full mb-12"
        ></div>

        <div class="flex justify-center">
            <div
                class="
                    bg-white
                    rounded-2xl
                    shadow-md
                    px-4 sm:px-6 py-4
                    w-full max-w-4xl
                "
            >
                <nav
                    class="
                        flex items-center
                        gap-4 sm:gap-8
                        overflow-x-auto
                        border-b border-gray-200
                        scrollbar-hide
                    "
                >
                    @foreach($steps as $index => $step)
                        <button
                            class="
                                step-btn
                                relative
                                whitespace-nowrap
                                pb-3
                                text-sm sm:text-base
                                font-semibold
                                transition-all duration-300
                                border-b-2
                                {{ $index === 0
                                    ? 'text-blue-600 border-blue-600'
                                    : 'text-gray-500 hover:text-blue-600 border-transparent'
                                }}
                            "
                            data-step="{{ $step->c_wbls_procord }}"
                        >
                            Step {{ $step->c_wbls_procord }}
                        </button>
                    @endforeach
                </nav>
            </div>
        </div>

        <div
            id="step-content"
            class="
                mt-10
                bg-white
                rounded-2xl
                shadow-lg
                p-8
                text-left
                text-gray-700
                leading-relaxed
                prose prose-sm max-w-none
            "
        >
            @if($steps->count())
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    {{ $steps->first()->c_wbls_procord }}.
                    {{ $steps->first()->n_wbls_proc }}
                </h3>
                {!! $steps->first()->e_wbls_proc !!}
            @endif
        </div>

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

            document.querySelectorAll(".step-btn").forEach(b => {
                b.classList.remove("text-blue-600", "border-blue-600");
                b.classList.add("text-gray-500", "border-transparent");
            });

            this.classList.remove("text-gray-500", "border-transparent");
            this.classList.add("text-blue-600", "border-blue-600");

            const step = this.dataset.step;
            const box = document.getElementById("step-content");

            box.innerHTML = `
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    ${stepContents[step].title}
                </h3>
                ${stepContents[step].text}
            `;
        });
    });
</script>
