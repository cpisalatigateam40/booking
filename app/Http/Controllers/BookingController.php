<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Department;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['department', 'rooms'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc');

        // 🔸 Filter Status
        if ($request->filled('status')) {
            $statusMap = [
                'Menunggu' => '0',
                'Disetujui' => '1',
                'Ditolak' => '2',
            ];
            $statusValue = $statusMap[$request->status] ?? null;
            if ($statusValue !== null) {
                $query->where('status', $statusValue);
            }
        }

        // 🔸 Filter Ruangan
        if ($request->filled('room_uuid')) {
            $query->where('room_uuid', $request->room_uuid);
        }

        $bookings = $query->paginate(5)->appends($request->query());

        $rooms = \App\Models\Room::orderBy('room')->get();

        return view('booking.index', compact('bookings', 'rooms'));
    }


    public function create()
    {
        // Fetch departments and rooms
        $departments = Department::orderBy('department', 'asc')->get(['uuid', 'department']);
        $rooms = Room::orderBy('room', 'asc')->get(['uuid', 'room', 'capacity']);

        // Pass to the view
        return view('booking.create', compact('departments', 'rooms'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'department_uuid' => 'required|exists:departments,uuid',
            'room_uuid' => 'required|exists:rooms,uuid',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'description' => 'required|string',
        ]);
        Booking::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'department_uuid' => $validated['department_uuid'],
            'room_uuid' => $validated['room_uuid'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'description' => $validated['description'],
            'status' => '0',
        ]);

        return redirect()
        ->route('booking.index')
        ->with('success', 'Peminjaman berhasil diajukan dan menunggu persetujuan.');
    }

    public function manageBooking(Request $request)
    {
        $bookings = Booking::with(['department', 'rooms'])
        ->orderByRaw("FIELD(status, 0, 1, 2)")
        ->orderBy('date', 'desc')
        ->orderBy('start_time', 'desc')
        ->paginate(5)
        ->appends($request->query());

        return view('booking.manageBooking', compact('bookings'));
    }

    public function approve($uuid)
    {
        $booking = Booking::firstWhere('uuid', $uuid);

        $booking->update([
            'status' => '1'
        ]);

        return redirect()->back()->with('succes', 'Peminjaman berhasil diapprove');
    }

    public function reject($uuid)
    {
        $booking = Booking::firstWhere('uuid', $uuid);

        $booking->update([
            'status' => '2'
        ]);

        return redirect()->back()->with('succes', 'Peminjaman berhasil diapprove');
    }

    public function destroy($uuid)
    {
        $booking = Booking::firstWhere('uuid', $uuid);
        if ($booking) {
            $booking->delete();
            return redirect()->back()->with('success', 'Booking berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Booking tidak ditemukan.');
    }

}
