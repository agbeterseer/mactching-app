<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffMonthlyPaymentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_monthly_payment_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rsa_pin')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('pfa_name')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('gross_pay')->nullable();
            $table->string('ten_percent')->nullable();
            $table->string('eight_percent')->nullable();
            $table->string('mda')->nullable(); 
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
        Schema::dropIfExists('staff_monthly_payment_reports');
    }
}
