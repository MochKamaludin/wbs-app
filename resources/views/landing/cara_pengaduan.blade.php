<section id="cara_pengaduan" class="py-30 bg-white reveal">
    <div class="max-w-5xl mx-auto text-center px-6">

        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Cara Pengaduan</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        <div class="cara-nav"
            style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 30px;">
            @foreach($steps as $index => $step)
                <button
                    class="step-btn {{ $index === 0 ? 'active' : '' }}"
                    data-step="{{ $step->c_wbls_procord }}">
                    Step#{{ $step->c_wbls_procord }}
                </button>
            @endforeach
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


<!-- STEP CONTENT SCRIPT -->
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

            document.querySelectorAll(".step-btn")
                .forEach(b => b.classList.remove("active"));

            this.classList.add("active");

            const step = this.getAttribute("data-step");
            const box = document.getElementById("step-content");

            box.innerHTML = `
                <h3 style="font-size: 18px; font-weight: bold;">
                    ${stepContents[step].title}
                </h3>
                <p>${stepContents[step].text}</p>
            `;
        });
    });
</script>



<!-- CSS -->
<style>
    .step-btn {
        padding: 8px 15px;
        border-radius: 6px;
        border: 1px solid #007bff;
        background: white;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

    .step-btn:hover {
        background: #007bff;
        color: white;
    }

    .step-btn.active {
        background: #007bff;
        color: white;
    }
</style>
