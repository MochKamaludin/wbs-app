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
        Schema::create('tmwblsfile', function (Blueprint $table) {
            $table->char('i_wbls', 20);
            $table->unsignedTinyInteger('i_wbls_fileseq');
            $table->string('n_wbls_file', 100);
            $table->char('c_wbls_filecateg', 1);
            $table->dateTime('d_wbls_file');
            $table->primary(['i_wbls', 'i_wbls_fileseq']);
            $table->index('i_wbls');
            $table->index('c_wbls_filecateg');

            $table->foreign('i_wbls')
                ->references('i_wbls')
                ->on('tmwbls')
                ->onDelete('cascade');

            $table->foreign('c_wbls_filecateg')
                ->references('c_wbls_filecateg')
                ->on('trwblsfilecateg')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmwblsfile');
    }
};
