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
        Schema::table('trquestion', function (Blueprint $table) {
            $table->string('c_wbls_categ', 1)
                ->after('i_id_question')
                ->comment('Kategori WBS');

            $table->foreign('c_wbls_categ')
                ->references('c_wbls_categ')
                ->on('trwblscateg');
        });

        Schema::table('trquestion', function (Blueprint $table) {
            $table->dropColumn('i_id_xxx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trquestion', function (Blueprint $table) {
            $table->integer('i_id_xxx')->nullable();

            $table->dropForeign(['c_wbls_categ']);
            $table->dropColumn('c_wbls_categ');
        });
    }
};
