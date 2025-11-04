@extends('layouts.layout')

@section('content')

<div class="container">
    <div id="list-section" class="section">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Daftar Booking Ruang Meeting</h2>
                <div class="text-sm text-gray-500">
                    Total: <span id="total-bookings">{{ $bookings->count() }}</span> booking
                </div>

            </div>
            <div class="mb-6 flex flex-wrap gap-4">
                <form method="GET" action="{{ route('booking.index') }}" class="flex flex-wrap gap-4 w-full md:w-auto">
                    <select name="status" id="filter-status"
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>

                    <select name="room_uuid" id="filter-ruang"
                        class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option value="">Semua Ruang</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->uuid }}" {{ request('room_uuid') == $room->uuid ? 'selected' : '' }}>
                                {{ $room->room }} ({{ $room->capacity }} orang)
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm">
                        🔍 Filter
                    </button>

                    @if(request()->hasAny(['status', 'room_uuid']))
                        <a href="{{ route('booking.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 text-sm">
                            ❌ Reset
                        </a>
                    @endif
                </form>
            </div>

            <div id="booking-list" class="space-y-4">
                @forelse ($bookings as $booking)
                    <div class="booking-item bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-semibold text-gray-900">Nama: {{ $booking->name }}</h3>
                                <p class="text-sm text-gray-600">Email: {{ $booking->email }}</p>
                                <p class="text-sm text-blue-600 font-medium">
                                    Departemen: {{ $booking->department->department ?? '-' }}
                                </p>
                            </div>
                            @php
                                $statusLabel = match($booking->status) {
                                    '0' => ['Menunggu', 'bg-yellow-100 text-yellow-800'],
                                    '1' => ['Disetujui', 'bg-green-100 text-green-800'],
                                    '2' => ['Ditolak', 'bg-red-100 text-red-800'],
                                    default => ['Tidak Diketahui', 'bg-gray-100 text-gray-800']
                                };
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusLabel[1] }}">
                                {{ $statusLabel[0] }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p><span class="font-medium">Ruang:</span> {{ $booking->rooms->room ?? '-' }}</p>
                                <p><span class="font-medium">Tanggal:</span>
                                    {{ \Carbon\Carbon::parse($booking->date)->translatedFormat('l, d F Y') }}
                                </p>
                                <p><span class="font-medium">Waktu:</span>
                                    {{ $booking->start_time }} - {{ $booking->end_time }}
                                </p>
                            </div>
                            <div>
                                <p><span class="font-medium">Keperluan:</span></p>
                                <p class="text-gray-700 mt-1">{{ $booking->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div id="empty-state" class="text-center py-12 text-gray-500">
                        <div class="text-6xl mb-4">📅</div>
                        <p class="text-lg">Belum ada booking ruang meeting</p>
                        <p class="text-sm">Silakan buat booking pertama Anda</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $bookings->links() }}
            </div>


        </div>
    </div>
</div>
@endsection