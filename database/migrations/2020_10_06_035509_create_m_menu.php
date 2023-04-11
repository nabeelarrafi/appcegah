<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->foreignId('id_menu_category');
            $table->string('name', 255);
            $table->text('description');
            $table->string('fa_class', 255);
            $table->string('url', 255);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('is_active');
            $table->timestamps();

            $table->foreign('id_menu_category')->references('id_menu_category')->on('m_menu_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_menu');
    }
}
