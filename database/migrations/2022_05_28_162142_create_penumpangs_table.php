<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePenumpangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penumpangs', function (Blueprint $table) {
            $table->id();
            $table->string('tgl_input_penumpang');
            $table->string('nama');
            $table->string('alamat');
            $table->string('tgl_lahir');
            $table->string('no_telp');
            $table->string('asal_sekolah')->nullable();
            $table->string('qrcode')->nullable();
            $table->timestamps();
        });

        DB::table('penumpangs')->insert([
            'id'=>1,
            'tgl_input_penumpang'=>'12-12-2022',
            'nama'=>'joko',
            'alamat'=>'gambiran',
            'tgl_lahir'=>'08-07-2003',
            'no_telp'=>'2322',
            'asal_sekolah'=>'SMK',
            'qrcode'=>'12ab'

        ]);
        DB::table('penumpangs')->insert([
            'id'=>2,
            'tgl_input_penumpang'=>'13-12-2022',
            'nama'=>'janda',
            'alamat'=>'mangir',
            'tgl_lahir'=>'09-07-2003',
            'no_telp'=>'333',
            'qrcode'=>'12abx',
            'asal_sekolah'=>'SMK'

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penumpangs');
    }
}
