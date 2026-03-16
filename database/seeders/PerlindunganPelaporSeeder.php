<?php

namespace Database\Seeders;

use App\Models\PerlindunganPelapor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerlindunganPelaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PerlindunganPelapor::create([
            'i_wbls_protect' => 1,
            'n_wbls_protect' => 'Perlindungan Pelapor & Pelaksana Investigasi',
            'e_wbls_protect' => '<p>
                                Perusahaan dalam kapasitasnya secara maksimal akan memberikan perlindungan 
                                dan informasi kepada pelapor pelanggaran (whistleblower), sebagai berikut:
                                </p>
                                <ol start="1">
                                <li><p>Perlindungan kerahasiaan atas identitas Pelapor.</p></li>
                                <li><p>Perlindungan dari pemecatan, penurunan jabatan atau grade, penundaan kenaikan grade, tekanan, tindakan fisik sesuai situasi dan kondisi.</p></li>
                                <li><p>Perlindungan catatan merugikan dalam file data pribadinya (personal file record).</p></li>
                                <li><p>Informasi mengenai proses tindak lanjut yang sedang dilakukan. Informasi ini disampaikan secara rahasia kepada Pelapor.</p></li>
                                </ol>
                                <p style="text-align: justify;">
                                Poin 2 dan 3 juga berlaku bagi pihak yang melaksanakan investigasi maupun pihak-pihak yang memberikan informasi terkait pengaduan/penyingkapan.
                                </p>
                                <p style="text-align: justify;">
                                Dalam hal Pelapor merasa perlu, ia juga dapat meminta bantuan pada Lembaga Perlindungan Saksi dan Korban (LPSK).</p>
                                <p style="text-align: justify;">
                                <br>Pihak yang melanggar prinsip kerahasiaan tersebut akan diberikan sanksi yang berat sesuai ketentuan yang berlaku di perusahaan.
                                <br><br>Kebijakan perlindungan dan jaminan kerahasiaan tidak diberikan pada Pelapor yang terbukti melakukan pelaporan palsu dan/atau fitnah. 
                                Apabila hasil Investigasi Terkait Pelaporan Pelanggaran (Whistleblowing) yang disampaikan terbukti laporan palsu, fitnah, tanpa dasar yang jelas, 
                                maka Pelapor dapat digugat balik atau dikenai sanksi sesuai dengan peraturan perundangan yang berlaku terkait dengan perbuatan tidak 
                                menyenangkan atau pencemaran nama baik, serta peraturan internal perusahaan.
                                </p>',
            'c_wbls_protectord' => '1',
            'f_wbls_protectstat' => '1',
            'i_wbls_adm' => null,
            'd_wbls_protect' => now(),
        ]);
    }
}
