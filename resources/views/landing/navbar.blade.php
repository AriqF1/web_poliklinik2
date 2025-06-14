<nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm transition-all duration-300">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2 fade-in-up">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center transition-transform duration-300 hover:scale-110">
                    <i class="fas fa-heartbeat text-white text-xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800 text-shadow">PoliCare</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Beranda</a>
                <a href="#layanan" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Layanan</a>
                <a href="#dokter" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Dokter</a>
                <a href="#kontak" class="nav-link text-gray-700 hover:text-blue-600 font-medium">Kontak</a>
            </div>

            <div class="flex items-center space-x-4 fade-in-up fade-in-up-delay-1">
                <a href="{{ route('login') }}"
                    class="px-6 py-2 bg-white text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition-all duration-300 font-medium shadow-sm">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 font-medium shadow-sm">
                    Register
                </a>
            </div>
        </div>
    </div>
</nav>
