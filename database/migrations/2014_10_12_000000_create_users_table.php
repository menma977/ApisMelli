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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('rule')->default(1);
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('id_identity_card')->unique();
            $table->string('identity_card_image');
            $table->string('identity_card_image_salve');
            $table->string('image');
            $table->integer('province');
            $table->integer('district');
            $table->integer('sub_district');
            $table->string('village')->nullable();
            $table->string('number_address');
            $table->text('description_address');
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
