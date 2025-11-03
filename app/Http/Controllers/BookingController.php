<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function create()
    {
        return view('booking.create');
    }

    public function manageBooking()
    {
        return view('booking.manageBooking');
    }
}