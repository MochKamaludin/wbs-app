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
        Schema::create('trquestion', function (Blueprint $table) {
            $table->id('i_id_question');
            $table->integer('i_id_xxx');
            $table->integer('c_question')->comment('1 Field, 2 Radio, 3 Textarea, 4 Radio+Textarea, 5 Dropdown, 6 Currency, 7 File');
            $table->integer('i_question_sort');
            $table->text('n_question');
            $table->boolean('f_required')->default(true);
            $table->boolean('f_active')->default(true);
            $table->integer('i_entry');
            $table->timestamp('d_entry')->useCurrent();
            $table->integer('i_update')->nullable();
            $table->timestamp('d_update')->nullable();

            $table->unique(['i_id_xxx', 'i_question_sort']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trquestion');
    }
};
