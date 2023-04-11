<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMAktivitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_aktivitas', function (Blueprint $table) {
            $table->id('id_aktivitas');
            $table->foreignId('id_kegiatan');
            $table->string('name', 255);
            $table->text('desc')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('m_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_aktivitas');
    }
}
