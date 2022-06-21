<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAngkutansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angkutans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_angkutan');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('trayek_id')->unsigned()->nullable();
            $table->foreign('trayek_id')->references('id')->on('trayeks')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('angkutans')->insert([
            'id'=>1,
            'nama_angkutan'=>'angkutan',
            'user_id'=>2,
            'trayek_id'=>1

        ]);

        DB::table('angkutans')->insert([
            'id'=>2,
            'nama_angkutan'=>'angkutan 2',
            'user_id'=>3,
            'trayek_id'=>1

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angkutans');
    }
}
