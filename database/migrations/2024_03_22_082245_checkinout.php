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
        Schema::create('access_checkinout', function (Blueprint $table) {
            $table->id();
            $table->integer('USERID')->nullable();
            $table->dateTime('CHECKTIME')->nullable();
            $table->index('CHECKTIME');
            $table->string('CHECKTYPE')->nullable();
            $table->integer('VERIFYCODE')->nullable();
            $table->string('SENSORID')->nullable();
            $table->string('Memoinfo')->nullable();
            $table->string('WorkCode')->nullable();
            $table->string('sn')->nullable();
            $table->integer('UserExtFmt')->nullable();
            $table->integer('mask_flag')->nullable();
            $table->integer('temperature')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_checkinout');
    }
};
