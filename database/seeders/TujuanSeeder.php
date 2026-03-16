<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tmwblspurpose')->insert([
            [
                'i_wbls_purposer' => 1,
                'n_wbls_purpose' => 'UPAYA',
                'e_wbls_purpose' => '<p>
                                    Sebagai upaya pengungkapan pelanggaran di Perusahaan yang tidak sesuai dengan standar 
                                    etika dan hukum, serta untuk menangani masalah pelanggaran secara internal terlebih dahulu, 
                                    sebelum meluas menjadi masalah pelanggaran yang bersifat publik.
                                    </p>',
                'c_wbls_purposeord' => '1',
                'f_wbls_purposestat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_purpose' => now(), 
            ],
            [
                'i_wbls_purposer' => 2,
                'n_wbls_purpose' => 'ACUAN',
                'e_wbls_purpose' => '<p>
                                        Sebagai acuan dalam tata cara pengelolaan penanganan pengaduan/penyingkapan (Whistleblowing System) 
                                        bagi Dewan Komisaris, Direksi, Insan PT Dirgantara Indonesia (Persero), serta pihak yang berkepentingan 
                                        dalam menjalin hubungan kerja sama dengan Perusahaan.
                                    </p>',
                'c_wbls_purposeord' => '2',
                'f_wbls_purposestat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_purpose' => now(), 
            ],
            [
                'i_wbls_purposer' => 3,
                'n_wbls_purpose' => 'MENGURANGI RESIKO',
                'e_wbls_purpose' => '<p>
                                    Timbulnya keengganan dari Insan PTDI untuk melakukan pelanggaran dan Mengurangi risiko yang dihadapi organisasi, 
                                    akibat dari pelanggaran baik dari segi keuangan, operasi, hukum, keselamatan kerja, dan reputasi.
                                    </p>',
                'c_wbls_purposeord' => '2',
                'f_wbls_purposestat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_purpose' => now(), 
            ],
        ]);
    }
}
