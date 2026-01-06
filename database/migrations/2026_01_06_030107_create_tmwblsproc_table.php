<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tmwblsproc', function (Blueprint $table) {
            $table->id('i_wbls_proc'); 
            $table->string('n_wbls_proc', 100); 
            $table->text('e_wbls_proc'); 
            $table->char('c_wbls_procord', 2)->nullable();
            $table->char('f_wbls_procstat', 1)->default('1');
            $table->string('i_wbls_adm', 20)->nullable();
            $table->dateTime('d_wbls_proc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmwblsproc');
    }
};
