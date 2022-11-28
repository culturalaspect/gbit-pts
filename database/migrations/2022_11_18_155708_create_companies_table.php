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
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('ceo_name')->nullable();
            $table->string('address')->nullable();
            $table->string('cell_no')->nullable();
            $table->string('official_email')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->text('online_profile_link')->nullable();
            $table->integer('total_employees')->nullable();
            $table->decimal('total_revenue', 20, 2)->nullable();
            $table->decimal('total_profit', 20, 2)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
