<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tmwblsfaq')->insert([
            [
                'i_wbls_faq' => 1,
                'e_wbls_faqquest' => 'Apakah aplikasi Whistleblowing System (WBS) PT Dirgantara Indonesia?',
                'e_wbls_faqans' => '<p>
                                    Aplikasi Whistleblowing System (WBS) PT Dirgantara Indonesia adalah sistem untuk mengelola 
                                    pengaduan mengenai perilaku melawan hukum atau tindakan tidak etis secara rahasia, anonim, 
                                    dan independen untuk mengoptimalkan peran insan dan mitra kerja PT Dirgantara Indonesia dalam mengungkap pelanggaran.
                                    </p>',
                'i_wbls_faqseq' => '1',
                'i_wbls_adm' => null,
                'f_wbls_faqstat' => '1',
                'd_wbls_faq' => now(),
            ],
            [
                'i_wbls_faq' => 2,
                'e_wbls_faqquest' => 'Apakah bentuk respon yang diberikan kepada pelapor atas pengaduan yang disampaikan?',
                'e_wbls_faqans' => '<p>
                                    Respon yang diberikan berupa respon awal dan status/tindak lanjut terbaru. Respon dapat dilihat 
                                    di menu history pengaduan setelah login.
                                    </p>',
                'i_wbls_faqseq' => '2',
                'i_wbls_adm' => null,
                'f_wbls_faqstat' => '1',
                'd_wbls_faq' => now(),
            ],
            [
                'i_wbls_faq' => 3,
                'e_wbls_faqquest' => 'Berapa lama respon atas pengaduan yang disampaikan diberikan kepada pelapor?',
                'e_wbls_faqans' => '<p>
                                    Respon wajib diberikan paling lambat 30 hari sejak pengaduan diterima.
                                    </p>',
                'i_wbls_faqseq' => '3',
                'i_wbls_adm' => null,
                'f_wbls_faqstat' => '1',
                'd_wbls_faq' => now(),
            ],
            [
                'i_wbls_faq' => 4,
                'e_wbls_faqquest' => 'Apakah pengaduan yang saya berikan akan selalu mendapatkan respon?',
                'e_wbls_faqans' => '<p>
                                    Ya, setiap pengaduan akan direspon dan diperbarui otomatis dalam aplikasi WBS. Untuk melihat respon, 
                                    Anda harus login dan membuka history pengaduan sesuai nomor register. Pengaduan yang lengkap 
                                    (what, where, when, who, how) lebih mudah diproses.
                                    </p>',
                'i_wbls_faqseq' => '4',
                'i_wbls_adm' => null,
                'f_wbls_faqstat' => '1',
                'd_wbls_faq' => now(),
            ],
            [
                'i_wbls_faq' => 5,
                'e_wbls_faqquest' => 'Apakah kerahasiaan identitas saya sebagai pengadu/pelapor terjaga?',
                'e_wbls_faqans' => '<p>
                                    Identitas pelapor dijamin kerahasiaannya sesuai dengan kebijakan Whistleblowing System.
                                    </p>',
                'i_wbls_faqseq' => '5',
                'i_wbls_adm' => null,
                'f_wbls_faqstat' => '1',
                'd_wbls_faq' => now(),
            ],
            [
                'i_wbls_faq' => 6,
                'e_wbls_faqquest' => 'Bagaimana tahapan proses pengaduan yang anda laporkan?',
                'e_wbls_faqans' => null,
                'i_wbls_faqseq' => '6',
                'i_wbls_adm' => null,
                'f_wbls_faqstat' => '1',
                'd_wbls_faq' => now(),
            ],
        ]);
    }
}
