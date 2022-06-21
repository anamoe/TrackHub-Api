<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('waktu_tracking');
            $table->string('latitude_tracking_awal')->nullable();
            $table->string('longitude_tracking_awal')->nullable();
            $table->string('latitude_tracking_akhir')->nullable();
            $table->string('longitude_tracking_akhir')->nullable();
            
            $table->bigInteger('angkutan_id')->unsigned()->nullable();
            $table->foreign('angkutan_id')->references('id')->on('angkutans')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trackings');
    }
}
