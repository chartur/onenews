<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_question_id')->index();
            $table->text('hy_answer')->nullable();
            $table->text('ru_answer')->nullable();
            $table->boolean('is_right')->default(false);
            $table->timestamps();

            $table->foreign('quiz_question_id')
                ->references('id')
                ->on('quiz_questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_question_answers');
    }
}
