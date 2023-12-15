<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('image');
            $table->date('dob');
            $table->unsignedBigInteger('department_id');
            $table->date('doj');
            $table->unsignedBigInteger('designation_id');
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('department');
            $table->foreign('designation_id')->references('id')->on('designation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
