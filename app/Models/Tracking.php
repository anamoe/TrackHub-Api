<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $fillable= [
        'waktu_tracking','latitude_tracking_awal','latitude_tracking_akhir','longitude_tracking_akhir',
        'longitude_tracking_awal','user_id','angkutan_id'
    ];
}
