@extends('layouts.layout')

@section('content')
<div id="admin-rooms-section" class="section">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Kelola Ruangan</h2><button id="add-room-btn"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">➕ Tambah Ruangan </button>
        </div><!-- Add Room Form -->
        <div id="room-form" class="mb-6 p-4 bg-gray-50 rounded-lg">
            <form id="add-room-form"
                action="{{ route('rooms.store') }}"
                method="POST"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf

                <div>
                    <label for="room-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Ruangan</label>
                    <input type="text"
                        id="room-name"
                        name="room"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Ruang A">
                </div>

                <div>
                    <label for="room-capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label>
                    <input type="number"
                        id="room-capacity"
                        name="capacity"
                        required
                        min="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="10">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        Simpan
                    </button>
                    <button type="button" id="cancel-room"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        <!-- Rooms List -->
        <div id="rooms-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($rooms as $room)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                    <div>
                        <span class="font-medium">{{ $room->room }}</span>
                        <p class="text-sm text-gray-600">Kapasitas: {{ $room->capacity }} orang</p>
                    </div>
                    <form action="{{ route('rooms.destroy', $room->uuid) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">Belum ada data ruangan.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 🔹 Elemen untuk Departemen
        const addDepartmentBtn = document.getElementById('add-department-btn');
        const departmentForm = document.getElementById('department-form');
        const cancelDepartmentBtn = document.getElementById('cancel-department');
        const departmentInput = document.getElementById('department-name');

        // 🔹 Elemen untuk Ruangan
        const addRoomBtn = document.getElementById('add-room-btn');
        const roomForm = document.getElementById('room-form');
        const cancelRoomBtn = document.getElementById('cancel-room');
        const roomNameInput = document.getElementById('room-name');

        // 🔸 Awalnya kedua form disembunyikan
        if (departmentForm) departmentForm.style.display = 'none';
        if (roomForm) roomForm.style.display = 'none';

        // 🏢 Departemen
        addDepartmentBtn?.addEventListener('click', () => {
            departmentForm.style.display = 'block';
            departmentInput.focus();
        });

        cancelDepartmentBtn?.addEventListener('click', () => {
            departmentForm.style.display = 'none';
            departmentInput.value = '';
        });

        // 🏠 Ruangan
        addRoomBtn?.addEventListener('click', () => {
            roomForm.style.display = 'block';
            roomNameInput.focus();
        });

        cancelRoomBtn?.addEventListener('click', () => {
            roomForm.style.display = 'none';
            roomNameInput.value = '';
            document.getElementById('room-capacity').value = '';
        });
    });
</script>

@endsection