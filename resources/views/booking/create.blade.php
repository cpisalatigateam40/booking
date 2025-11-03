@extends('layouts.layout')

@section('content')
<div id="booking-section" class="section active">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Form Peminjaman Ruang Meeting</h2>
        <form id="booking-form" action="{{ route('booking.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Peminjam</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="nama@email.com">
                </div>

                <div>
                    <label for="department_uuid" class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                    <select id="department_uuid" name="department_uuid" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih departemen</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->uuid }}">{{ $dept->department }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="room_uuid" class="block text-sm font-medium text-gray-700 mb-2">Pilih Ruang</label>
                    <select id="room_uuid" name="room_uuid" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih ruang meeting</option>
                        @foreach($rooms as $room)
                        <option value="{{ $room->uuid }}">{{ $room->room }} ({{ $room->capacity }} orang)</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" id="date" name="date" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai</label>
                        <input type="time" id="start_time" name="start_time" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai</label>
                        <input type="time" id="end_time" name="end_time" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Keperluan/Agenda</label>
                <textarea id="description" name="description" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Jelaskan keperluan penggunaan ruang meeting"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-200">
                    Ajukan Peminjaman
                </button>
            </div>
        </form><!-- Success/Error Messages -->
        <div id="message-container" class="mt-4 hidden">
            <div id="success-message"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded hidden">
                ✅ Peminjaman berhasil diajukan! Data telah tersimpan.
            </div>
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded hidden">
                ❌ Terjadi kesalahan. Silakan coba lagi.
            </div>
            <div id="limit-message"
                class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded hidden">
                ⚠️ Batas maksimum 999 booking telah tercapai. Silakan hapus beberapa booking lama terlebih dahulu.
            </div>
        </div>
    </div>
</div>
@endsection