<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function schedule()
    {
        return view('room.schedule');
    }

    public function manageRoom()
    {
        return view('room.manageRoom');
    }
}