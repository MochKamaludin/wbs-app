<!-- FAQ SECTION -->
<section id="faq" style="padding: 40px; background-color: white;">
    <div style="max-width: 900px; margin: 0 auto;">

        <!-- TITLE -->
        <h2 style="font-size: 24px; font-weight: bold; text-align:center;">
            Frequently Asked Questions
        </h2>
        <div style="width: 80px; height: 4px; background:#007bff; margin:10px auto 30px;"></div>

        <!-- FAQ ITEM TEMPLATE -->
        <style>
            .faq-item {
                border-bottom: 1px solid #e0e0e0;
                padding: 15px 0;
                cursor: pointer;
            }
            .faq-question {
                font-weight: bold;
                color: #007bff;
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 16px;
            }
            .faq-answer {
                display: none;
                margin-top: 10px;
                color: #333;
                line-height: 1.6;
            }
            .faq-toggle {
                font-size: 22px;
                font-weight: bold;
                color: #007bff;
                transition: 0.3s;
            }
        </style>

        <script>
            function toggleFAQ(index) {
                const answer = document.getElementById('faq-answer-' + index);
                const toggle = document.getElementById('faq-toggle-' + index);

                if (answer.style.display === "block") {
                    answer.style.display = "none";
                    toggle.innerHTML = "+";
                } else {
                    answer.style.display = "block";
                    toggle.innerHTML = "-";
                }
            }
        </script>

        <!-- FAQ LIST -->
        <div>

            <!-- 1 -->
            <div class="faq-item" onclick="toggleFAQ(1)">
                <div class="faq-question">
                    Apakah aplikasi Whistleblowing System (WBS) PT Dirgantara Indonesia ?
                    <span id="faq-toggle-1" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-1" class="faq-answer">
                    Aplikasi Whistleblowing System (WBS) PT Dirgantara Indonesia adalah sistem
                    untuk mengelola pengaduan mengenai perilaku melawan hukum atau tindakan tidak etis
                    secara rahasia, anonim, dan independen untuk mengoptimalkan peran insan dan mitra kerja
                    PT Dirgantara Indonesia dalam mengungkap pelanggaran.
                </div>
            </div>

            <!-- 2 -->
            <div class="faq-item" onclick="toggleFAQ(2)">
                <div class="faq-question">
                    Apakah bentuk respon yang diberikan kepada pelapor atas pengaduan yang disampaikan ?
                    <span id="faq-toggle-2" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-2" class="faq-answer">
                    Respon yang diberikan berupa respon awal dan status/tindak lanjut terbaru.
                    Respon dapat dilihat di menu history pengaduan setelah login.
                </div>
            </div>

            <!-- 3 -->
            <div class="faq-item" onclick="toggleFAQ(3)">
                <div class="faq-question">
                    Berapa lama respon atas pengaduan yang disampaikan diberikan kepada pelapor ?
                    <span id="faq-toggle-3" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-3" class="faq-answer">
                    Respon wajib diberikan paling lambat 30 hari sejak pengaduan diterima.
                </div>
            </div>

            <!-- 4 -->
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

            <!-- 5 -->
            <div class="faq-item text-center" onclick="toggleFAQ(5)">
                <div class="faq-question">
                    Bagaimana tahapan proses pengaduan yang anda laporkan ?
                    <span id="faq-toggle-5" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-5" class="faq-answer">
                    <img src="{{ asset('images/proses_pengaduan.jpg') }}" class="w-full max-w-[500px] mx-auto" alt="Proses Pengaduan">
                </div>
            </div>

            <!-- 6 -->
            <div class="faq-item" onclick="toggleFAQ(6)">
                <div class="faq-question">
                    Apakah kerahasiaan identitas saya sebagai pengadu/pelapor terjaga?
                    <span id="faq-toggle-6" class="faq-toggle">+</span>
                </div>
                <div id="faq-answer-6" class="faq-answer">
                    -
                </div>
            </div>

        </div>

    </div>
</section>
