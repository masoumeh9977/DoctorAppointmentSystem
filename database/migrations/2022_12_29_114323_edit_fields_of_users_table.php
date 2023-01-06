<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditFieldsOfUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_no', 11)->nullable()->change();
            $table->unsignedInteger('gender')->nullable()->change(); // 0:male 1:female
            $table->unsignedInteger('status')->nullable()->change(); // 0:single 1:married
            $table->date('dob')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->boolean('is_doctor')->default(false)->change();
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
          
        });
    }
}
