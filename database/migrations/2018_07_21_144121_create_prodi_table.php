<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Traits\BinarySchemaTrait as BinarySchema;

class CreateProdiTable extends Migration
{
    use BinarySchema;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_prodi', 200);
            $table->integer('jurusan_id')->unsigned();
            $table->foreign('jurusan_id')
                ->references('id')->on('jurusan')
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
        Schema::dropIfExists('program_studi');
    }
}
