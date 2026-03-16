<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'i_wbls_adm' => 'admin',
            'c_wbls_admpswd' => bcrypt('ChangeMe123!'),
            'n_wbls_adm' => 'Admin User',
            'i_emp' => null,
            'c_wbls_admauth' => null,
            'i_entry' => null,
            'd_entry' => now(),
        ]);
    }
}
