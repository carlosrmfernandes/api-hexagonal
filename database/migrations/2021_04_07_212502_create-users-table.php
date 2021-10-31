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
            $table->string('cpf_cnpj')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();;
            $table->string('cep')->nullable();;
            $table->string('state')->nullable();;
            $table->string('city')->nullable();;
            $table->string('neighborhood')->nullable();;
            $table->string('street')->nullable();;
            $table->string('street_number')->nullable();;
            $table->string('complement')->nullable();;
            $table->string('image')->nullable();
            $table->integer('is_active');
            $table->string('password');
            $table->string('company_name')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('user_type_id');
            $table->foreign('user_type_id')->references('id')->on('user_types');
            $table->unsignedBigInteger('category_id')->nullable();;
            $table->foreign('category_id')->references('id')->on('categories');
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
