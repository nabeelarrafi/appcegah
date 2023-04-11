<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sekolah', function (Blueprint $table) {
            $table->id('id_sekolah');
            $table->foreignId('id_kabupatenkota');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('npsn')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_kabupatenkota')->references('id_kabupatenkota')->on('m_kabupatenkota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_sekolah');
    }
}
