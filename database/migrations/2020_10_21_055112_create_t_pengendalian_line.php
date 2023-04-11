<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPengendalianLine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pengendalian_line', function (Blueprint $table) {
            $table->id('id_pengendalian_line');
            $table->foreignId('id_pengendalian');
            $table->foreignId('id_kegiatan');
            $table->foreignId('id_aktivitas')->nullable();
            $table->string('answer');
            $table->text('note');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_pengendalian')->references('id_pengendalian')->on('t_pengendalian');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('m_kegiatan');
            $table->foreign('id_aktivitas')->references('id_aktivitas')->on('m_aktivitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pengendalian_line');
    }
}
