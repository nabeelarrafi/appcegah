<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMGrupKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_grup_kegiatan', function (Blueprint $table) {
            $table->id('id_grup_kegiatan');
            $table->ForeignId('id_instrumen');
            $table->string('name');
            $table->text('description');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_instrumen')->references('id_instrumen')->on('m_instrumen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_grup_kegiatan');
    }
}
