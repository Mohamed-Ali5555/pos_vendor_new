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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->string('full_name');
            $table->string('username')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable(); // not all nullable
            // $table->text('address')->nullable();
            // $table->enum('role',['admin','seller','customer'])->default('customer');
            $table->enum('status', ['active', 'inactive'])->default('active');

            //////////////////////////////////////////
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();

            $table->string('scountry')->nullable();
            $table->string('scity')->nullable();
            $table->integer('spostcode')->nullable();
            $table->string('sstate')->nullable();
            $table->string('saddress')->nullable();
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
};
