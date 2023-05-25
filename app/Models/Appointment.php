<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'appointment_time',
        'availability_appointment_time',
    ];

    static function getTime()
    {
        return self::select('appointment_time')->where('availability_appointment_time', 1)->get();
    }
}
