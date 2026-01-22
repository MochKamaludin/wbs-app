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
        Schema::create('trquestionchoice', function (Blueprint $table) {
            $table->id('i_id_questionchoice');
            $table->foreignId('i_id_question')
                ->constrained('trquestion', 'i_id_question')
                ->cascadeOnDelete();
            $table->integer('i_choice_sort');
            $table->text('n_choice');
            $table->boolean('f_active')->default(true);
            $table->integer('i_entry');
            $table->timestamp('d_entry')->useCurrent();
            $table->integer('i_update')->nullable();
            $table->timestamp('d_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trquestionchoice');
    }
};
