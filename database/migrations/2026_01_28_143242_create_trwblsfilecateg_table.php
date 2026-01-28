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
        Schema::create('trwblsfilecateg', function (Blueprint $table) {
            $table->char('c_wbls_filecateg', 1)->primary();
            $table->string('n_wbls_filecateg', 20);
            $table->string('e_wbls_filecateg', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trwblsfilecateg');
    }
};
