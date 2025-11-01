<div id="admin-rooms-section" class="section hidden">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900">Kelola Ruangan</h2><button id="add-room-btn" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">➕ Tambah Ruangan </button>
        </div><!-- Add Room Form -->
        <div id="room-form" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
            <form id="add-room-form" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div><label for="room-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Ruangan</label><input type="text" id="room-name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ruang A">
                </div>
                <div><label for="room-capacity" class="block text-sm font-medium text-gray-700 mb-2">Kapasitas</label><input type="number" id="room-capacity" required min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="10">
                </div>
                <div class="flex items-end gap-2"><button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700"> Simpan </button><button type="button" id="cancel-room" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"> Batal </button>
                </div>
            </form>
        </div><!-- Rooms List -->
        <div id="rooms-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        </div>
    </div>
</div>