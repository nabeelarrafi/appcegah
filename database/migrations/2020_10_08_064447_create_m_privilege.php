<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMPrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_privilege', function (Blueprint $table) {
            $table->id('id_privilege');
            $table->foreignId('id_role');
            $table->foreignId('id_menu')->nullable();
            $table->foreignId('id_sub_menu')->nullable();
            $table->foreignId('id_kegiatan')->nullable();
            $table->foreignId('id_aktivitas')->nullable();
            $table->text('description')->nulllable();
            $table->integer('is_create');
            $table->integer('is_read');
            $table->integer('is_update');
            $table->integer('is_delete');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_role')->references('id_role')->on('m_role');
            $table->foreign('id_menu')->references('id_menu')->on('m_menu');
            $table->foreign('id_sub_menu')->references('id_sub_menu')->on('m_sub_menu');
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
        Schema::dropIfExists('m_privilege');
    }
}
