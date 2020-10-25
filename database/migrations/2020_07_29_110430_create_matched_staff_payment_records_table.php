<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchedStaffPaymentRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matched_staff_payment_records', function (Blueprint $table) {
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

            $table->string('rsa_pin1')->nullable();
            $table->string('surname1')->nullable();
            $table->string('firstname1')->nullable();
            $table->string('othernames1')->nullable();
            $table->string('gender1')->nullable();
            $table->string('phone_no1')->nullable();
            $table->string('pfa_name1')->nullable();
            $table->string('staff_id1')->nullable();
            $table->string('gross_pay1')->nullable();
            $table->string('ten_percent1')->nullable();
            $table->string('eight_percent1')->nullable();
            $table->string('mda1')->nullable(); 

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
        Schema::dropIfExists('matched_staff_payment_records');
    }
}
