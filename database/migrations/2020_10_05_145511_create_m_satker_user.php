<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSatkerUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_satker_user', function (Blueprint $table) {
            $table->id('id_satker_user');
            $table->foreignId('id_user');
            $table->foreignId('id_satker');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('m_user');
            $table->foreign('id_satker')->references('id_satker')->on('m_satker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_satker_user');
    }
}
