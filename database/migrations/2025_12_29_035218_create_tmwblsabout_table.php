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
        Schema::create('tmwblsabout', function (Blueprint $table) {
            $table->increments('i_wbls_about');
            $table->string('n_wbls_about', 100);
            $table->string('e_wbls_about', 2000);
            $table->string('i_wbls_adm', 20);
            $table->dateTime('d_wbls_about');

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
        Schema::dropIfExists('tmwblsabout');
    }
};
