<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanktransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('banktransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_number')->nullable();
            $table->string('transection_id')->nullable();
            $table->string('ref')->nullable();
            $table->longText('reason')->nullable();
            $table->string('document')->nullable();
            $table->double('amount',30,2)->nullable();
            // $table->double('temp_balance',30,2)->default(0);
            $table->enum('type',['Debit','Credit','Pending'])->nullable();
            $table->date('date')->nullable();

            $table->foreign('account_number')->references('id')->on('bankdetails');
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
        Schema::dropIfExists('banktransactions');
    }
}
