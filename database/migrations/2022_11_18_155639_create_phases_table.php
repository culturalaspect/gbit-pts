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
        Schema::create('phases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('scheme_id');
            $table->foreign('scheme_id')->references('id')->on('schemes');
            $table->string('phase_name');
            $table->date('date_from');
            $table->date('date_to');
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('phases');
    }
};
