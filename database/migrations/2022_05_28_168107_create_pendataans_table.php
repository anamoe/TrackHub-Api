<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePendataansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendataans', function (Blueprint $table) {
            $table->id();
            $table->string('waktu_pendataan');
            $table->string('type_absen');
            $table->bigInteger('angkutan_id')->unsigned()->nullable();
            $table->foreign('angkutan_id')->references('id')->on('angkutans')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('penumpang_id')->unsigned()->nullable();
            $table->foreign('penumpang_id')->references('id')->on('penumpangs')->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();

          
        });

        // DB::table('pendataans')->insert([
        //     'id'=>1,
        //     'waktu_pendataan'=>'21-12-2022',
        //     'angkutan_id'=>1,
        //     'penumpang_id'=>1,
        //     'type_absen'=>'Scan QR'

        // ]);

        // DB::table('pendataans')->insert([
        //     'id'=>2,
        //     'waktu_pendataan'=>'31-12-2022',
        //     'angkutan_id'=>2,
        //     'penumpang_id'=>2,
        //     'type_absen'=>'Absen Penumpang'

        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendataans');
    }
}
