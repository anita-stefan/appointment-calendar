<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Hours;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function home()
    {
        return view('home')->with([
            'currentData' => date('Y-m-d')
        ]);
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

        Appointment::create([
            'appointment_date' => $date,
            'appointment_time' => $hour
        ]);
    }
}
