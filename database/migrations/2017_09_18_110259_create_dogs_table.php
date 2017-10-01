<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->integer('user_id');
            $table->integer('type_id');
            $table->integer('district_id');
            $table->integer('province_id');
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->integer('price');
            $table->text('description')->nullable();
            $table->integer('view')->default(0);
            $table->boolean('sale');
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
        Schema::dropIfExists('dogs');
    }
}
