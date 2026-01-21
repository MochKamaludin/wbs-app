<section id="faq" class="py-20 bg-white scroll-mt-24 reveal">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- TITLE -->
        <h2 class="text-2xl font-bold text-center">
            Frequently Asked Questions
        </h2>
        <div class="w-20 h-1 bg-blue-600 mx-auto my-4"></div>

        <!-- FAQ LIST -->
        <div class="mt-8 space-y-4">

            @forelse ($faq as $index => $faq)
                <div class="faq-item" onclick="toggleFAQ({{ $index }})">
                    <div class="faq-question">
                        {{ $faq->e_wbls_faqquest }}
                        <span id="faq-toggle-{{ $index }}" class="faq-toggle">+</span>
                    </div>

                    <div id="faq-answer-{{ $index }}" class="faq-answer">
                        {!! $faq->e_wbls_faqans !!}
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 text-sm">
                    Data FAQ belum tersedia.
                </p>
            @endforelse

        </div>
    </div>
</section>

<style>
    .faq-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 14px 0;
        cursor: pointer;
    }
    .faq-question {
        font-weight: 600;
        color: #2563eb;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        font-size: 15px;
    }
    .faq-answer {
        display: none;
        margin-top: 10px;
        color: #374151;
        line-height: 1.6;
        font-size: 14px;
    }
    .faq-toggle {
        font-size: 20px;
        font-weight: bold;
        color: #2563eb;
        flex-shrink: 0;
    }
</style>

<script>
    function toggleFAQ(index) {
        const answer = document.getElementById('faq-answer-' + index);
        const toggle = document.getElementById('faq-toggle-' + index);

        const isOpen = answer.style.display === "block";

        document.querySelectorAll('.faq-answer').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.faq-toggle').forEach(el => el.innerHTML = '+');

        if (!isOpen) {
            answer.style.display = "block";
            toggle.innerHTML = "-";
        }
    }
</script>
