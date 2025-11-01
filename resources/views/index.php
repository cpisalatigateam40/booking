<!doctype html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Ruang Meeting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/_sdk/data_sdk.js"></script>
    <script src="/_sdk/element_sdk.js"></script>
    <style>
        body {
            box-sizing: border-box;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading-spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <style>
        @view-transition {
            navigation: auto;
        }
    </style>
</head>

<body class="h-full bg-gray-50 font-sans">
    <div class="min-h-full"><!-- Header -->
        <header class="bg-blue-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-6 flex justify-between items-center">
                    <div>
                        <h1 id="app-title" class="text-3xl font-bold text-white">Sistem Peminjaman Ruang Meeting</h1>
                        <p id="company-name" class="text-blue-100 mt-1">PT. Contoh Indonesia</p>
                    </div>
                    <div id="auth-section">
                        <div id="login-section" class="flex items-center space-x-4"><button id="admin-login-btn" class="bg-white text-blue-600 px-4 py-2 rounded-md font-medium hover:bg-blue-50 transition duration-200">🔐 Login Admin </button>
                        </div>
                        <div id="admin-section" class="hidden flex items-center space-x-4"><span class="text-blue-100">👤 Admin</span><button id="admin-logout-btn" class="bg-red-500 text-white px-4 py-2 rounded-md font-medium hover:bg-red-600 transition duration-200"> Logout </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"><!-- Navigation Tabs -->
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
            </div><!-- Booking List Section -->
            <div id="list-section" class="section hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900">Daftar Booking Ruang Meeting</h2>
                        <div class="text-sm text-gray-500">
                            Total: <span id="total-bookings">0</span> booking
                        </div>
                    </div><!-- Filter -->
                    <div class="mb-6 flex flex-wrap gap-4"><select id="filter-status" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
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
            </div><!-- Schedule Section -->
            <div id="schedule-section" class="section hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Jadwal Penggunaan Ruang Meeting</h2><!-- Filter Controls -->
                    <div class="mb-6 flex flex-wrap gap-4 items-end">
                        <div><label for="schedule-date-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Tanggal</label><input type="date" id="schedule-date-filter" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div><label for="schedule-room-filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Ruangan</label><select id="schedule-room-filter" class="px-3 py-2 border border-gray-300 rounded-md">
                                <option value="">Semua Ruangan</option>
                            </select>
                        </div><button id="clear-filters-btn" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">🔄 Reset Filter </button>
                    </div><!-- Availability Checker -->
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">🔍 Cek Ketersediaan Ruangan</h3>
                        <div class="flex flex-wrap gap-4 items-end">
                            <div><label for="check-date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label><input type="date" id="check-date" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div><label for="check-time-start" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai</label><input type="time" id="check-time-start" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div><label for="check-time-end" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai</label><input type="time" id="check-time-end" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div><button id="check-availability-btn" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">🔍 Cek Ketersediaan </button>
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
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Tanggal</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Waktu</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Ruangan</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Pengguna</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Departemen</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Keperluan</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Kontak</th>
                                        </tr>
                                    </thead>
                                    <tbody id="approved-bookings-tbody" class="divide-y divide-gray-200"><!-- Approved bookings will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Admin Approval Section -->
            <div id="admin-approval-section" class="section hidden">
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
            </div><!-- Admin Departments Section -->
            <div id="admin-departments-section" class="section hidden">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-900">Kelola Departemen</h2><button id="add-department-btn" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">➕ Tambah Departemen </button>
                    </div><!-- Add Department Form -->
                    <div id="department-form" class="hidden mb-6 p-4 bg-gray-50 rounded-lg">
                        <form id="add-department-form" class="flex gap-4 items-end">
                            <div class="flex-1"><label for="department-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Departemen</label><input type="text" id="department-name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama departemen">
                            </div><button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700"> Simpan </button><button type="button" id="cancel-department" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600"> Batal </button>
                        </form>
                    </div><!-- Departments List -->
                    <div id="departments-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    </div>
                </div>
            </div><!-- Admin Rooms Section -->
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
        </main>
    </div><!-- Admin Login Modal -->
    <div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-96 max-w-90">
            <h3 class="text-xl font-semibold mb-4">Login Admin</h3>
            <form id="admin-login-form">
                <div class="mb-4"><label for="admin-username" class="block text-sm font-medium text-gray-700 mb-2">Username</label><input type="text" id="admin-username" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="admin">
                </div>
                <div class="mb-6"><label for="admin-password" class="block text-sm font-medium text-gray-700 mb-2">Password</label><input type="password" id="admin-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="admin123">
                </div>
                <div class="flex justify-end space-x-3"><button type="button" id="cancel-login" class="px-4 py-2 text-gray-600 hover:text-gray-800"> Batal </button><button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"> Login </button>
                </div>
            </form>
            <div class="mt-4 text-xs text-gray-500">
                Demo: Username: admin, Password: admin123
            </div>
        </div>
    </div>
    <script>
        // Configuration
        const defaultConfig = {
            app_title: "Sistem Peminjaman Ruang Meeting",
            company_name: "PT. Contoh Indonesia"
        };

        let currentBookings = [];
        let currentRecordCount = 0;
        let isAdminLoggedIn = false;
        let departments = ['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales', 'Legal', 'R&D'];
        let rooms = [{
                name: 'Ruang A',
                capacity: 10
            },
            {
                name: 'Ruang B',
                capacity: 20
            },
            {
                name: 'Ruang C',
                capacity: 50
            },
            {
                name: 'Ruang Eksekutif',
                capacity: 8
            }
        ];

        // Data SDK Handler
        const dataHandler = {
            onDataChanged(data) {
                currentBookings = data.filter(item => item.type === 'booking' || !item.type);
                const allData = data;

                // Update departments and rooms from data
                const departmentData = allData.filter(item => item.type === 'department');
                const roomData = allData.filter(item => item.type === 'room');

                if (departmentData.length > 0) {
                    departments = departmentData.map(d => d.name);
                }
                if (roomData.length > 0) {
                    rooms = roomData.map(r => ({
                        name: r.name,
                        capacity: r.capacity
                    }));
                }

                currentRecordCount = currentBookings.length;
                renderBookingList();
                updateTotalCount();
                updateFormOptions();
                updateScheduleRoomFilter();
                renderApprovedBookingsTable();

                if (isAdminLoggedIn) {
                    renderPendingApprovals();
                    renderDepartmentsList();
                    renderRoomsList();
                }
            }
        };

        // Element SDK Implementation
        const elementImplementation = {
            defaultConfig: defaultConfig,
            onConfigChange: async (config) => {
                const appTitle = config.app_title || defaultConfig.app_title;
                const companyName = config.company_name || defaultConfig.company_name;

                document.getElementById('app-title').textContent = appTitle;
                document.getElementById('company-name').textContent = companyName;
            },
            mapToCapabilities: (config) => ({
                recolorables: [{
                        get: () => config.primary_color || "#2563eb",
                        set: (value) => {
                            if (window.elementSdk) {
                                window.elementSdk.setConfig({
                                    primary_color: value
                                });
                            }
                        }
                    },
                    {
                        get: () => config.background_color || "#f9fafb",
                        set: (value) => {
                            if (window.elementSdk) {
                                window.elementSdk.setConfig({
                                    background_color: value
                                });
                            }
                        }
                    }
                ],
                borderables: [],
                fontEditable: {
                    get: () => config.font_family || "system-ui",
                    set: (value) => {
                        if (window.elementSdk) {
                            window.elementSdk.setConfig({
                                font_family: value
                            });
                        }
                    }
                },
                fontSizeable: {
                    get: () => config.font_size || 16,
                    set: (value) => {
                        if (window.elementSdk) {
                            window.elementSdk.setConfig({
                                font_size: value
                            });
                        }
                    }
                }
            }),
            mapToEditPanelValues: (config) => new Map([
                ["app_title", config.app_title || defaultConfig.app_title],
                ["company_name", config.company_name || defaultConfig.company_name]
            ])
        };

        // Initialize SDKs
        async function initializeApp() {
            try {
                // Initialize Element SDK
                if (window.elementSdk) {
                    await window.elementSdk.init(elementImplementation);
                }

                // Initialize Data SDK
                if (window.dataSdk) {
                    const result = await window.dataSdk.init(dataHandler);
                    if (!result.isOk) {
                        console.error("Failed to initialize data SDK");
                    }
                }

                // Set minimum date to today
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('tanggal').min = today;

            } catch (error) {
                console.error("Initialization error:", error);
            }
        }

        // Tab Navigation
        function initializeTabs() {
            const tabButtons = document.querySelectorAll('.tab-button');
            const sections = document.querySelectorAll('.section');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const targetId = button.id.replace('tab-', '') + '-section';

                    // Update tab buttons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('active', 'bg-blue-100', 'text-blue-700');
                        btn.classList.add('text-gray-500', 'hover:text-gray-700');
                    });
                    button.classList.add('active', 'bg-blue-100', 'text-blue-700');
                    button.classList.remove('text-gray-500', 'hover:text-gray-700');

                    // Update sections
                    sections.forEach(section => {
                        section.classList.add('hidden');
                        section.classList.remove('active');
                    });
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                        targetSection.classList.add('active');
                    }
                });
            });
        }

        // Form Submission
        async function handleFormSubmit(event) {
            event.preventDefault();

            // Check record limit
            if (currentRecordCount >= 999) {
                showMessage('limit');
                return;
            }

            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitSpinner = document.getElementById('submit-spinner');

            // Show loading state
            submitBtn.disabled = true;
            submitText.textContent = 'Menyimpan...';
            submitSpinner.classList.remove('hidden');

            try {
                const formData = new FormData(event.target);
                const bookingData = {
                    id: 'booking_' + Date.now(),
                    nama_peminjam: formData.get('nama_peminjam'),
                    email: formData.get('email'),
                    departemen: formData.get('departemen'),
                    ruang: formData.get('ruang'),
                    tanggal: formData.get('tanggal'),
                    waktu_mulai: formData.get('waktu_mulai'),
                    waktu_selesai: formData.get('waktu_selesai'),
                    keperluan: formData.get('keperluan'),
                    status: 'Menunggu',
                    created_at: new Date().toISOString()
                };

                if (window.dataSdk) {
                    const result = await window.dataSdk.create(bookingData);

                    if (result.isOk) {
                        showMessage('success');
                        event.target.reset();
                        // Set minimum date again after reset
                        const today = new Date().toISOString().split('T')[0];
                        document.getElementById('tanggal').min = today;
                    } else {
                        showMessage('error');
                    }
                }
            } catch (error) {
                showMessage('error');
            } finally {
                // Reset loading state
                submitBtn.disabled = false;
                submitText.textContent = 'Ajukan Peminjaman';
                submitSpinner.classList.add('hidden');
            }
        }

        // Show Messages
        function showMessage(type) {
            const container = document.getElementById('message-container');
            const messages = container.querySelectorAll('[id$="-message"]');

            messages.forEach(msg => msg.classList.add('hidden'));
            container.classList.remove('hidden');

            const targetMessage = document.getElementById(type + '-message');
            if (targetMessage) {
                targetMessage.classList.remove('hidden');

                if (type === 'success') {
                    setTimeout(() => {
                        container.classList.add('hidden');
                    }, 5000);
                }
            }
        }

        // Render Booking List
        function renderBookingList() {
            const listContainer = document.getElementById('booking-list');
            const emptyState = document.getElementById('empty-state');

            if (currentBookings.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');

            // Get filter values
            const statusFilter = document.getElementById('filter-status').value;
            const ruangFilter = document.getElementById('filter-ruang').value;

            // Filter bookings
            let filteredBookings = currentBookings;
            if (statusFilter) {
                filteredBookings = filteredBookings.filter(booking => booking.status === statusFilter);
            }
            if (ruangFilter) {
                filteredBookings = filteredBookings.filter(booking => booking.ruang === ruangFilter);
            }

            // Sort by date and time (newest first)
            filteredBookings.sort((a, b) => {
                const dateA = new Date(a.tanggal + 'T' + a.waktu_mulai);
                const dateB = new Date(b.tanggal + 'T' + b.waktu_mulai);
                return dateB - dateA;
            });

            // Clear existing items except empty state
            const existingItems = listContainer.querySelectorAll('.booking-item');
            existingItems.forEach(item => item.remove());

            // Render filtered bookings
            filteredBookings.forEach(booking => {
                const bookingElement = createBookingElement(booking);
                listContainer.appendChild(bookingElement);
            });
        }

        // Create Booking Element
        function createBookingElement(booking) {
            const div = document.createElement('div');
            div.className = 'booking-item bg-gray-50 rounded-lg p-4 border border-gray-200 fade-in';
            div.dataset.bookingId = booking.id;

            const statusColors = {
                'Menunggu': 'bg-yellow-100 text-yellow-800',
                'Disetujui': 'bg-green-100 text-green-800',
                'Ditolak': 'bg-red-100 text-red-800'
            };

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            };

            div.innerHTML = `
<div class="flex justify-between items-start mb-3">
<div>
<h3 class="font-semibold text-gray-900">${booking.nama_peminjam}</h3>
<p class="text-sm text-gray-600">${booking.email}</p>
<p class="text-sm text-blue-600 font-medium">${booking.departemen}</p>
</div>
<span class="px-2 py-1 text-xs font-medium rounded-full ${statusColors[booking.status] || 'bg-gray-100 text-gray-800'}">
                        ${booking.status}
</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
<div>
<p><span class="font-medium">Ruang:</span> ${booking.ruang}</p>
<p><span class="font-medium">Tanggal:</span> ${formatDate(booking.tanggal)}</p>
<p><span class="font-medium">Waktu:</span> ${booking.waktu_mulai} - ${booking.waktu_selesai}</p>
</div>
<div>
<p><span class="font-medium">Keperluan:</span></p>
<p class="text-gray-700 mt-1">${booking.keperluan}</p>
</div>
</div>
            `;

            return div;
        }

        // Update Booking Status
        async function updateBookingStatus(backendId, newStatus) {
            const booking = currentBookings.find(b => b.__backendId === backendId);
            if (!booking || !window.dataSdk) return;

            const updatedBooking = {
                ...booking,
                status: newStatus
            };
            const result = await window.dataSdk.update(updatedBooking);

            if (!result.isOk) {
                showMessage('error');
            }
        }

        // Delete Booking
        async function deleteBooking(backendId) {
            const booking = currentBookings.find(b => b.__backendId === backendId);
            if (!booking || !window.dataSdk) return;

            // Simple confirmation - replace delete button temporarily
            const deleteBtn = event.target;
            const originalText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '⚠️ Yakin?';
            deleteBtn.onclick = async () => {
                const result = await window.dataSdk.delete(booking);
                if (!result.isOk) {
                    showMessage('error');
                }
            };

            // Reset after 3 seconds
            setTimeout(() => {
                deleteBtn.innerHTML = originalText;
                deleteBtn.onclick = () => deleteBooking(backendId);
            }, 3000);
        }

        // Update Total Count
        function updateTotalCount() {
            document.getElementById('total-bookings').textContent = currentRecordCount;
        }

        // Initialize Filters
        function initializeFilters() {
            const statusFilter = document.getElementById('filter-status');
            const ruangFilter = document.getElementById('filter-ruang');

            statusFilter.addEventListener('change', renderBookingList);
            ruangFilter.addEventListener('change', renderBookingList);
        }

        // Schedule Functions
        function updateScheduleRoomFilter() {
            const scheduleRoomFilter = document.getElementById('schedule-room-filter');
            scheduleRoomFilter.innerHTML = '<option value="">Semua Ruangan</option>';

            rooms.forEach(room => {
                const option = document.createElement('option');
                option.value = `${room.name} (${room.capacity} orang)`;
                option.textContent = `${room.name} (${room.capacity} orang)`;
                scheduleRoomFilter.appendChild(option);
            });
        }

        function renderApprovedBookingsTable() {
            const approvedBookings = currentBookings.filter(booking => booking.status === 'Disetujui');
            const noApprovedBookings = document.getElementById('no-approved-bookings');
            const approvedBookingsList = document.getElementById('approved-bookings-list');
            const approvedCount = document.getElementById('approved-count');
            const tbody = document.getElementById('approved-bookings-tbody');

            // Get filter values
            const dateFilter = document.getElementById('schedule-date-filter').value;
            const roomFilter = document.getElementById('schedule-room-filter').value;

            // Apply filters
            let filteredBookings = approvedBookings;
            if (dateFilter) {
                filteredBookings = filteredBookings.filter(booking => booking.tanggal === dateFilter);
            }
            if (roomFilter) {
                filteredBookings = filteredBookings.filter(booking => booking.ruang === roomFilter);
            }

            // Update count
            approvedCount.textContent = filteredBookings.length;

            if (filteredBookings.length === 0) {
                noApprovedBookings.classList.remove('hidden');
                approvedBookingsList.classList.add('hidden');
                return;
            }

            noApprovedBookings.classList.add('hidden');
            approvedBookingsList.classList.remove('hidden');

            // Sort by date and time (newest first)
            filteredBookings.sort((a, b) => {
                const dateA = new Date(a.tanggal + 'T' + a.waktu_mulai);
                const dateB = new Date(b.tanggal + 'T' + b.waktu_mulai);
                return dateA - dateB; // Ascending order for schedule
            });

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID', {
                    weekday: 'short',
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            };

            // Clear existing rows
            tbody.innerHTML = '';

            // Add rows
            filteredBookings.forEach(booking => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';

                // Determine row color based on date
                const bookingDate = new Date(booking.tanggal);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                bookingDate.setHours(0, 0, 0, 0);

                let dateClass = '';
                if (bookingDate < today) {
                    dateClass = 'bg-gray-100'; // Past dates
                } else if (bookingDate.getTime() === today.getTime()) {
                    dateClass = 'bg-blue-50'; // Today
                } else {
                    dateClass = 'bg-green-50'; // Future dates
                }

                row.className = `hover:bg-gray-100 ${dateClass}`;

                row.innerHTML = `
<td class="px-4 py-3 text-sm font-medium text-gray-900">
                        ${formatDate(booking.tanggal)}
                        ${bookingDate.getTime() === today.getTime() ? '<span class="ml-1 text-xs bg-blue-500 text-white px-1 rounded">Hari Ini</span>' : ''}
</td>
<td class="px-4 py-3 text-sm font-medium text-gray-900">
                        ${booking.waktu_mulai} - ${booking.waktu_selesai}
</td>
<td class="px-4 py-3 text-sm text-gray-900">${booking.ruang}</td>
<td class="px-4 py-3 text-sm text-gray-900">${booking.nama_peminjam}</td>
<td class="px-4 py-3 text-sm text-blue-600 font-medium">${booking.departemen}</td>
<td class="px-4 py-3 text-sm text-gray-700 max-w-xs truncate" title="${booking.keperluan}">${booking.keperluan}</td>
<td class="px-4 py-3 text-sm text-gray-600">${booking.email}</td>
                `;

                tbody.appendChild(row);
            });
        }

        function clearScheduleFilters() {
            document.getElementById('schedule-date-filter').value = '';
            document.getElementById('schedule-room-filter').value = '';
            renderApprovedBookingsTable();
        }

        function checkAvailability() {
            const checkDate = document.getElementById('check-date').value;
            const checkTimeStart = document.getElementById('check-time-start').value;
            const checkTimeEnd = document.getElementById('check-time-end').value;

            if (!checkDate || !checkTimeStart || !checkTimeEnd) {
                return;
            }

            if (checkTimeStart >= checkTimeEnd) {
                showAvailabilityResults('❌ Waktu mulai harus lebih awal dari waktu selesai', 'error');
                return;
            }

            const approvedBookings = currentBookings.filter(booking =>
                booking.status === 'Disetujui' &&
                booking.tanggal === checkDate
            );

            const availableRooms = [];
            const conflictRooms = [];

            rooms.forEach(room => {
                const roomName = `${room.name} (${room.capacity} orang)`;
                const roomBookings = approvedBookings.filter(booking => booking.ruang === roomName);

                const hasConflict = roomBookings.some(booking => {
                    return timeOverlap(
                        checkTimeStart, checkTimeEnd,
                        booking.waktu_mulai, booking.waktu_selesai
                    );
                });

                if (hasConflict) {
                    const conflictingBookings = roomBookings.filter(booking =>
                        timeOverlap(checkTimeStart, checkTimeEnd, booking.waktu_mulai, booking.waktu_selesai)
                    );
                    conflictRooms.push({
                        room,
                        bookings: conflictingBookings
                    });
                } else {
                    availableRooms.push(room);
                }
            });

            renderAvailabilityResults(checkDate, checkTimeStart, checkTimeEnd, availableRooms, conflictRooms);
        }

        function timeOverlap(start1, end1, start2, end2) {
            return start1 < end2 && end1 > start2;
        }

        function renderAvailabilityResults(date, timeStart, timeEnd, availableRooms, conflictRooms) {
            const resultsContainer = document.getElementById('availability-results');
            const resultsContent = document.getElementById('availability-content');

            resultsContainer.classList.remove('hidden');

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            };

            let html = `
<div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
<p class="text-sm text-blue-800">
<strong>Pencarian:</strong> ${formatDate(date)} pukul ${timeStart} - ${timeEnd}
</p>
</div>
            `;

            if (availableRooms.length > 0) {
                html += `
<div class="mb-4">
<h5 class="font-medium text-green-800 mb-2">✅ Ruangan Tersedia (${availableRooms.length})</h5>
<div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            ${availableRooms.map(room => `
<div class="bg-green-50 border border-green-200 rounded-lg p-3">
<div class="font-medium text-green-800">${room.name}</div>
<div class="text-sm text-green-600">Kapasitas: ${room.capacity} orang</div>
<div class="text-xs text-green-500 mt-1">Siap digunakan</div>
</div>
                            `).join('')}
</div>
</div>
                `;
            }

            if (conflictRooms.length > 0) {
                html += `
<div class="mb-4">
<h5 class="font-medium text-red-800 mb-2">❌ Ruangan Tidak Tersedia (${conflictRooms.length})</h5>
<div class="space-y-3">
                            ${conflictRooms.map(({ room, bookings }) => ` <
                    div class = "bg-red-50 border border-red-200 rounded-lg p-3" >
                    <
                    div class = "font-medium text-red-800" > $ {
                        room.name
                    }($ {
                            room.capacity
                        }
                        orang) < /div> <
                    div class = "text-sm text-red-600 mt-1" > Bentrok dengan: < /div>
                $ {
                    bookings.map(booking => `
<div class="text-xs text-red-500 ml-2 mt-1">
                                            • ${booking.waktu_mulai}-${booking.waktu_selesai}: ${booking.nama_peminjam} (${booking.keperluan})
</div>
                                    `).join('')
                } <
                /div>
                `).join('')}
</div>
</div>
                `;
            }

            if (availableRooms.length === 0 && conflictRooms.length === 0) {
                html += `
<div class="text-center py-6 text-gray-500">
<div class="text-4xl mb-2">🏢</div>
<p>Tidak ada ruangan yang tersedia untuk dicek</p>
</div>
                `;
            }

            resultsContent.innerHTML = html;
        }

        function showAvailabilityResults(message, type = 'info') {
            const resultsContainer = document.getElementById('availability-results');
            const resultsContent = document.getElementById('availability-content');

            resultsContainer.classList.remove('hidden');

            const colorClass = type === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 'bg-blue-50 border-blue-200 text-blue-800';

            resultsContent.innerHTML = `
<div class="p-3 ${colorClass} border rounded-lg">
                    ${message}
</div>
            `;
        }

        // Admin Functions
        function showAdminTabs() {
            document.querySelectorAll('.admin-only').forEach(tab => {
                tab.classList.remove('hidden');
            });
        }

        function hideAdminTabs() {
            document.querySelectorAll('.admin-only').forEach(tab => {
                tab.classList.add('hidden');
            });
        }

        function showLoginModal() {
            document.getElementById('login-modal').classList.remove('hidden');
        }

        function hideLoginModal() {
            document.getElementById('login-modal').classList.add('hidden');
            document.getElementById('admin-login-form').reset();
        }

        function handleAdminLogin(event) {
            event.preventDefault();
            const username = document.getElementById('admin-username').value;
            const password = document.getElementById('admin-password').value;

            if (username === 'admin' && password === 'admin123') {
                isAdminLoggedIn = true;
                document.getElementById('login-section').classList.add('hidden');
                document.getElementById('admin-section').classList.remove('hidden');
                showAdminTabs();
                hideLoginModal();
                renderPendingApprovals();
                renderDepartmentsList();
                renderRoomsList();
            } else {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'text-red-600 text-sm mt-2';
                errorDiv.textContent = 'Username atau password salah';
                const form = document.getElementById('admin-login-form');
                const existingError = form.querySelector('.text-red-600');
                if (existingError) existingError.remove();
                form.appendChild(errorDiv);
            }
        }

        function handleAdminLogout() {
            isAdminLoggedIn = false;
            document.getElementById('login-section').classList.remove('hidden');
            document.getElementById('admin-section').classList.add('hidden');
            hideAdminTabs();

            // Switch to booking tab
            document.getElementById('tab-booking').click();
        }

        // Update form options based on current data
        function updateFormOptions() {
            const departmentSelect = document.getElementById('departemen');
            const roomSelect = document.getElementById('ruang');

            // Update departments
            departmentSelect.innerHTML = '<option value="">Pilih departemen</option>';
            departments.forEach(dept => {
                const option = document.createElement('option');
                option.value = dept;
                option.textContent = dept;
                departmentSelect.appendChild(option);
            });

            // Update rooms
            roomSelect.innerHTML = '<option value="">Pilih ruang meeting</option>';
            rooms.forEach(room => {
                const option = document.createElement('option');
                option.value = `${room.name} (${room.capacity} orang)`;
                option.textContent = `${room.name} (${room.capacity} orang)`;
                roomSelect.appendChild(option);
            });
        }

        // Render pending approvals
        function renderPendingApprovals() {
            const container = document.getElementById('pending-approvals');
            const noPending = document.getElementById('no-pending');

            // Show all bookings, not just pending ones
            const allBookings = [...currentBookings].sort((a, b) => {
                // Sort by status priority (Menunggu first, then by date)
                if (a.status === 'Menunggu' && b.status !== 'Menunggu') return -1;
                if (a.status !== 'Menunggu' && b.status === 'Menunggu') return 1;

                const dateA = new Date(a.tanggal + 'T' + a.waktu_mulai);
                const dateB = new Date(b.tanggal + 'T' + b.waktu_mulai);
                return dateB - dateA;
            });

            if (allBookings.length === 0) {
                noPending.classList.remove('hidden');
                return;
            }

            noPending.classList.add('hidden');

            // Clear existing items except no-pending
            const existingItems = container.querySelectorAll('.approval-item');
            existingItems.forEach(item => item.remove());

            allBookings.forEach(booking => {
                const approvalElement = createApprovalElement(booking);
                container.appendChild(approvalElement);
            });
        }

        function createApprovalElement(booking) {
            const div = document.createElement('div');

            const formatDate = (dateStr) => {
                const date = new Date(dateStr);
                return date.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            };

            // Different styling based on status
            const statusColors = {
                'Menunggu': {
                    bg: 'bg-yellow-50 border-yellow-200',
                    badge: 'bg-yellow-100 text-yellow-800'
                },
                'Disetujui': {
                    bg: 'bg-green-50 border-green-200',
                    badge: 'bg-green-100 text-green-800'
                },
                'Ditolak': {
                    bg: 'bg-red-50 border-red-200',
                    badge: 'bg-red-100 text-red-800'
                }
            };

            const statusConfig = statusColors[booking.status] || statusColors['Menunggu'];
            div.className = `approval-item ${statusConfig.bg} border rounded-lg p-4`;

            // Show action buttons only for pending bookings
            const actionButtons = booking.status === 'Menunggu' ? `
<div class="flex space-x-2 mt-4">
<button onclick="approveBooking('${booking.__backendId}')" 
                            class="px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
✅ Setujui
</button>
<button onclick="rejectBooking('${booking.__backendId}')" 
                            class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
❌ Tolak
</button>
<button onclick="deleteBooking('${booking.__backendId}')" 
                            class="px-4 py-2 bg-gray-600 text-white text-sm rounded hover:bg-gray-700">
🗑️ Hapus
</button>
</div>
            ` : '';

            div.innerHTML = `
<div class="flex justify-between items-start mb-3">
<div>
<h3 class="font-semibold text-gray-900">${booking.nama_peminjam}</h3>
<p class="text-sm text-gray-600">${booking.email}</p>
<p class="text-sm text-blue-600 font-medium">${booking.departemen}</p>
</div>
<span class="px-2 py-1 text-xs font-medium rounded-full ${statusConfig.badge}">
                        ${booking.status}
</span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
<div>
<p><span class="font-medium">Ruang:</span> ${booking.ruang}</p>
<p><span class="font-medium">Tanggal:</span> ${formatDate(booking.tanggal)}</p>
<p><span class="font-medium">Waktu:</span> ${booking.waktu_mulai} - ${booking.waktu_selesai}</p>
</div>
<div>
<p><span class="font-medium">Keperluan:</span></p>
<p class="text-gray-700 mt-1">${booking.keperluan}</p>
</div>
</div>
                ${actionButtons}
            `;

            return div;
        }

        async function approveBooking(backendId) {
            await updateBookingStatus(backendId, 'Disetujui');
        }

        async function rejectBooking(backendId) {
            await updateBookingStatus(backendId, 'Ditolak');
        }

        // Render departments list
        function renderDepartmentsList() {
            const container = document.getElementById('departments-list');
            container.innerHTML = '';

            departments.forEach(dept => {
                const div = document.createElement('div');
                div.className = 'bg-gray-50 border border-gray-200 rounded-lg p-4 flex justify-between items-center';
                div.innerHTML = `
<span class="font-medium">${dept}</span>
<button onclick="deleteDepartment('${dept}')" class="text-red-600 hover:text-red-800 text-sm">
🗑️ Hapus
</button>
                `;
                container.appendChild(div);
            });
        }

        // Render rooms list
        function renderRoomsList() {
            const container = document.getElementById('rooms-list');
            container.innerHTML = '';

            rooms.forEach(room => {
                const div = document.createElement('div');
                div.className = 'bg-gray-50 border border-gray-200 rounded-lg p-4 flex justify-between items-center';
                div.innerHTML = `
<div>
<span class="font-medium">${room.name}</span>
<p class="text-sm text-gray-600">Kapasitas: ${room.capacity} orang</p>
</div>
<button onclick="deleteRoom('${room.name}')" class="text-red-600 hover:text-red-800 text-sm">
🗑️ Hapus
</button>
                `;
                container.appendChild(div);
            });
        }

        // Add department
        async function addDepartment(event) {
            event.preventDefault();
            const name = document.getElementById('department-name').value.trim();

            if (!name || departments.includes(name)) {
                return;
            }

            if (window.dataSdk) {
                const result = await window.dataSdk.create({
                    id: 'dept_' + Date.now(),
                    type: 'department',
                    name: name,
                    created_at: new Date().toISOString()
                });

                if (result.isOk) {
                    document.getElementById('department-form').classList.add('hidden');
                    document.getElementById('add-department-form').reset();
                }
            }
        }

        // Add room
        async function addRoom(event) {
            event.preventDefault();
            const name = document.getElementById('room-name').value.trim();
            const capacity = parseInt(document.getElementById('room-capacity').value);

            if (!name || !capacity || rooms.some(r => r.name === name)) {
                return;
            }

            if (window.dataSdk) {
                const result = await window.dataSdk.create({
                    id: 'room_' + Date.now(),
                    type: 'room',
                    name: name,
                    capacity: capacity,
                    created_at: new Date().toISOString()
                });

                if (result.isOk) {
                    document.getElementById('room-form').classList.add('hidden');
                    document.getElementById('add-room-form').reset();
                }
            }
        }

        // Delete department
        async function deleteDepartment(deptName) {
            if (!window.dataSdk) return;

            const allData = await window.dataSdk.init(dataHandler);
            // Find department record to delete
            // This is a simplified approach - in real implementation you'd track the backend IDs
        }

        // Delete room
        async function deleteRoom(roomName) {
            if (!window.dataSdk) return;

            // Similar to deleteDepartment - simplified approach
        }

        // Initialize App
        document.addEventListener('DOMContentLoaded', () => {
            initializeApp();
            initializeTabs();
            initializeFilters();

            // Form submission
            document.getElementById('booking-form').addEventListener('submit', handleFormSubmit);

            // Schedule functions
            document.getElementById('check-availability-btn').addEventListener('click', checkAvailability);
            document.getElementById('clear-filters-btn').addEventListener('click', clearScheduleFilters);
            document.getElementById('schedule-date-filter').addEventListener('change', renderApprovedBookingsTable);
            document.getElementById('schedule-room-filter').addEventListener('change', renderApprovedBookingsTable);

            // Set minimum dates for schedule inputs
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('check-date').min = today;

            // Admin login
            document.getElementById('admin-login-btn').addEventListener('click', showLoginModal);
            document.getElementById('cancel-login').addEventListener('click', hideLoginModal);
            document.getElementById('admin-login-form').addEventListener('submit', handleAdminLogin);
            document.getElementById('admin-logout-btn').addEventListener('click', handleAdminLogout);

            // Admin forms
            document.getElementById('add-department-btn').addEventListener('click', () => {
                document.getElementById('department-form').classList.toggle('hidden');
            });
            document.getElementById('cancel-department').addEventListener('click', () => {
                document.getElementById('department-form').classList.add('hidden');
            });
            document.getElementById('add-department-form').addEventListener('submit', addDepartment);

            document.getElementById('add-room-btn').addEventListener('click', () => {
                document.getElementById('room-form').classList.toggle('hidden');
            });
            document.getElementById('cancel-room').addEventListener('click', () => {
                document.getElementById('room-form').classList.add('hidden');
            });
            document.getElementById('add-room-form').addEventListener('submit', addRoom);

            // Close modal when clicking outside
            document.getElementById('login-modal').addEventListener('click', (e) => {
                if (e.target.id === 'login-modal') {
                    hideLoginModal();
                }
            });
        });

        // Global functions for onclick handlers
        window.updateBookingStatus = updateBookingStatus;
        window.deleteBooking = deleteBooking;
        window.approveBooking = approveBooking;
        window.rejectBooking = rejectBooking;
        window.deleteDepartment = deleteDepartment;
        window.deleteRoom = deleteRoom;
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'995fb6f092c0f902',t:'MTc2MTcwOTg4OC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
</body>

</html>