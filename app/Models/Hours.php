<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_time',
    ];

    static function getAllHours()
    {
        return self::select('appointment_time')->get();
    }

    static function getFreeHours($hours)
    {
        return self::select('appointment_time')->whereNotIn('appointment_time', $hours)->get();
    }
}
