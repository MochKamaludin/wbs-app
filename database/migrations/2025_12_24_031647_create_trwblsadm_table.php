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
        Schema::create('trwblsadm', function (Blueprint $table) {
            $table->string('i_wbls_adm', 20)->primary(); 
            $table->string('c_wbls_admpswd', 100);      
            $table->string('n_wbls_adm', 200);          
            $table->string('i_emp', 6)->nullable();     
            $table->string('c_wbls_admauth', 1);        
            $table->string('i_entry', 20)->nullable();  
            $table->dateTime('d_entry')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trwblsadm');
    }
};
