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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('project_title');
            $table->unsignedBigInteger('domain_id');
            $table->foreign('domain_id')->references('id')->on('domains');
            $table->string('other_domain')->nullable();
            $table->text('problem_statement')->nullable();
            $table->text('summary_of_solution')->nullable();
            $table->text('expected_results')->nullable();
            $table->text('organizational_expertise')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
