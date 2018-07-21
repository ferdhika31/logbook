<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldMhsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('nim',10);
            $table->integer('program_studi_id')->unsigned();
            $table->foreign('program_studi_id')
                ->references('id')->on('program_studi')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropForeign('users_program_studi_id_foreign');
            $table->dropColumn('program_studi_id');
        });
    }
}
