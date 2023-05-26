<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Hours;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function appointmentPage()
    {
        return view('appointmentPage')->with('currentData', date('Y-m-d'));
    }

    public function getHours()
    {
        $data = $this->request->date;
        $exist = Appointment::checkReservation($data);
        $exist ? $allHours = Hours::getFreeHours($exist) : $allHours = Hours::getAllHours();


        $hoursAvailable = [];

        foreach ($allHours as $hour) {
            $hoursAvailable[] = $hour->appointment_time;
        }
        return $hoursAvailable;
    }

    public function insertData()
    {
        $date = $this->request->date;
        $hour = $this->request->hour;

        Appointment::createAppointment($date, $hour);
    }

    public function getAppointmentPage()
    {
        return view('appointments')->with('appointments', Appointment::getAllAppointments());
    }
}
