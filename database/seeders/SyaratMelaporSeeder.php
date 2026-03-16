<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyaratMelaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tmwblsreq')->insert([
            [
                'i_wbls_req' => 1,
                'n_wbls_req' => 'Identitas Diri',
                'e_wbls_req' => '<p>
                                Pelapor dalam menyampaikan Pelaporan Pelanggaran (Whistleblowing) dapat mencantumkan identitas data diri :<br>
                                </p>
                                <ol start="1">
                                <li><p>Alamat rumah/kantor,</p></li><li><p>Alamat e-mail,</p></li>
                                <li><p>Faksimile,</p></li><li><p>Nomor kontak yang dapat dihubungi, atau</p></li>
                                <li><p>Dapat juga tanpa mencantumkan data diri (anonim);</p></li>
                                </ol>
                                <p>
                                Catatan: Penyampaian laporan secara anonim tetap akan diterima, tetapi terdapat beberapa hal yang perlu menjadi 
                                perhatian terkait dengan kesulitan untuk melakukan komunikasi, konfirmasi atau klarifikasi dalam rangka tindak 
                                lanjut penanganan laporan pelanggaran tersebut.
                                </p>',
                'c_wbls_reqord' => '1',
                'f_wbls_reqstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_req' => now(),
            ],
            [
                'i_wbls_req' => 2,
                'n_wbls_req' => 'Bukti Pendukung',
                'e_wbls_req' => '<p>
                                Harus disertai dengan bukti pendukung atas laporan pelanggaran yang disampaikannya, meliputi :<br>
                                </p>
                                <ol start="1">
                                <li><p>Pokok masalah yang diadukan,</p></li><li><p>Pihak-pihak yang terlibat yaitu siapa saja yang 
                                terlibat dalam pelanggaran yang diadukan termasuk pihak-pihak yang dirugikan/diuntungkan dari kasus yang terjadi,</p></li>
                                <li><p>Waktu dan Lokasi kejadian yaitu kapan kasus pelanggaran terjadi dan di unit/fungsi mana di Perusahaan kasus 
                                pelanggaran yang diadukan terjadi,</p></li><li><p>Kronologis kasus,</p></li><li><p>Dokumen pendukung atas kasus yang diadukan.</p></li>
                                </ol>',
                'c_wbls_reqord' => '2',
                'f_wbls_reqstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_req' => now(),
            ],
        ]);
    }
}
