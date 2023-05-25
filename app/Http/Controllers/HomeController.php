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
        $data = $this->request->input('data');

        return view('home')->with([
            'data' => $data,
            'currentData' => date('Y-m-d'),
            'hoursAvailable' => self::getHours()
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

//        Appointment::updateOrCreate(
//            ['appointment_time' => $hour],
//            [
//                'appointment_date' => $date,
//                'availability_appointment_time' => 0
//            ]
//        );

        Appointment::create([
            'appointment_date' => $date,
            'appointment_time' => $hour
        ]);
    }
}
