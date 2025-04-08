<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact');
            $table->enum('gender', ['male', 'female']);
            $table->string('street_address');
            $table->string('city');
            $table->string('email')->unique();
            $table->year('dob_year');
            $table->tinyInteger('dob_month');
            $table->tinyInteger('dob_day');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client');
    }
}
