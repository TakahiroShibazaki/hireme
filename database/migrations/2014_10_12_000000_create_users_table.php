<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->string('introduction')->nullable();
            $table->string('prefecture')->nullable();
            $table->string('user_website_url')->nullable();
            $table->integer('bd_year')->nullable();
            $table->integer('bd_month')->nullable();
            $table->integer('bd_day')->nullable();
            $table->boolean('prefectureFlag')->default('0');
            $table->boolean('websiteFlag')->default('0');
            $table->boolean('birthyearFlag')->default('0');
            $table->boolean('birthdayFlag')->default('0');
            $table->string('belonging_group')->nullable();
            $table->string('user_header_img')->nullable();
            $table->boolean('belonging_groupFlag')->default('0');
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
        Schema::dropIfExists('users');
    }
}
