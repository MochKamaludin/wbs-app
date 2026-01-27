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
        Schema::create('tmwbls', function (Blueprint $table) {
            $table->char('i_wbls', 20)->primary()
                ->comment('Nomor WBS (WBS/AAAA/PTD/MM/YYYY)');

            $table->integer('i_wbls_seq')
                ->comment('Nomor urut WBS');

            $table->char('c_wbls_categ', 1)
                ->comment('Perihal WBS');

            $table->string('e_wbls', 2000)->nullable()
                ->comment('Uraian WBS');

            $table->string('d_wbls_incident', 500)->nullable()
                ->comment('Perkiraan waktu kejadian');

            $table->char('c_wbls_stat', 1)
                ->comment('Status pelaporan');

            $table->string('e_wbls_stat', 2000)->nullable()
                ->comment('Keterangan status');

            $table->dateTime('d_wbls_check')->nullable()
                ->comment('Tanggal diperiksa admin');

            $table->string('i_wbls_adm', 20)->nullable()
                ->comment('Admin pemeriksa');

            $table->dateTime('d_wbls')
                ->comment('Tanggal laporan');

            $table->dateTime('d_entry')
                ->useCurrent()
                ->comment('Tanggal input/update');

            $table->string('c_wbls_statusupd', 50)->nullable()
                ->comment('Kode status diperbaiki');

            $table->dateTime('d_wbls_statupd')->nullable()
                ->comment('Tanggal status diperbaiki');

            $table->char('f_wbls_agree', 1)->nullable()
                ->comment('Flag persetujuan (1=agree)');

            $table->foreign('c_wbls_categ')
                ->references('c_wbls_categ')
                ->on('trwblscateg');

            $table->foreign('c_wbls_stat')
                ->references('c_wbls_stat')
                ->on('trwblsstat');

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
        Schema::dropIfExists('tmwbls');
    }
};
