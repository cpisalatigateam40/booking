@extends('layouts.layout')

@section('content')

<div class="container">
    <div id="list-section" class="section">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900">Daftar Booking Ruang Meeting</h2>
                <div class="text-sm text-gray-500">
                    Total: <span id="total-bookings">0</span> booking
                </div>
            </div><!-- Filter -->
            <div class="mb-6 flex flex-wrap gap-4"><select id="filter-status"
                    class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option value="">Semua Status</option>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select><select id="filter-ruang" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option value="">Semua Ruang</option>
                    <option value="Ruang A (10 orang)">Ruang A</option>
                    <option value="Ruang B (20 orang)">Ruang B</option>
                    <option value="Ruang C (50 orang)">Ruang C</option>
                    <option value="Ruang Eksekutif (8 orang)">Ruang Eksekutif</option>
                </select>
            </div><!-- Booking List -->
            <div id="booking-list" class="space-y-4">
                <div id="empty-state" class="text-center py-12 text-gray-500">
                    <div class="text-6xl mb-4">
                        📅
                    </div>
                    <p class="text-lg">Belum ada booking ruang meeting</p>
                    <p class="text-sm">Silakan buat booking pertama Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection