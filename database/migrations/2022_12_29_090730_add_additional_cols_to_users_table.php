<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname');
            $table->string('phone_no', 11);
            $table->unsignedInteger('gender'); // 0:male 1:female
            $table->unsignedInteger('status'); // 0:single 1:married
            $table->date('dob');
            $table->string('address');
            $table->boolean('is_doctor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('lastname');
            // $table->dropColumn('phone_no');
            // $table->dropColumn('gender');
            // $table->dropColumn('status'); 
            // $table->dropColumn('dob');
            // $table->dropColumn('address');
            // $table->dropColumn('is_doctor');
        });
    }
}
