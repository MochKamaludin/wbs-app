<section id="tulis_pengaduan" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto text-center px-6">
        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Tulis Pengaduan</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
        <form action="" class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-lg space-y-5">

            <div>
                <label for="nama" class="block font-medium text-gray-700 mb-1 text-left">Nama</label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Masukkan nama Anda">
            </div>

            <div>
                <label for="alamat" class="block font-medium text-gray-700 mb-1 text-left">Alamat</label>
                <input 
                    type="text" 
                    id="alamat" 
                    name="alamat" 
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Masukkan alamat">
            </div>

            <div>
                <label for="tanggal" class="block font-medium text-gray-700 mb-1 text-left">Tanggal</label>
                <input 
                    type="date" 
                    id="tanggal" 
                    name="tanggal"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Submit
            </button>

        </form>

    </div>
</section>
