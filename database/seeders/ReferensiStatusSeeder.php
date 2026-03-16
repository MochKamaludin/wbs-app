<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferensiStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trwblsstat')->insert([
            [
                'c_wbls_stat' => 1,
                'n_wbls_stat' => 'Belum Diperiksa',
                'e_wbls_stat' => '<p>Status pelaporan perlanggaran adalah belum diperiksa</p>',
            ],
            [
                'c_wbls_stat' => 2,
                'n_wbls_stat' => 'Perbaiki Laporan',
                'e_wbls_stat' => '<p>Status pelaporan pelanggran adalah perbaiki laporan</p>',
            ],
            [
                'c_wbls_stat' => 3,
                'n_wbls_stat' => 'Laporan Ditolak',
                'e_wbls_stat' => '<p>Status pelaporan pelanggaran adalah laporan ditolak</p>',
            ],
            [
                'c_wbls_stat' => 4,
                'n_wbls_stat' => 'Dalam Pemeriksaan',
                'e_wbls_stat' => '<p>Status dari pelaporan pelanggaran adalah dalam pemeriksaan</p>',
            ],
            [
                'c_wbls_stat' => 5,
                'n_wbls_stat' => 'Sudah Selesai dan Terlapor Terbukti Bersalah',
                'e_wbls_stat' => '<p>Status dari pelaporan pelanggran adalah  Sudah Selesai dan Terlapor Terbukti Bersalah</p>',
            ],
            [
                'c_wbls_stat' => 6,
                'n_wbls_stat' => 'Sudah Selesai dan Terlapor Tidak Terbukti Bersalah',
                'e_wbls_stat' => '<p>Sudah Selesai dan Terlapor Tidak Terbukti Bersalah</p>',
            ],
        ]);
    }
}
