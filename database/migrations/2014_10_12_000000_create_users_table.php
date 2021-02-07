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
            $table->string('password');
            $table->string('mobile')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('city_id')->nullable();
            $table->string('iban_number')->unique()->nullable();
            $table->text('bio')->nullable();
            $table->tinyInteger('gender')->index()->nullable();
            $table->string('id_image')->nullable();
            $table->string('portfolio_image')->nullable();
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->tinyInteger('type')->index();
            $table->tinyInteger('provider_type')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('app_locale')->default('en');
            $table->rememberToken();
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
