<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTrayeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trayeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_trayek',10);
            $table->string('lks_brgkt_trayek',30);
            $table->string('lks_tiba_trayek',30);
            $table->string('via_trayek',100);
            $table->timestamps();
        });

        DB::table('trayeks')->insert([
            'id'=>1,
            'nama_trayek'=>'trayek A',
            'lks_brgkt_trayek'=>'bwi',
            'lks_tiba_trayek'=>'srono',
            'via_trayek'=>'bus'

        ]);
        
        DB::table('trayeks')->insert([
            'id'=>2,
            'nama_trayek'=>'trayek B',
            'lks_brgkt_trayek'=>'jajag',
            'lks_tiba_trayek'=>'glenmore',
            'via_trayek'=>'bus'

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trayeks');
    }
}
