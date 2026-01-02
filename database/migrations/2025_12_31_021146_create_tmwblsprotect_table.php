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
        Schema::create('tmwblsprotect', function (Blueprint $table) {
            $table->increments('i_wbls_protect');
            $table->string('n_wbls_protect', 100);
            $table->text('e_wbls_protect');
            $table->char('c_wbls_protectord', 1)->nullable();
            $table->char('f_wbls_protectstat', 1)->default('0');
            $table->string('i_wbls_adm', 20);
            $table->dateTime('d_wbls_protect');

            $table->foreign('i_wbls_adm')
                ->references('i_wbls_adm')
                ->on('trwblsadm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmwblsprotect');
    }
};
