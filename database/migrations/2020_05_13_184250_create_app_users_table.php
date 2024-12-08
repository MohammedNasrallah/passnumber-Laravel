<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('user_role')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('regularpass');
            $table->string('pass_icons');
            $table->string('pass_zero_ids');
            $table->string('user_cols');
            $table->string('is_verified')->nullable();
            $table->string('forgot_code')->nullable();
            $table->string('forgot_status')->nullable();
            $table->string('failed_attempts')->nullable(); // 
            $table->string('last_attempt')->nullable(); // time 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
