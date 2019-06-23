<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('streetname')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('region')->nullable();
            $table->string('role')->default('default');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array(
            'name' => 'Admin',
            'email' => 'admin@webshop.nl',
            'streetname' => 'Webshop',
            'housenumber' => 99,
            'zipcode' => '1234AB',
            'region' => 'Amsterdam',
            'role' => 'admin',
            'password' => Hash::make('secret')
        ));
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
