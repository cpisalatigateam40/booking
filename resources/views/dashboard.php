<div class="mb-8">
    <nav class="flex space-x-8 flex-wrap"><button id="tab-booking" class="tab-button active px-3 py-2 text-sm font-medium rounded-md bg-blue-100 text-blue-700">📅 Booking Ruangan </button><button id="tab-list" class="tab-button px-3 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700">📋 Daftar Booking </button><button id="tab-schedule" class="tab-button px-3 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700">📅 Jadwal Ruangan </button><button id="tab-admin-approval" class="tab-button admin-only hidden px-3 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700">⚙️ Kelola Booking </button><button id="tab-admin-departments" class="tab-button admin-only hidden px-3 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700">🏢 Kelola Departemen </button><button id="tab-admin-rooms" class="tab-button admin-only hidden px-3 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700">🏠 Kelola Ruangan </button>
    </nav>
</div><!-- Booking Form Section -->
<div id="booking-section" class="section active">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6">Form Peminjaman Ruang Meeting</h2>
        <form id="booking-form" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div><label for="nama-peminjam" class="block text-sm font-medium text-gray-700 mb-2">Nama Peminjam</label><input type="text" id="nama-peminjam" name="nama_peminjam" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nama lengkap">
                </div>
                <div><label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label><input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="nama@email.com">
                </div>
                <div><label for="departemen" class="block text-sm font-medium text-gray-700 mb-2">Departemen</label><select id="departemen" name="departemen" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih departemen</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Operations">Operations</option>
                        <option value="Sales">Sales</option>
                        <option value="Legal">Legal</option>
                        <option value="R&amp;D">R&amp;D</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div><label for="ruang" class="block text-sm font-medium text-gray-700 mb-2">Pilih Ruang</label><select id="ruang" name="ruang" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih ruang meeting</option>
                        <option value="Ruang A (10 orang)">Ruang A (10 orang)</option>
                        <option value="Ruang B (20 orang)">Ruang B (20 orang)</option>
                        <option value="Ruang C (50 orang)">Ruang C (50 orang)</option>
                        <option value="Ruang Eksekutif (8 orang)">Ruang Eksekutif (8 orang)</option>
                    </select>
                </div>
                <div><label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label><input type="date" id="tanggal" name="tanggal" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div><label for="waktu-mulai" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai</label><input type="time" id="waktu-mulai" name="waktu_mulai" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div><label for="waktu-selesai" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai</label><input type="time" id="waktu-selesai" name="waktu_selesai" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>
            <div><label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">Keperluan/Agenda</label><textarea id="keperluan" name="keperluan" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Jelaskan keperluan penggunaan ruang meeting"></textarea>
            </div>
            <div class="flex justify-end"><button type="submit" id="submit-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-200 flex items-center"><span id="submit-text">Ajukan Peminjaman</span>
                    <div id="submit-spinner" class="loading-spinner ml-2 hidden"></div>
                </button>
            </div>
        </form><!-- Success/Error Messages -->
        <div id="message-container" class="mt-4 hidden">
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded hidden">
                ✅ Peminjaman berhasil diajukan! Data telah tersimpan.
            </div>
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded hidden">
                ❌ Terjadi kesalahan. Silakan coba lagi.
            </div>
            <div id="limit-message" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded hidden">
                ⚠️ Batas maksimum 999 booking telah tercapai. Silakan hapus beberapa booking lama terlebih dahulu.
            </div>
        </div>
    </div>
</div>