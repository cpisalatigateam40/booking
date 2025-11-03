@extends('layouts.layout')

@section('content')
<div id="admin-approval-section" class="section">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Kelola Semua Booking</h2><!-- All Bookings -->
        <div id="pending-approvals" class="space-y-4">
            <div id="no-pending" class="text-center py-12 text-gray-500">
                <div class="text-6xl mb-4">
                    📋
                </div>
                <p class="text-lg">Belum ada booking ruang meeting</p>
            </div>
        </div>
    </div>
</div>
@endsection