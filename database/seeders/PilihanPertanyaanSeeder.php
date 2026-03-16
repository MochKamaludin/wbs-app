<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilihanPertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trquestionchoice')->insert([

            ['i_id_questionchoice'=>1,'i_id_question'=>1,'i_choice_sort'=>1,'n_choice'=>'Penggelapan','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_questionchoice'=>2,'i_id_question'=>1,'i_choice_sort'=>2,'n_choice'=>'Markup','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_questionchoice'=>3,'i_id_question'=>1,'i_choice_sort'=>3,'n_choice'=>'Penyalahgunaan anggaran','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

            ['i_id_questionchoice'=>4,'i_id_question'=>3,'i_choice_sort'=>1,'n_choice'=>'Ya','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_questionchoice'=>5,'i_id_question'=>3,'i_choice_sort'=>2,'n_choice'=>'Tidak','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

            ['i_id_questionchoice'=>6,'i_id_question'=>5,'i_choice_sort'=>1,'n_choice'=>'Ya','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_questionchoice'=>7,'i_id_question'=>5,'i_choice_sort'=>2,'n_choice'=>'Tidak','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

            ['i_id_questionchoice'=>8,'i_id_question'=>7,'i_choice_sort'=>1,'n_choice'=>'Ada','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],
            ['i_id_questionchoice'=>9,'i_id_question'=>7,'i_choice_sort'=>2,'n_choice'=>'Tidak','f_active'=>1,'i_wbls_adm'=>'admin@mail.com','d_entry'=>now(),'i_update'=>null,'d_update'=>null],

        ]);
    }
}