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
        Schema::create('company_financials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->unsignedBigInteger('phase_id');
            $table->foreign('phase_id')->references('id')->on('phases');
            $table->decimal('total_sanctioned_amount', 20, 2)->nullable();
            $table->integer('total_installments')->nullable();
            $table->decimal('installment_markup_percentage', 20, 2)->nullable();
            $table->decimal('installment_amount', 20, 2)->nullable();
            $table->integer('installment_total_months')->nullable();
            $table->boolean('is_sanctioned_by_kcbl')->default(0);
            $table->boolean('is_completed_by_kcbl')->default(0);
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
        Schema::dropIfExists('company_financials');
    }
};
