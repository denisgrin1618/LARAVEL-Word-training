<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //$table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
            //$table->unsignedBigInteger('language_id');
            //$table->foreign('language_id')->references('id')->on('languages');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            
            $table->timestamps();
        });
        
        //Schema::table('words', function($table) {
        //    $table->foreignId('language_id')->references('id')->on('languages')->onDelete('cascade');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
}
