<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaincompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maincompany', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyname')->nullable();
            $table->string('logo')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('trade_licence')->nullable();
            $table->string('reg_no')->nullable();
            $table->date('foundation_date')->nullable();
            $table->longText('headoffice_address')->nullable();
            $table->longText('siteoffice_address')->nullable();
            $table->double('balance',10,2)->default(0);
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
        Schema::dropIfExists('maincompany');
    }
}
