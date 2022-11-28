<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpm_question_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cpm_id');
            $table->foreign('cpm_id')->references('id')->on('company_performance_measures');
            $table->unsignedBigInteger('pm_question_id');
            $table->foreign('pm_question_id')->references('id')->on('pm_questions');
            $table->text('pm_answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpm_question_answers');
    }
};
