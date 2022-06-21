<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    use HasFactory;
    protected $fillable= [
        'angkutan_id','penumpang_id','waktu_pendataan','type_absen'
    ];
}
