<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function schedule(Request $request)
    {
        $query = Booking::with(['department', 'rooms'])
            ->where('status', 1);

        // 🔹 Filter tanggal
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // 🔹 Filter ruangan
        if ($request->filled('room_uuid')) {
            $query->where('room_uuid', $request->room_uuid);
        }

        $approvedBookings = $query
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(10)
            ->appends($request->query());

        // 🔹 Ambil semua ruangan untuk dropdown
        $rooms = Room::orderBy('room', 'asc')->get();

        return view('room.schedule', compact('approvedBookings', 'rooms'));
    }


    public function manageRoom()
    {
        $rooms = Room::all();
        return view('room.manageRoom', compact('rooms'));
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

    public function destroy($uuid)
    {
        $room = Room::where('uuid', $uuid)->first();

        if (!$room) {
            return redirect()->back()->with('error', 'Ruangan tidak ditemukan.');
        }

        $room->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus.');
    }

    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Ambil semua ruangan
        $rooms = Room::orderBy('room', 'asc')->get();

        // Ambil booking di tanggal yang sama
        $booked = Booking::where('status', 1)
            ->where('date', $validated['date'])
            ->get();

        $results = [];

        foreach ($rooms as $room) {
            // Cek apakah ruangan bentrok
            $conflict = $booked->first(function ($booking) use ($room, $validated) {
                if ($booking->room_uuid !== $room->uuid) return false;

                // Cek overlap waktu
                return !(
                    $validated['end_time'] <= $booking->start_time ||
                    $validated['start_time'] >= $booking->end_time
                );
            });

            $results[] = [
                'room' => $room->room,
                'capacity' => $room->capacity,
                'available' => !$conflict,
            ];
        }

        // Return ke view schedule dengan hasil
        $approvedBookings = Booking::with(['department', 'rooms'])
            ->where('status', 1)
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        return view('room.schedule', compact('approvedBookings', 'results', 'rooms'))
            ->with([
                'selectedDate' => $validated['date'],
                'startTime' => $validated['start_time'],
                'endTime' => $validated['end_time']
            ]);
    }

}
