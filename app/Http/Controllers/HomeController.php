<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $data = $request->input('data');

        return view('home')->with([
            'data' => $data,
            'currentData' => date('Y-m-d'),
            'hoursAvailable' => self::getAllHours()
        ]);
    }

    public function getAllHours()
    {
        $allHours = Appointment::getTime();
        $hoursAvailable = [];
        foreach ($allHours as $hour) {
            $hoursAvailable[] = $hour->appointment_time;
        }
        return $hoursAvailable;
    }

    public function insertData(Request $request)
    {
        $datas = $request->date;
        $hour = $request->hour;
        Appointment::updateOrCreate(
            ['appointment_time' => $hour],
            [
                'appointment_date' => $datas,
                'availability_appointment_time' => 0
            ]
        );
    }
}
