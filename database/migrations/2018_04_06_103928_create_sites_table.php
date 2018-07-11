<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSitesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('name', 64);
            $table->text('url');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sites');
    }
}