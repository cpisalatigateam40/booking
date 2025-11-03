<header class="bg-blue-600 shadow-lg">
    <div class="max-w-7xl mx-auto">
        <div class="py-6 flex justify-between items-center">
            <div>
                <h1 id="app-title" class="text-3xl font-bold text-white">Sistem Peminjaman Ruang Meeting</h1>
                <p id="company-name" class="text-blue-100 mt-1">PT. Charoen Pokphand Indonesia</p>
            </div>
            <div id="auth-section">
                @guest
                <div id="login-section" class="flex items-center space-x-4">
                    <button id="admin-login-btn"
                        class="bg-white text-blue-600 px-4 py-2 rounded-md font-medium hover:bg-blue-50 transition duration-200">
                        🔐 Login Admin
                    </button>
                </div>
                @endguest

                @auth
                <div id="admin-section" class="flex items-center space-x-4">
                    <span class="text-blue-100">👤 {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md font-medium hover:bg-red-600 transition duration-200">
                            Logout
                        </button>
                    </form>
                </div>
                @endauth
            </div>

        </div>
    </div>
</header>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm text-center">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-sm text-center">
        {{ $errors->first() }}
    </div>
@endif

<div class="container mx-auto text-left mt-6" style="padding-left: 8rem;">
    <nav class="flex space-x-8 flex-wrap">
        {{-- 🟢 Menu umum (siapa pun bisa akses) --}}
        <a href="{{ route('booking.create') }}" id="tab-booking"
            class="tab-button px-3 py-2 text-sm font-medium rounded-md
            {{ request()->routeIs('booking.create') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
            📅 Booking Ruangan
        </a>

        <a href="{{ route('booking.index') }}" id="tab-list"
            class="tab-button px-3 py-2 text-sm font-medium rounded-md
            {{ request()->routeIs('booking.index') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
            📋 Daftar Booking
        </a>

        <a href="{{ route('rooms.schedule') }}" id="tab-schedule"
            class="tab-button px-3 py-2 text-sm font-medium rounded-md
            {{ request()->routeIs('rooms.schedule') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
            📅 Jadwal Ruangan
        </a>

        @auth
            <a href="{{ route('booking.manage') }}" id="tab-admin-approval"
                class="tab-button px-3 py-2 text-sm font-medium rounded-md
                {{ request()->routeIs('booking.manage') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
                ⚙️ Kelola Booking
            </a>

            <a href="{{ route('departments.index') }}" id="tab-admin-departments"
                class="tab-button px-3 py-2 text-sm font-medium rounded-md
                {{ request()->routeIs('departments.index') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
                🏢 Kelola Departemen
            </a>

            <a href="{{ route('rooms.manage') }}" id="tab-admin-rooms"
                class="tab-button px-3 py-2 text-sm font-medium rounded-md
                {{ request()->routeIs('rooms.manage') ? 'bg-blue-100 text-blue-700' : 'text-gray-500 hover:text-gray-700' }}">
                🏠 Kelola Ruangan
            </a>
        @endauth
    </nav>
</div>


<div id="login-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">🔐 Login Admin</h2>

        {{-- Standar Laravel form login --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" id="close-login-modal"
                    class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700">Batal</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium">Login</button>
            </div>
        </form>
    </div>
</div>

<!-- ✅ Modal Konfirmasi Logout -->
<div id="logout-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 text-center">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Apakah Anda yakin ingin logout?</h2>
        <div class="flex justify-center space-x-4">
            <button id="cancel-logout"
                class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-700">Batal</button>
            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="inline">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded-md font-medium hover:bg-red-600 transition duration-200">
                    Logout
                </button>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const loginModal = document.getElementById('login-modal');
    const loginBtn = document.getElementById('admin-login-btn');
    const closeLoginModal = document.getElementById('close-login-modal');

    loginBtn?.addEventListener('click', () => loginModal.classList.remove('hidden'));
    closeLoginModal?.addEventListener('click', () => loginModal.classList.add('hidden'));
});
</script>

