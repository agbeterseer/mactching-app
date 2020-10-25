<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyPaymentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_payment_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rsa_pin')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('pfa_name')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('pin_reg_date')->nullable();
            $table->string('gross_pay')->nullable();
            $table->string('ten_emp_contribution')->nullable();
            $table->string('eight_emp_contribution')->nullable(); 
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
        Schema::dropIfExists('monthly_payment_reports');
    }
}
