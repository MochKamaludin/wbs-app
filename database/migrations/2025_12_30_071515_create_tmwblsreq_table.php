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
        Schema::create('tmwblsreq', function (Blueprint $table) {
            $table->id('i_wbls_req');

            $table->string('n_wbls_req', 100);
            $table->string('e_wbls_req', 2000);
            $table->char('c_wbls_reqord', 1)->nullable();

            $table->char('f_wbls_reqstat', 1)->default('0'); 

            $table->string('i_wbls_adm', 20);
            $table->dateTime('d_entry');

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
        Schema::dropIfExists('tmwblsreq');
    }
};
