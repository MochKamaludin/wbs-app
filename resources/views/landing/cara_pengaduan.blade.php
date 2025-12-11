<section id="cara_pengaduan" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto text-center px-6">

        {{-- Judul --}}
        <h4 class="text-3xl font-bold mb-2">Cara Pengaduan</h4>
        <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>

        <!-- NAVIGATION STEPS -->
        <div class="cara-nav" 
             style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 30px;">
            
            <button class="step-btn active" data-step="1">Step#1</button>
            <button class="step-btn" data-step="2">Step#2</button>
            <button class="step-btn" data-step="3">Step#3</button>
            <button class="step-btn" data-step="4">Step#4</button>
            <button class="step-btn" data-step="5">Step#5</button>
            <button class="step-btn" data-step="6">Step#6</button>
            <button class="step-btn" data-step="7">Step#7</button>
            <button class="step-btn" data-step="8">Step#8</button>
            <button class="step-btn" data-step="9">Step#9</button>
            <button class="step-btn" data-step="10">Step#10</button>
        </div>

        <!-- CONTENT BOX -->
        <div id="step-content" 
             style="background: #f9f9f9; padding: 25px; border-radius: 10px; text-align: left; font-size: 15px; color: #444; line-height: 1.7;">
            
            <!-- Default Content Step 1 -->
            <h3 style="font-size: 18px; font-weight: bold;">1. Daftar</h3>
            <p>
                Jika Anda belum terdaftar, klik menu <b>Pengaduan</b> kemudian pilih <b>Registrasi</b> 
                dan isikan data diri Anda. Setelah klik tombol <b>"Kirim"</b>, Anda akan menerima verifikasi dan password
                melalui email yang Anda daftarkan.<br><br>
                Setelah berhasil, untuk keamanan dan kerahasiaan, segera lakukan penggantian password akun Anda.
            </p>
        </div>

    </div>
</section>


<!-- STEP CONTENT SCRIPT -->
<script>
    const stepContents = {
        1: {
            title: "1. Daftar",
            text: `Jika Anda belum terdaftar, klik menu <b>Pengaduan</b> sub menu <b>Registrasi</b> dan isikan data diri Anda lalu klik tombol "Kirim". 
                   Anda akan menerima verifikasi dan password via email.<br><br>
                   Setelah berhasil, segera lakukan <b>ubah password</b> untuk keamanan akun Anda.`
        },
        2: {
            title: "2. Login",
            text: `Klik tombol <b>"Login"</b>, lalu isikan Username dan Password Anda untuk masuk ke sistem.`
        },
        3: {
            title: "3. Pengaduan",
            text: `Klik sub menu <b>"Tulis Pengaduan"</b> untuk mulai membuat laporan pengaduan baru.`
        },
        4: {
            title: "4. Tambah Pengaduan",
            text: `Klik tombol <b>"Tambah Pengaduan"</b> untuk menambahkan pengaduan baru.  
                   Setelah membaca dan menyetujui kesepakatan yang tersedia, klik <b>"Setuju"</b>.`
        },
        5: {
            title: "5. Isi Form",
            text: `Isi form <b>Tambah Pengaduan</b> sesuai informasi yang Anda ketahui.`
        },
        6: {
            title: "6. Mandatori",
            text: `Semua kotak yang diberi tanda (*) wajib diisi. Pastikan informasi yang diberikan sedapat mungkin 
                    memenuhi unsur 4W + 1H yaitu menjelaskan siapa, melakukan apa, kapan, di mana, mengapa dan 
                    bagaimana. Lingkup Pengaduan yang akan ditindaklanjuti adalah tindakan yang dapat merugikan 
                    Perusahaan, meliputi sebagai berikut: Penyimpangan dari peraturan dan perundangan yang berlaku, 
                    Penyalahgunaan jabatan untuk kepentingan lain di luar Perusahaan, Pemerasan, Perbuatan curang, 
                    Benturan Kepentingan, Gratifikasi.`
        },
        7: {
            title: "7. Lampirkan Bukti",
            text: `Jika Anda memiliki bukti pendukung berupa foto, dokumen, atau file lainnya, silakan lampirkan pada halaman pengaduan.`
        },
        8: {
            title: "8. Kirim / Hapus",
            text: `Setelah selesai mengisi form, klik <b>"Kirim"</b> untuk melanjutkan proses pelaporan atau klik <b>"Hapus"</b> 
                   untuk membatalkan pembuatan pengaduan.`
        },
        9: {
            title: "9. Ingat Data Saat Login",
            text: `Catat dan simpan dengan baik <b>Nama Samaran (username)</b> dan <b>Kata Sandi</b>.  
                   Tim WBS PT Dirgantara Indonesia akan memberikan catatan atau menghubungi Anda melalui email apabila 
                   laporan Anda memerlukan klarifikasi lebih lanjut.`
        },
        10: {
            title: "10. Lupa Password",
            text: `Jika Anda pernah mendaftar namun lupa Username atau Password, klik <b>"Lupa Password"</b> pada menu login.`
        }
    };

    document.querySelectorAll(".step-btn").forEach(btn => {
        btn.addEventListener("click", function () {

            document.querySelectorAll(".step-btn").forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            const step = this.getAttribute("data-step");

            const box = document.getElementById("step-content");
            box.innerHTML = `
                <h3 style="font-size: 18px; font-weight: bold;">${stepContents[step].title}</h3>
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
