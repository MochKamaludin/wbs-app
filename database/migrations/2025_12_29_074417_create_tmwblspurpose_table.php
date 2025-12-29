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
        Schema::create('tmwblspurpose', function (Blueprint $table) {
            $table->id('i_wbls_purpose');
            $table->string('n_wbls_purpose', 100);
            $table->string('e_wbls_purpose', 2000);
            $table->char('c_wbls_purposeord', 1)->nullable();
            $table->char('f_wbls_purposestat', 1)->default('0'); // 0=off, 1=publish
            $table->string('i_wbls_adm', 20);
            $table->timestamp('d_wbls_purpose');

            $table->foreign('i_wbls_adm')->references('i_wbls_adm')->on('trwblsadm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmwblspurpose');
    }
};
