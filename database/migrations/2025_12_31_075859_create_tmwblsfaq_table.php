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
        Schema::create('tmwblsfaq', function (Blueprint $table) {
            $table->id('i_wbls_faq');        
            $table->string('e_wbls_faqquest', 100);           
            $table->text('e_wbls_faqans', 4000);                    
            $table->string('i_wbls_faqseq', 3)->nullable();   
            $table->string('i_wbls_adm', 20);                
            $table->string('f_wbls_faqstat', 1)->default('0');  
            $table->dateTime('d_wbls_faq');                   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmwblsfaq');
    }
};
