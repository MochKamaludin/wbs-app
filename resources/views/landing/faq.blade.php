<!-- FAQ SECTION -->
<section id="faq" class="py-20 bg-white scroll-mt-24 reveal">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- TITLE -->
        <h2 class="text-2xl font-bold text-center">
            Frequently Asked Questions
        </h2>
        <div class="w-20 h-1 bg-blue-600 mx-auto my-4"></div>

        <!-- FAQ LIST -->
        <div class="mt-8 space-y-4">

            <!-- ITEM -->
            <div class="faq-item" onclick="toggleFAQ(1)">
                <div class="faq-question">
                    Apakah aplikasi Whistleblowing System (WBS) PT Dirgantara Indonesia?
                    <span id="faq-toggle-1" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-1" class="faq-answer">
                    Aplikasi Whistleblowing System (WBS) PT Dirgantara Indonesia adalah sistem
                    untuk mengelola pengaduan mengenai perilaku melawan hukum atau tindakan tidak etis
                    secara rahasia, anonim, dan independen untuk mengoptimalkan peran insan dan mitra kerja
                    PT Dirgantara Indonesia dalam mengungkap pelanggaran.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(2)">
                <div class="faq-question">
                    Apakah bentuk respon yang diberikan kepada pelapor atas pengaduan yang disampaikan?
                    <span id="faq-toggle-2" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-2" class="faq-answer">
                    Respon yang diberikan berupa respon awal dan status/tindak lanjut terbaru.
                    Respon dapat dilihat di menu history pengaduan setelah login.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(3)">
                <div class="faq-question">
                    Berapa lama respon atas pengaduan yang disampaikan diberikan kepada pelapor?
                    <span id="faq-toggle-3" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-3" class="faq-answer">
                    Respon wajib diberikan paling lambat 30 hari sejak pengaduan diterima.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(4)">
                <div class="faq-question">
                    Apakah pengaduan yang saya berikan akan selalu mendapatkan respon?
                    <span id="faq-toggle-4" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-4" class="faq-answer">
                    Ya, setiap pengaduan akan direspon dan diperbarui otomatis dalam aplikasi WBS.
                    Untuk melihat respon, Anda harus login dan membuka history pengaduan sesuai
                    nomor register. Pengaduan yang lengkap (what, where, when, who, how) lebih mudah diproses.
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(5)">
                <div class="faq-question">
                    Bagaimana tahapan proses pengaduan yang anda laporkan?
                    <span id="faq-toggle-5" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-5" class="faq-answer text-center">
                    <img src="{{ asset('images/proses_pengaduan.jpg') }}"
                        class="w-full max-w-xs sm:max-w-md mx-auto rounded-lg"
                        alt="Proses Pengaduan">
                </div>
            </div>

            <div class="faq-item" onclick="toggleFAQ(6)">
                <div class="faq-question">
                    Apakah kerahasiaan identitas saya sebagai pengadu/pelapor terjaga?
                    <span id="faq-toggle-6" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-6" class="faq-answer">
                    Identitas pelapor dijamin kerahasiaannya sesuai dengan kebijakan Whistleblowing System.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ STYLE -->
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

<!-- FAQ SCRIPT -->
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
