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
        Schema::create('tmwblsvrf', function (Blueprint $table) {
            $table->id();
            $table->char('i_wbls', 20);
            $table->string('i_wbls_adm', 20)->nullable();
            $table->dateTime('d_wbls_vrf')->nullable();
            $table->char('f_wbls_usrname', 1)->nullable(); 
            $table->char('f_wbls_file', 1)->nullable();    
            $table->integer('i_wbls_bavrfseq')->nullable();
            $table->string('i_wbls_bavrf', 21)->nullable();

            $table->foreign('i_wbls')
                ->references('i_wbls')
                ->on('tmwbls')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmwblsvrf');
    }
};
