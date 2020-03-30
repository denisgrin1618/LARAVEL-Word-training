<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_statistics', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('translation_id');
            $table->foreign('translation_id')->references('id')->on('translations')->onDelete('cascade');
            
            $table->integer('count_success')->default(0);
            $table->integer('count_error')->default(0);
            
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
        Schema::dropIfExists('translation_statistics');
    }
}
