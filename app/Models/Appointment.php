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

    static function checkReservation($date)
    {
        return self::where('appointment_date', $date)->select('appointment_time')->get();
    }
}
