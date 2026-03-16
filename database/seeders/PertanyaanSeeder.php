<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trquestion')->insert([

            ['i_id_question'=>1,'c_wbls_categ'=>1,'c_question'=>5,'i_question_sort'=>1,'n_question'=>'Apakah jenis korupsi yang terjadi?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>2,'c_wbls_categ'=>1,'c_question'=>6,'i_question_sort'=>2,'n_question'=>'Perkiraan nilai kerugian perusahaan?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>3,'c_wbls_categ'=>1,'c_question'=>4,'i_question_sort'=>3,'n_question'=>'Apakah melibatkan pejabat tertentu?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>4,'c_wbls_categ'=>1,'c_question'=>7,'i_question_sort'=>4,'n_question'=>'Upload bukti pendukung korupsi','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

            ['i_id_question'=>5,'c_wbls_categ'=>2,'c_question'=>2,'i_question_sort'=>1,'n_question'=>'Apakah terjadi pemberian uang/barang?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>6,'c_wbls_categ'=>2,'c_question'=>6,'i_question_sort'=>2,'n_question'=>'Nilai suap yang diberikan/diterima?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>7,'c_wbls_categ'=>2,'c_question'=>4,'i_question_sort'=>3,'n_question'=>'Apakah ada kesepakatan tertentu?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>8,'c_wbls_categ'=>2,'c_question'=>7,'i_question_sort'=>4,'n_question'=>'Upload bukti suap','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

            ['i_id_question'=>9,'c_wbls_categ'=>3,'c_question'=>2,'i_question_sort'=>1,'n_question'=>'Apakah gratifikasi diterima dalam jabatan?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>10,'c_wbls_categ'=>3,'c_question'=>2,'i_question_sort'=>2,'n_question'=>'Bentuk gratifikasi?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>11,'c_wbls_categ'=>3,'c_question'=>6,'i_question_sort'=>3,'n_question'=>'Nilai perkiraan gratifikasi?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>12,'c_wbls_categ'=>3,'c_question'=>7,'i_question_sort'=>4,'n_question'=>'Upload bukti gratifikasi','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

            ['i_id_question'=>13,'c_wbls_categ'=>4,'c_question'=>2,'i_question_sort'=>1,'n_question'=>'Apakah pelaku memiliki hubungan pribadi?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>14,'c_wbls_categ'=>4,'c_question'=>4,'i_question_sort'=>2,'n_question'=>'Apakah hubungan tersebut mempengaruhi keputusan?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>15,'c_wbls_categ'=>4,'c_question'=>5,'i_question_sort'=>3,'n_question'=>'Jenis hubungan?','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_question'=>16,'c_wbls_categ'=>4,'c_question'=>7,'i_question_sort'=>4,'n_question'=>'Upload bukti dokumen terkait','f_required'=>1,'f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

        ]);
    }
}
