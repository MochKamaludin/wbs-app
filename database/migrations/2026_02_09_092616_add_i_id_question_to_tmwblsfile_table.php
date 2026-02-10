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
        Schema::table('tmwblsfile', function (Blueprint $table) {
            $table->unsignedBigInteger('i_id_question')
                ->nullable()
                ->after('i_wbls');
            $table->foreign('i_id_question')
                ->references('i_id_question')
                ->on('trquestion')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmwblsfile', function (Blueprint $table) {
            $table->dropForeign(['i_id_question']);
            $table->dropColumn('i_id_question');
        });
    }
};
