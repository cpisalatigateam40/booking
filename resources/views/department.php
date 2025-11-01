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
</div>