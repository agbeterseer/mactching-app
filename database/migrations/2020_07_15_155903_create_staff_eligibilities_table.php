<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_eligibilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('staff_id')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othernames')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('date_of_first_appt')->nullable();
            $table->string('grade_level')->nullable();
            $table->string('qualification')->nullable();
            $table->string('confirmation')->nullable();
            $table->string('gross_pay')->nullable();
            $table->string('mda')->nullable(); 
            $table->enum('status', ['matched', 'un-matched'])->nullable(); 
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
        Schema::dropIfExists('staff_eligibilities');
    }
}
