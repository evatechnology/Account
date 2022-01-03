<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->longText('address_present')->nullable();
            $table->longText('address_permanent')->nullable();
            $table->longText('education')->nullable();
            $table->string('gender')->nullable();
            $table->string('nid')->nullable();
            $table->date('dob')->nullable();
            $table->date('join_date')->nullable();
            $table->tinyInteger('status')->nullable();

            // $table->unsignedInteger('company_id');
            $table->unsignedInteger('position_id');
            $table->double('salary',10,2)->default(0);
            $table->double('house_rent',10,2)->default(0);
            $table->double('medical',10,2)->default(0);
            $table->double('yearly_increment',10,2)->default(0);
            $table->double('advance',10,2)->default(0);

            //Document
            $table->string('image')->nullable();
            $table->string('nid_copy')->nullable();
            $table->string('cv')->nullable();

            // $table->foreign('company_id')->references('id')->on('clientcompany');
            $table->foreign('position_id')->references('id')->on('positions');
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
        Schema::dropIfExists('employees');
    }
}
