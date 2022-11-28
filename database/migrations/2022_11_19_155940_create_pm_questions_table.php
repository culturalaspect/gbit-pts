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
        Schema::create('pm_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('measure_id');
            $table->foreign('measure_id')->references('id')->on('performance_measures');
            $table->text('question');
            $table->integer('question_type')->default(0);
            $table->boolean('is_required')->default(0);
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
        Schema::dropIfExists('pm_questions');
    }
};
