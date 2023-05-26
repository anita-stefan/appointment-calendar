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

    static function createAppointment($date, $hour)
    {
        return self::create([
            'appointment_date' => $date,
            'appointment_time' => $hour
        ]);
    }

    static function checkReservation($date)
    {
        return self::where('appointment_date', $date)->select('appointment_time')->get();
    }

    static function getAllAppointments()
    {
        return self::select('appointment_date', 'appointment_time')->orderBy('appointment_date','ASC')->get();
    }
}
