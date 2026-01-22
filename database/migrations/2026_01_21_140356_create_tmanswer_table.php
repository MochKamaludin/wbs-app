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
        Schema::create('tmanswer', function (Blueprint $table) {
            $table->id('i_id_answer');
            $table->integer('i_id_yyy');
            $table->foreignId('i_id_question')
                ->constrained('trquestion', 'i_id_question')
                ->cascadeOnDelete();
            $table->foreignId('i_id_questionchoice')
                ->nullable()
                ->constrained('trquestionchoice', 'i_id_questionchoice');
            $table->text('e_answer')->nullable();
            $table->integer('i_entry');
            $table->timestamp('d_entry')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmanswer');
    }
};
