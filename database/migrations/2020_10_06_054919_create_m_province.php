<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMProvince extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_provinsi', function (Blueprint $table) {
            $table->id('id_provinsi');
            $table->foreignId('id_negara');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_negara')->references('id_negara')->on('m_negara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_provinsi');
    }
}
