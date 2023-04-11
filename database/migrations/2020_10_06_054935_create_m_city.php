<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_kabupatenkota', function (Blueprint $table) {
            $table->id('id_kabupatenkota');
            $table->foreignId('id_provinsi');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_provinsi')->references('id_provinsi')->on('m_provinsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kabupatenkota');
    }
}
