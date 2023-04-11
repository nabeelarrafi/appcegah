<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPengendalian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pengendalian', function (Blueprint $table) {
            $table->id('id_pengendalian');
            $table->foreignId('id_sekolah');
            $table->foreignId('id_tahun_anggaran');
            $table->integer('pending_approver');
            $table->integer('id_menu')->nullable();
            $table->integer('audit_type');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->string('state');
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('m_sekolah');
            $table->foreign('id_tahun_anggaran')->references('id_tahun_anggaran')->on('m_tahun_anggaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pengendalian');
    }
}
