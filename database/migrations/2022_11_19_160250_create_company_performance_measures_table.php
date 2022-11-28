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
        Schema::create('company_performance_measures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('measure_id');
            $table->foreign('measure_id')->references('id')->on('performance_measures');
            $table->unsignedBigInteger('phase_id');
            $table->foreign('phase_id')->references('id')->on('phases');
            $table->integer('total_employees')->nullable();
            $table->decimal('total_revenue', 20, 2)->nullable();
            $table->decimal('total_profit', 20, 2)->nullable();
            $table->decimal('total_amount_utilized', 20, 2)->nullable();
            $table->boolean('is_completed')->default(0);
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
        Schema::dropIfExists('company_performance_measures');
    }
};
