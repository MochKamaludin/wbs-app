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
        Schema::create('trwblsstat', function (Blueprint $table) {
            $table->char('c_wbls_stat', 1)->primary();
            $table->string('n_wbls_stat', 100);     
            $table->string('e_wbls_stat', 100); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trwblsstat');
    }
};
