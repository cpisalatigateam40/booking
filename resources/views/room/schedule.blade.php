@extends('layouts.layout')

@section('content')
<div id="schedule-section">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Jadwal Penggunaan Ruang Meeting</h2>
        
    <!-- Filter Controls -->
    <form action="{{ route('rooms.schedule') }}" method="GET" class="mb-6 flex flex-wrap gap-4 items-end bg-gray-50 p-4 border border-gray-200 rounded-lg">
        <div>
            <label for="schedule-date-filter" class="block text-sm font-medium text-gray-700 mb-2">
                Filter Tanggal
            </label>
            <input type="date" id="schedule-date-filter" name="date"
                value="{{ request('date') }}"
                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="schedule-room-filter" class="block text-sm font-medium text-gray-700 mb-2">
                Filter Ruangan
            </label>
            <select id="schedule-room-filter" name="room_uuid"
                class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Ruangan</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->uuid }}" {{ request('room_uuid') == $room->uuid ? 'selected' : '' }}>
                        {{ $room->room }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                🔍 Terapkan Filter
            </button>
            <a href="{{ route('rooms.schedule') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                🔄 Reset Filter
            </a>
        </div>
    </form>

    <!-- Availability Checker -->
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <h3 class="text-lg font-medium text-gray-900 mb-3">🔍 Cek Ketersediaan Ruangan</h3>

        <form action="{{ route('rooms.availability') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label for="check-date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input type="date" id="check-date" name="date"
                    value="{{ request('date') ?? $selectedDate ?? '' }}"
                    required
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="check-time-start" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai</label>
                <input type="time" id="check-time-start" name="start_time"
                    value="{{ request('start_time') ?? $startTime ?? '' }}"
                    required
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="check-time-end" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai</label>
                <input type="time" id="check-time-end" name="end_time"
                    value="{{ request('end_time') ?? $endTime ?? '' }}"
                    required
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                🔍 Cek Ketersediaan
            </button>
        </form>

        <!-- Availability Results -->
        @if(isset($results))
            <div id="availability-results" class="mt-4 p-3 bg-white border border-gray-200 rounded-lg">
                <h4 class="font-medium text-gray-900 mb-3">Hasil Pencarian:</h4>
                <div id="availability-content" class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($results as $result)
                        <div class="p-3 border rounded-md {{ $result['available'] ? 'border-green-300 bg-green-50' : 'border-red-300 bg-red-50' }}">
                            <div class="font-semibold text-gray-900">{{ $result['room'] }}</div>
                            <div class="text-sm text-gray-600">Kapasitas: {{ $result['capacity'] }} orang</div>
                            <div class="mt-1 text-sm font-medium {{ $result['available'] ? 'text-green-700' : 'text-red-700' }}">
                                {{ $result['available'] ? '✅ Tersedia' : '❌ Sudah Dibooking' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>



    <!-- Approved Bookings Table -->
    <div id="approved-bookings-table" class="bg-white shadow rounded-lg p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
            <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                📋 <span>Daftar Booking yang Disetujui</span>
            </h3>
            <div class="text-sm text-gray-500">
                Total: 
                <span id="approved-count" class="font-semibold text-gray-700">
                    {{ $approvedBookings->total() }}
                </span> 
                booking disetujui
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="min-w-full ">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ruangan</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pengguna</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Departemen</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keperluan</th>
                        <th class="border border-gray-300 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kontak</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($approvedBookings as $booking)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-gray-800">
                                {{ \Carbon\Carbon::parse($booking->date)->translatedFormat('d F Y') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-gray-700">
                                {{ $booking->start_time }} - {{ $booking->end_time }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-gray-800 font-medium">
                                {{ $booking->rooms->room ?? '-' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-gray-800">
                                {{ $booking->name }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-gray-700">
                                {{ $booking->department->department ?? '-' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                {{ $booking->description }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-blue-600">
                                {{ $booking->email }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 py-12 text-center text-gray-500">
                                <div class="text-6xl mb-3">📅</div>
                                <p class="text-lg font-medium">Belum ada booking yang disetujui</p>
                                <p class="text-sm">Booking yang telah disetujui admin akan tampil di sini</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $approvedBookings->links() }}
    </div>


    </div>
</div>
@endsection