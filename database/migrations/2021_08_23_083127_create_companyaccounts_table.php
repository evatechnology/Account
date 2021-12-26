<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyaccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companyaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['Income','Expense','Pending'])->nullable();
            $table->string('company_name')->nullable();
            $table->string('account_head')->nullable();
            $table->double('amount',10,2)->nullable();
            $table->date('date')->nullable();
            $table->string('document')->nullable();
            // $table->double('temp_balance',30,2)->default(0);
            // $table->foreign('company_id')->references('id')->on('clientcompany');
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
        Schema::dropIfExists('companyaccounts');
    }
}
