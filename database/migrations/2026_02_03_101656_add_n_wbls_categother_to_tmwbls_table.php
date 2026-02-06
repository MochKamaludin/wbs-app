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
        Schema::table('tmwbls', function (Blueprint $table) {
            $table->string('n_wbls_categother')
                ->nullable()
                ->after('c_wbls_categ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tmwbls', function (Blueprint $table) {
            $table->dropColumn('n_wbls_categother');
        });
    }
};
