<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DefinisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tmwblsabout')->insert([
            [
            'i_wbls_about' => 1,
            'n_wbls_about' => 'Whistleblowing System',
            'e_wbls_about' => '<p>
                                Whistleblowing System/ Pelaporan Pelanggaran/ Pengaduan adalah aplikasi yang disediakan
                                 oleh Satuan Pengawasan Intern PT Dirgantara Indonesia bagi Anda yang memiliki informasi
                                  dan ingin melaporkan suatu perbuatan berindikasi pelanggaran yang terjadi di lingkungan 
                                  PT Dirgantara Indonesia. Anda tidak perlu khawatir terungkapnya identitas diri anda karena 
                                  Tim Whistleblowing System PT Dirgantara Indonesia akan <strong>MERAHASIAKAN IDENTITAS DIRI 
                                  ANDA sebagai PELAPOR</strong>. PT Dirgantara Indonesia menghargai informasi yang Anda laporkan. 
                                  Fokus kami kepada materi informasi yang Anda Laporkan dengan tujuan sebagai berikut :
                                    </p>',
            'i_wbls_adm' => null,
            'd_wbls_about' => now(),
            ],
            [
            'i_wbls_about' => 2,
            'n_wbls_about' => 'Kapan WBS Dapat Digunakan?',
            'e_wbls_about' => '<p>
                                Pelaporan Pelanggaran dengan menggunakan WBS digunakan apabila pengaduan atau penyimpangan 
                                melalui jalur formal (melalui atasan langsung atau fungsi terkait yaitu Divisi SDM dan SPI) 
                                dianggap tidak efektif atau ada keraguan (kerahasiaan dan tindak lanjutnya), maka Pelapor dapat 
                                menyampaikan pengaduan melalui Sistem Pelaporan Pelanggaran (Whistleblowing System).
                                </p>',
            'i_wbls_adm' => null,
            'd_wbls_about' => now(),
            ],
            [
            'i_wbls_about' => 3,
            'n_wbls_about' => 'Dasar WBS',
            'e_wbls_about' => '<ol start="1">
                                <li><p>Undang-Undang Nomor 28 Tahun 1999</p></li>
                                <li><p>Undang-Undang Nomor 31 Tahun 1999</p></li>
                                <li><p>Undang-Undang Nomor 19 Tahun 1999</p></li>
                                <li><p>Undang-Undang Nomor 13 Tahun 1999</p></li>
                                <li><p>Undang-Undang Nomor 40 Tahun 2007</p></li>
                                <li><p>Peraturan Pemerintah Nomor 45 Tahun 2005</p></li>
                                <li><p>Peraturan Menteri Badan Usaha Milik Negara Nomor PER-01/MBU/2011 tanggal 1 Agustus 2011</p></li>
                                <li><p>Keputusan Sekretaris Kementerian Badan Usaha Milik Negara Nomor: SK-16/S-MBU/2012 tanggal 6 Juni 2012</p></li>
                                <li><p>Perjanjian Kerja Bersama PT Dirgantara Indonesia (Persero) dengan Serikat pekerja Periode Tahun 2020, tanggal 03 Januari 2020</p></li>
                                <li><p>Boad Manual PT Dirgantara Indonesia (Persero), Nomor: 08-ML-0050 tentang Pedoman Perilaku dan Etika Bisnis (<em>Code of Conduct</em>) tahun 2020</p></li>
                                <li><p>Surat Keputusan Direksi PT Dirgantara Indonesia (PERSERO) Nomor: SKEP/653/030.02/UT0000/PTD/08/2019, tanggal 01 Agustus 2019, perihal Pedoman Sistem Pelaporan Pelanggaran ( <em>WHISTLEBLOWING SYSTEM</em>)</p></li>
                                </ol>',
            'i_wbls_adm' => null,
            'd_wbls_about' => now(),
            ],
            [
            'i_wbls_about' => 4,
            'n_wbls_about' => 'Kesepakatan Tertulis dengan Pelapor (Ketentuan & Kebijakan Pelaporan)',
            'e_wbls_about' => '<ol start="1">
                                <li><p>Pelaporan ini saya buat atas itikad baik...</p></li>
                                <li><p>Apabila saya melihat dan mendengar...</p></li>
                                <li><p>Saya bersedia memberi bukti...</p></li>
                                <li><p>Dalam melakukan proses tindak lanjut...</p></li>
                                <li><p>Saya paham apabila laporan saya..</p></li>
                                <li><p>Pengaduan ini...</p></li>
                                </ol>',
            'i_wbls_adm' => null,
            'd_wbls_about' => now(),
            ],
        ]);


    }
}
