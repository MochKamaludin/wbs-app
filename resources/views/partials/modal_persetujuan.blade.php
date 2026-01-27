<div id="modalPersetujuan"
        class="fixed inset-0 hidden flex items-center justify-center z-9999 p-4">

        <div class="bg-white w-full max-w-[600px] max-h-[85vh] overflow-y-auto rounded-xl shadow-xl p-6">

            <h2 class="text-center text-xl font-bold mb-4">
                Kesepakatan Tertulis dengan Pelapor
            </h2>

            <div class="text-sm space-y-3 leading-6">
                <p><b>1.</b> Pelaporan ini saya buat atas itikad baik...</p>
                <p><b>2.</b> Apabila saya melihat dan mendengar...</p>
                <p><b>3.</b> Saya bersedia memberi bukti...</p>
                <p><b>4.</b> Dalam melakukan proses tindak lanjut...</p>
                <p><b>5.</b> Saya paham apabila laporan saya...</p>
                <p><b>6.</b> Pengaduan ini...</p>
            </div>

            <div class="flex justify-end mt-6 gap-3">
                <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white">
                    Batal
                </button>

                <button
                    onclick="goToPengaduan()"
                    class="px-4 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600">
                    Setuju & Lanjutkan
                </button>
            </div>

        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById("modalPersetujuan");
            modal.classList.remove("hidden");
        }

        function closeModal() {
            const modal = document.getElementById("modalPersetujuan");
            modal.classList.add("hidden");
        }

        function goToPengaduan() {
            window.location.href = "{{ route('pengaduan.index') }}";
        }
        document.getElementById("btnNavbarPengaduan")
            ?.addEventListener("click", (e) => {
                e.preventDefault();
                openModal();
            });
    </script>