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
        Schema::table('tmanswer', function (Blueprint $table) {
            $table->char('i_wbls', 20)
                ->after('i_id_answer')
                ->comment('Nomor WBS');

            $table->foreign('i_wbls')
                ->references('i_wbls')
                ->on('tmwbls');
        });

        Schema::table('tmanswer', function (Blueprint $table) {
            $table->dropColumn('i_id_yyy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmanswer', function (Blueprint $table) {
            $table->integer('i_id_yyy')->nullable();

            $table->dropForeign(['i_wbls']);
            $table->dropColumn('i_wbls');
        });
    }
};
