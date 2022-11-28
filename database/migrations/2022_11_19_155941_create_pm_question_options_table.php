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
        Schema::create('pm_question_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pm_question_id');
            $table->foreign('pm_question_id')->references('id')->on('pm_questions');
            $table->string('option_text');
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
        Schema::dropIfExists('pm_question_options');
    }
};
