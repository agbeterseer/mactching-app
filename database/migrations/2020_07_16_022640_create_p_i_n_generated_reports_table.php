<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePINGeneratedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_i_n_generated_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rsa_pin')->nullable();
            $table->string('form_ref_no')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('nin')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('date_of_first_appt')->nullable();
            $table->string('staff_id')->nullable(); 
            $table->string('pin_reg_date')->nullable();
            $table->string('mda_id')->nullable();
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
        Schema::dropIfExists('p_i_n_generated_reports');
    }
}
