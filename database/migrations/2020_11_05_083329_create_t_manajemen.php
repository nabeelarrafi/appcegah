<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTManajemen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_manajemen', function (Blueprint $table) {
            $table->id('id_t_manajemen');
            $table->foreignId('id_tahun_anggaran');
            $table->integer('pending_approver');
            $table->foreignId('id_tahapan');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->string('state');
            $table->timestamps();

            $table->foreign('id_tahun_anggaran')->references('id_tahun_anggaran')->on('m_tahun_anggaran');
            $table->foreign('id_tahapan')->references('id_tahapan')->on('m_tahapan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_manajemen');
    }
}
