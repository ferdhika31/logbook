<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subno');
            $table->date('tanggal');
            $table->text('tugas');
            $table->text('kegiatan_harian');
            $table->text('tools');
            $table->text('hasil_kerja');
            $table->text('keterangan');
            $table->integer('periode_id')->unsigned();
            $table->integer('project_id')->unsigned();


            $table->foreign('periode_id')
                ->references('id')->on('periode')
                ->onDelete('cascade');
            $table->foreign('project_id')
                ->references('id')->on('project')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logbook');
    }
}
