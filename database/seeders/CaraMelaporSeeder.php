<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaraMelaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tmwblsproc')->insert([
            [
                'i_wbls_proc' => 1,
                'n_wbls_proc' => 'DAFTAR',
                'e_wbls_proc' => '<p>
                                Jika Anda belum terdaftar, maka klik menu Pengaduan sub menu Registrasi dan isikan data diri Anda 
                                lalu klik tombol &quot;Kirim&quot;, maka Anda akan menerima verifikasi dan password via email yang didaftarkan.
                                </p>
                                <p>
                                Apabila telah berhasil, untuk menjamin keamanan dan kerahasiaan maka segera lakukan ubah password akun Anda.
                                </p>',
                'c_wbls_procord' => '1',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 2,
                'n_wbls_proc' => 'LOGIN',
                'e_wbls_proc' => '<p>Klik tombol &quot;Login&quot;, lalu isikan Username dan Password Anda.</p>',
                'c_wbls_procord' => '2',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 3,
                'n_wbls_proc' => 'PENGDUAN',
                'e_wbls_proc' => '<p>Klik sub menu &quot;Tulis Pengaduan&quot; untuk merekam pengaduan baru.</p>',
                'c_wbls_procord' => '3',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 4,
                'n_wbls_proc' => 'TAMBAH PENGDUAN',
                'e_wbls_proc' => '<p>Klik tombol &quot;Tambah Pengaduan&quot; untuk menambahkan pengaduan baru. Setelah Anda membaca dan menyetujui kesepakatan yang tertera klik &quot;setuju&quot;.</p>',
                'c_wbls_procord' => '4',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 5,
                'n_wbls_proc' => 'ISI FORM',
                'e_wbls_proc' => '<p>Isi form Tambah Pengaduan sesuai informasi yang anda ketahui.</p>',
                'c_wbls_procord' => '5',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 6,
                'n_wbls_proc' => 'MANDATORI',
                'e_wbls_proc' => '<p>
                                    Semua kotak yang diberi tanda (*) wajib diisi. Pastikan informasi yang diberikan sedapat mungkin memenuhi unsur 
                                    4W + 1H yaitu <strong><u>menjelaskan siapa, melakukan apa, kapan, di mana, mengapa dan bagaimana. </u></strong>Lingkup 
                                    Pengaduan yang akan ditindaklanjuti adalah tindakan yang dapat merugikan Perusahaan, meliputi sebagai berikut: 
                                    Penyimpangan dari peraturan dan perundangan yang berlaku, Penyalahgunaan jabatan untuk kepentingan lain di luar Perusahaan, 
                                    Pemerasan, Perbuatan curang, Benturan Kepentingan, Gratifikasi.
                                </p>',
                'c_wbls_procord' => '6',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 7,
                'n_wbls_proc' => 'LAMPIRKAN BUKTI',
                'e_wbls_proc' => '<p>Jika anda memiliki bukti dalam bentuk file seperti foto atau dokumen lain, silahkan dilengkapi di halaman pengaduan.</p>',
                'c_wbls_procord' => '7',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 8,
                'n_wbls_proc' => 'KIRIM/ HAPUS',
                'e_wbls_proc' => '<p>Setelah selesai mengisi, silahkan klik tombol &quot;Kirim&quot; untuk melanjutkan atau klik tombol &quot;Hapus&quot; untuk membatalkan proses pelaporan anda.</p>',
                'c_wbls_procord' => '8',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 9,
                'n_wbls_proc' => 'INGAT DATA SAAT LOGIN',
                'e_wbls_proc' => '<p>
                                    <strong>Catat dan simpan dengan baik Nama Samaran (username) dan Kata Sandi (password).</strong> 
                                    Tim Pengelola Whistleblowing System PT Dirgantara Indonesia akan memberikan catatan pada pelaporan 
                                    yang anda buat dalam aplikasi web (akun Anda) atau menghubungi Anda melalui email yang telah Anda 
                                    cantumkan dalam form pengaduan apabila pengaduan yang Anda sampaikan belum memenuhi kriteria untuk ditindaklanjuti.
                                </p>',
                'c_wbls_procord' => '9',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
            [
                'i_wbls_proc' => 10,
                'n_wbls_proc' => 'LUPA PASSWORD',
                'e_wbls_proc' => '<p>Bila Anda sudah pernah mendaftar namun lupa Username dan Password, klik &quot;lupa password&quot; pada sub menu (kotak log in).</p>',
                'c_wbls_procord' => '10',
                'f_wbls_procstat' => '1',
                'i_wbls_adm' => null,
                'd_wbls_proc' => now(),
            ],
        ]);
    }
}
