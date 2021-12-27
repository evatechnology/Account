<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientcompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientcompany', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            // $table->unsignedInteger('maincompany_id');
            // $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->double('work_order',10,2)->default(0);
            $table->double('received_payment',10,2)->default(0);
            $table->double('spending',10,2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status',['progress','complete'])->nullable();
            // $table->foreign('maincompany_id')->references('id')->on('maincompany');
            // $table->double('current_blance',10,2)->default(0);
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
        Schema::dropIfExists('clientcompany');
    }
}
