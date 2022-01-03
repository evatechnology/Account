<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('company_id');
            // $table->unsignedInteger('position_id');
            $table->unsignedInteger('employee_id');
            $table->double('amount',10,2)->nullable();
            $table->string('reason')->nullable();
            $table->date('date')->nullable();
            // $table->foreign('company_id')->references('id')->on('clientcompany')->onDelete('cascade');
            // $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
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
        Schema::dropIfExists('payrolls');
    }
}
