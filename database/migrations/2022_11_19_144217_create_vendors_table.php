<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('password');
            $table->integer('otp')->default('0');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('is_vendor',['0','1'])->default('0')->comment('0-customer,1-customer and vendor');
            $table->enum('bussiness_details',['0','1'])->default('0')->comment('0-Not Done,1-Done');
            $table->enum('verified',['1','0'])->default('0');
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
        Schema::dropIfExists('vendors');
    }
};
