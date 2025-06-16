<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-create.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            @if (auth()->check())
                @if (auth()->user()->role === 'pasien')
                    <div class="sidebar-header">
                        <div class="sidebar-brand">
                            <div class="brand-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="brand-text">
                                <span class="brand-name">PoliCare</span>
                                <span class="brand-subtitle">Patient Portal</span>
                            </div>
                        </div>
                        <button class="sidebar-toggle" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="sidebar-menu">
                        <div class="menu-section">
                            <div class="menu-section-title">Menu Utama</div>
                            <a href="{{ Route('pasien.index') }}"
                                class="menu-item {{ request()->routeIs('pasien.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <span class="menu-text">Dashboard</span>
                                <div class="menu-indicator"></div>
                            </a>
                            <a href="{{ Route('pasien.poli.index') }}"
                                class="menu-item {{ request()->routeIs('pasien.poli.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fa-solid fa-building-user"></i>
                                </div>
                                <span class="menu-text">Daftar Poli</span>
                                <div class="menu-indicator"></div>
                            </a>
                        </div>

                        <div class="menu-section">
                            <div class="menu-section-title">Settings</div>
                            <a href="#" class="menu-item logout-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <div class="menu-icon">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <span class="menu-text">Logout</span>
                                <div class="menu-indicator"></div>
                            </a>
                            <form id="logout-form" action="{{ route('pasien.logout') ?? '#' }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @elseif(auth()->user()->role === 'dokter')
                    <div class="sidebar-header">
                        <div class="sidebar-brand">
                            <div class="brand-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="brand-text">
                                <span class="brand-name">PoliCare</span>
                                <span class="brand-subtitle">Doctor Portal</span>
                            </div>
                        </div>
                        <button class="sidebar-toggle" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="sidebar-menu">
                        <div class="menu-section">
                            <div class="menu-section-title">Menu Utama</div>
                            <a href="{{ Route('dokter.index') }}"
                                class="menu-item {{ request()->routeIs('dokter.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <span class="menu-text">Dashboard</span>
                                <div class="menu-indicator"></div>
                            </a>

                            <a href="{{ Route('dokter.poli.index') ?? '#' }}"
                                class="menu-item {{ request()->routeIs('dokter.poli.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fa-solid fa-house-medical"></i>
                                </div>
                                <span class="menu-text">Poli</span>
                                <div class="menu-indicator"></div>
                            </a>
                            <a href="{{ Route('dokter.periksa.index') ?? '#' }}"
                                class="menu-item {{ request()->routeIs('dokter.periksa.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <span class="menu-text">Periksa</span>
                                <div class="menu-indicator"></div>
                            </a>
                            <a href="{{ Route('dokter.riwayat.index') ?? '#' }}"
                                class="menu-item {{ request()->routeIs('dokter.riwayat.index') ? 'active' : '' }}">
                                <div class="menu-icon">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <span class="menu-text">Riwayat Periksa</span>
                                <div class="menu-indicator"></div>
                            </a>

                        </div>

                        <div class="menu-section">
                            <div class="menu-section-title">Settings</div>
                            <a href="#" class="menu-item logout-item"
                                onclick="event.preventDefault();document.getElementById('logout-form-dokter').submit();">
                                <div class="menu-icon">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <span class="menu-text">Logout</span>
                                <div class="menu-indicator"></div>
                            </a>
                            <form id="logout-form-dokter" action="{{ route('dokter.logout') ?? '#' }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Navigation Bar -->
            <div class="top-navbar">
                <div class="navbar-left">
                    <button class="mobile-sidebar-toggle" id="mobileSidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="breadcrumb">
                        <span class="breadcrumb-item">@yield('dashboard', 'Dashboard')</span>
                    </div>
                </div>

                <div class="navbar-right">
                    <div class="navbar-notifications">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Header Section -->
                <div class="content-header">
                    @yield('header')
                </div>

                <!-- Main Dashboard Content -->
                @php
                    $showTables = $showTables ?? true;
                    $showFullscreen = $showFullscreen ?? false;
                @endphp

                <div class="dashboard-content">
                    @yield('content')
                </div>

                <!-- Announcement Section -->
                <div class="dashboard-announcement">
                    @yield('announcement')
                </div>

                <!-- Tables Section -->
                @if ($showTables)
                    <div class="dashboard-tables">
                        <div class="tables-grid">
                            <div class="table-container">
                                @yield('table')
                            </div>
                            <div class="table-container">
                                @yield('schedule')
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Fullscreen Section -->
                @if ($showFullscreen)
                    <div class="fullscreen-content">
                        @yield('fullscreen')
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            // Desktop sidebar toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('sidebar-collapsed');
                });
            }

            // Mobile sidebar toggle
            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                    sidebarOverlay.classList.toggle('active');
                    document.body.classList.toggle('sidebar-mobile-open');
                });
            }

            // Close mobile sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('mobile-open');
                sidebarOverlay.classList.remove('active');
                document.body.classList.remove('sidebar-mobile-open');
            });

            // Close mobile sidebar when clicking menu item
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('mobile-open');
                        sidebarOverlay.classList.remove('active');
                        document.body.classList.remove('sidebar-mobile-open');
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('mobile-open');
                    sidebarOverlay.classList.remove('active');
                    document.body.classList.remove('sidebar-mobile-open');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
