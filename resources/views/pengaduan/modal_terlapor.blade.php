<div id="modalTerlapor" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded shadow-lg p-6 relative">

        <h3 class="text-lg font-bold text-center mb-4 border-b pb-2">
            Tambah Terlapor
        </h3>

        <div class="space-y-3">
            <input class="w-full border rounded px-3 py-2" placeholder="Nama Terlapor">
            <input class="w-full border rounded px-3 py-2" placeholder="Perusahaan tempat bekerja terlapor">
            <input class="w-full border rounded px-3 py-2" placeholder="Alamat terlapor">
            <input class="w-full border rounded px-3 py-2" placeholder="Nomor telepon terlapor">
        </div>

        <div class="flex justify-between mt-6">
            <div class="flex gap-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Submit
                </button>
                <button class="bg-yellow-400 px-4 py-2 rounded">
                    Reset
                </button>
            </div>
            <button onclick="closeModal()" class="bg-red-600 text-white px-4 py-2 rounded">
                Close
            </button>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalTerlapor').classList.remove('hidden');
    document.getElementById('modalTerlapor').classList.add('flex');
}

function closeModal() {
    document.getElementById('modalTerlapor').classList.add('hidden');
    document.getElementById('modalTerlapor').classList.remove('flex');
}
</script>