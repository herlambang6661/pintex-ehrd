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
        Schema::create('access_userinfo', function (Blueprint $table) {
            $table->id('USERID');
            $table->index('USERID');
            $table->string('Badgenumber')->nullable();
            $table->string('SSN')->nullable();
            $table->string('Name')->nullable();
            $table->string('Gender')->nullable();
            $table->string('TITLE')->nullable();
            $table->string('PAGER')->nullable();
            $table->date('BIRTHDAY')->nullable();
            $table->date('HIREDDAY')->nullable();
            $table->string('street')->nullable();
            $table->string('CITY')->nullable();
            $table->string('STATE')->nullable();
            $table->string('ZIP')->nullable();
            $table->string('OPHONE')->nullable();
            $table->string('FPHONE')->nullable();
            $table->smallInteger('VERIFICATIONMETHOD')->nullable();
            $table->smallInteger('DEFAULTDEPTID')->nullable();
            $table->smallInteger('SECURITYFLAGS')->nullable();
            $table->smallInteger('ATT')->nullable();
            $table->smallInteger('INLATE')->nullable();
            $table->smallInteger('OUTEARLY')->nullable();
            $table->smallInteger('OVERTIME')->nullable();
            $table->smallInteger('SEP')->nullable();
            $table->smallInteger('HOLIDAY')->nullable();
            $table->string('MINZU')->nullable();
            $table->string('PASSWORD')->nullable();
            $table->smallInteger('LUNCHDURATION')->nullable();
            $table->longText('PHOTO')->charset('binary')->nullable();
            $table->string('mverifypass')->nullable();
            $table->longText('Notes')->charset('binary')->nullable();
            $table->integer('privilege')->nullable();
            $table->smallInteger('InheritDeptSch')->nullable();
            $table->smallInteger('InheritDeptSchClass')->nullable();
            $table->smallInteger('AutoSchPlan')->nullable();
            $table->integer('MinAutoSchInterval')->nullable();
            $table->smallInteger('RegisterOT')->nullable();
            $table->smallInteger('InheritDeptRule')->nullable();
            $table->smallInteger('EMPRIVILEGE')->nullable();
            $table->string('CardNo')->nullable();
            $table->integer('FaceGroup')->nullable();
            $table->integer('AccGroup')->nullable();
            $table->integer('UseAccGroupTZ')->nullable();
            $table->integer('VerifyCode')->nullable();
            $table->integer('Expires')->nullable();
            $table->integer('ValidCount')->nullable();
            $table->date('ValidTimeBegin')->nullable();
            $table->date('ValidTimeEnd')->nullable();
            $table->integer('TimeZone1')->nullable();
            $table->integer('TimeZone2')->nullable();
            $table->integer('TimeZone3')->nullable();
            $table->string('IDCardNo')->nullable();
            $table->string('IDCardValidTime')->nullable();
            $table->string('EMail')->nullable();
            $table->string('IDCardName')->nullable();
            $table->string('IDCardBirth')->nullable();
            $table->string('IDCardSN')->nullable();
            $table->string('IDCardDN')->nullable();
            $table->string('IDCardAddr')->nullable();
            $table->string('IDCardNewAddr')->nullable();
            $table->string('IDCardISSUER')->nullable();
            $table->integer('IDCardGender')->nullable();
            $table->integer('IDCardNation')->nullable();
            $table->string('IDCardReserve')->nullable();
            $table->string('IDCardNotice')->nullable();
            $table->string('IDCard_MainCard')->nullable();
            $table->string('IDCard_ViceCard')->nullable();
            $table->tinyInteger('FSelected')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_userinfo');
    }
};
