<?php

namespace App\Http\Controllers;

use App\Models\Room;
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

    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'room' => 'required|string|max:255|unique:rooms,room',
            'capacity' => 'required|integer|min:1',
        ]);

        // ✅ Create new room entry
        $room = Room::create([
            'room' => $validated['room'],
            'capacity' => $validated['capacity'],
        ]);

        // ✅ Redirect or respond JSON
        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan.');
        // or, for AJAX:
        // return response()->json(['success' => true, 'data' => $room]);
    }
}
