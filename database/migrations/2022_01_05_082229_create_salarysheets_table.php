<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarysheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarysheets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sheet_name')->nullable();
            $table->unsignedInteger('position_id');
            $table->unsignedInteger('employee_id');
            $table->string('basic')->nullable();
            // $table->double('house_rent',10,2)->nullable();
            // $table->double('medical',10,2)->nullable();
            $table->double('yearly_increment',10,2)->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('working_day')->nullable();
            $table->string('present')->nullable();
            $table->string('leave')->nullable();
            $table->string('absent')->nullable();
            $table->string('advance')->nullable();
            // $table->string('sheet_name')->nullable();

            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::dropIfExists('salarysheets');
    }
}
