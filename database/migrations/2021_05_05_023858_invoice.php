<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('user_id')->unsigned();
            $table->integer('marketplace_id')->unsigned();
            $table->integer('ekspedisi_id')->unsigned();
            $table->string('nama');
            // $table->string('alamat');
            // $table->string('no_hp');
            $table->date('tanggal');
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('marketplace_id')->references('id')->on('marketplace')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ekspedisi_id')->references('id')->on('ekspedisi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
