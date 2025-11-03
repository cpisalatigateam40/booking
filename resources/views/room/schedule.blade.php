@extends('layouts.layout')

@section('content')
<div id="schedule-section">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Jadwal Penggunaan Ruang Meeting</h2>
        <!-- Filter Controls -->
        <div class="mb-6 flex flex-wrap gap-4 items-end">
            <div><label for="schedule-date-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter
                    Tanggal</label><input type="date" id="schedule-date-filter"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div><label for="schedule-room-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter
                    Ruangan</label><select id="schedule-room-filter"
                    class="px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Semua Ruangan</option>
                </select>
            </div><button id="clear-filters-btn"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">🔄 Reset Filter </button>
        </div><!-- Availability Checker -->
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-3">🔍 Cek Ketersediaan Ruangan</h3>
            <div class="flex flex-wrap gap-4 items-end">
                <div><label for="check-date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label><input
                        type="date" id="check-date"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div><label for="check-time-start" class="block text-sm font-medium text-gray-700 mb-2">Waktu
                        Mulai</label><input type="time" id="check-time-start"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div><label for="check-time-end" class="block text-sm font-medium text-gray-700 mb-2">Waktu
                        Selesai</label><input type="time" id="check-time-end"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div><button id="check-availability-btn"
                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">🔍 Cek Ketersediaan
                </button>
            </div><!-- Availability Results -->
            <div id="availability-results" class="hidden mt-4 p-3 bg-white border border-gray-200 rounded-lg">
                <h4 class="font-medium text-gray-900 mb-3">Hasil Pencarian:</h4>
                <div id="availability-content"></div>
            </div>
        </div><!-- Approved Bookings Table -->
        <div id="approved-bookings-table">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">📋 Daftar Booking yang Disetujui</h3>
                <div class="text-sm text-gray-500">
                    Total: <span id="approved-count">0</span> booking disetujui
                </div>
            </div>
            <div id="approved-bookings-content">
                <div id="no-approved-bookings" class="text-center py-12 text-gray-500">
                    <div class="text-6xl mb-4">
                        📅
                    </div>
                    <p class="text-lg">Belum ada booking yang disetujui</p>
                    <p class="text-sm">Booking yang disetujui admin akan muncul di sini</p>
                </div>
                <div id="approved-bookings-list" class="hidden overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Tanggal</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Waktu</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Ruangan</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Pengguna</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Departemen</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Keperluan</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Kontak</th>
                            </tr>
                        </thead>
                        <tbody id="approved-bookings-tbody" class="divide-y divide-gray-200">
                            <!-- Approved bookings will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection