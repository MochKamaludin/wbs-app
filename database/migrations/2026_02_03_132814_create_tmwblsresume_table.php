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
        Schema::create('tmwblsresume', function (Blueprint $table) {
            $table->id();
            $table->char('i_wbls', 20);
            $table->string('e_wbls_resume', 2000)->nullable();
            $table->string('i_wbls_adm', 20);
            $table->dateTime('d_wbls_resume');

            $table->string('i_wbls_bainvest', 21);
            $table->integer('i_wbls_bainvestseq');
            $table->date('d_wbls_bainvest');

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
        Schema::dropIfExists('tmwblsresume');
    }
};
