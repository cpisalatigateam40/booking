@extends('layouts.layout')

@section('content')
<div id="admin-approval-section" class="section">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Kelola Semua Booking</h2>

        @if($bookings->isEmpty())
            <div id="no-pending" class="text-center py-12 text-gray-500">
                <div class="text-6xl mb-4">📋</div>
                <p class="text-lg">Belum ada booking ruang meeting</p>
            </div>
        @else
            <div id="pending-approvals" class="space-y-4">
                @foreach($bookings as $booking)
                    @php
                        $statusLabel = [
                            '0' => ['text' => 'Menunggu', 'bg' => 'bg-yellow-50 border-yellow-200', 'badge' => 'bg-yellow-100 text-yellow-800'],
                            '1' => ['text' => 'Disetujui', 'bg' => 'bg-green-50 border-green-200', 'badge' => 'bg-green-100 text-green-800'],
                            '2' => ['text' => 'Ditolak', 'bg' => 'bg-red-50 border-red-200', 'badge' => 'bg-red-100 text-red-800'],
                        ][$booking->status];
                    @endphp

                    <div class="approval-item {{ $statusLabel['bg'] }} border rounded-lg p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-semibold text-gray-900">Nama: {{ $booking->name }}</h3>
                                <p class="text-sm text-gray-600">Email: {{ $booking->email }}</p>
                                <p class="text-sm text-blue-600 font-medium">
                                    Departemen: {{ $booking->department->department ?? '-' }}
                                </p>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $statusLabel['badge'] }}">
                                {{ $statusLabel['text'] }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p><span class="font-medium">Ruang:</span> {{ $booking->room->room ?? '-' }}</p>
                                <p><span class="font-medium">Tanggal:</span>
                                    {{ \Carbon\Carbon::parse($booking->date)->translatedFormat('l, d F Y') }}</p>
                                <p><span class="font-medium">Waktu:</span>
                                    {{ $booking->start_time }} - {{ $booking->end_time }}</p>
                            </div>
                            <div>
                                <p><span class="font-medium">Keperluan:</span></p>
                                <p class="text-gray-700 mt-1">{{ $booking->description }}</p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        @if($booking->status == '0')
                            <div class="flex space-x-2 mt-4">
                                <form action="{{ route('booking.approve', $booking->uuid) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                        ✅ Setujui
                                    </button>
                                </form>

                                <form action="{{ route('booking.reject', $booking->uuid) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                        ❌ Tolak
                                    </button>
                                </form>
                            </div>
                        @endif

                        <form action="{{ route('booking.destroy', $booking->uuid) }}" method="POST"
                            onsubmit="return confirm('Hapus booking ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="mt-3 px-4 py-2 bg-gray-600 text-white text-sm rounded hover:bg-gray-700">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
