<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            // $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profesi');
            $table->string('alamat');
            $table->string('notelp',11);
            $table->string('api-token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'id'=>1,
            'nama'=>'ahoy',
            'username'=>'ahoy',
            'password'=>bcrypt(123),
            'profesi'=>'petugas_terminal',
            'alamat'=>'banyuwangi',
            'notelp'=>'085167812'

        ]);

        DB::table('users')->insert([
            'id'=>2,
            'username'=>'supir',
            'nama'=>'supir',
            'password'=>bcrypt(123),
            'profesi'=>'supir',
            'alamat'=>'muncar',
            'notelp'=>'08234353'

        ]);

        DB::table('users')->insert([
            'id'=>3,
            'username'=>'supir2',
            'nama'=>'supir2',
            'password'=>bcrypt(123),
            'profesi'=>'supir',
            'alamat'=>'SRONO',
            'notelp'=>'0833234353'

        ]);

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
