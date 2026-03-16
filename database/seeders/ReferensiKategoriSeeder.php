<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferensiKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trwblscateg')->insert([
            [
                'c_wbls_categ' => 1,
                'n_wbls_categ' => 'Korupsi',
                'e_wbls_categ' => '<p>Penyalahgunaan jabatan untuk keuntungan pribadi/ kelompok.</p>',
            ],
            [
                'c_wbls_categ' => 2,
                'n_wbls_categ' => 'Suap',
                'e_wbls_categ' => '<p>Pemberian/ imbalan untuk memengaruhi keputusan atau tindakan.</p>',
            ],
            [
                'c_wbls_categ' => 3,
                'n_wbls_categ' => 'Gratifikasi',
                'e_wbls_categ' => '<p>Pemberian terkait jabatan yang berpotensi konflik kepentingan.</p>',
            ],
            [
                'c_wbls_categ' => 4,
                'n_wbls_categ' => 'Benturan Kepentingan',
                'e_wbls_categ' => '<p>Situasi saat kepentingan pribadi pengaruhi tugas jabatan.</p>',
            ],
            [
                'c_wbls_categ' => 5,
                'n_wbls_categ' => 'Pencurian',
                'e_wbls_categ' => '<p>Mengambil barang milik orang lain tanpa izin secara melawan hukum.</p>',
            ],
            [
                'c_wbls_categ' => 6,
                'n_wbls_categ' => 'Kecurangan (Fraud)',
                'e_wbls_categ' => '<p>Tindakan curang untuk memperoleh keuntungan tidak sah.</p>',
            ],
            [
                'c_wbls_categ' => 7,
                'n_wbls_categ' => 'Pelanggaran  Hukum / peraturan / kebijakan / prosedur perusahaan',
                'e_wbls_categ' => '<p>Tindakan tidak patuh pada aturan berlaku.</p>',
            ],
            [
                'c_wbls_categ' => 8,
                'n_wbls_categ' => 'dan lain lain (free text)',
                'e_wbls_categ' => '<p>Perihal yang dilakukan adalah pelanggaran lain yang tidak ada dalam pilihan</p>',
            ],
        ]);
    }
}
