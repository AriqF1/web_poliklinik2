<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@php
    $showTables = false;
    $showFullscreen = false;
@endphp

@extends('layout.index')

@section('title', 'Dashboard | Pasien')
@section('dashboard', 'Pasien')
@section('header')
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">Dashboard Pasien</h1>
            <p class="dashboard-subtitle">Selamat datang kembali, pantau kesehatan Anda dengan mudah</p>
        </div>
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-details">
                <div class="user-name">{{ $pasien->name }}</div>
                <div class="user-status">Pasien Aktif</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="stats-grid">
        <div class="stat-card card-primary">
            <div class="stat-card-header">
                <div class="stat-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalDokter ?? 0 }}</div>
                <div class="stat-label">Dokter Tersedia</div>
                <div class="stat-description">Siap melayani Anda</div>
            </div>
        </div>

        <div class="stat-card card-success">
            <div class="stat-card-header">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $janjiTemu ?? 0 }}</div>
                <div class="stat-label">Janji Hari Ini</div>
                <div class="stat-description">Jadwal konsultasi</div>
            </div>
        </div>

        <div class="stat-card card-info">
            <div class="stat-card-header">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $jumlahPemeriksaan ?? 0 }}</div>
                <div class="stat-label">Pemeriksaan Selesai</div>
                <div class="stat-description">Riwayat kesehatan</div>
            </div>
        </div>
    </div>

    <div class="quick-actions-section">
        <h3 class="section-title">
            <i class="fas fa-bolt me-2"></i>
            Aksi Cepat
        </h3>
        <div class="quick-actions-grid">
            <a href="{{ route('pasien.poli.index') }}" class="quick-action-item">
                <div class="action-icon bg-primary">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-content">
                    <h4>Buat Janji</h4>
                    <p>Jadwalkan konsultasi baru</p>
                </div>
            </a>
            <a href="#" class="quick-action-item">
                <div class="action-icon bg-info">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="action-content">
                    <h4>Profil Saya</h4>
                    <p>Update informasi pribadi</p>
                </div>
            </a>
        </div>
    </div>
    <div class="health-tips-widget">
        <div class="widget-header">
            <h3 class="widget-title">
                <i class="fas fa-heart me-2"></i>
                Tips Kesehatan Harian
            </h3>
            <div class="widget-date">{{ date('d M Y') }}</div>
        </div>
        <div class="widget-content">
            <div class="tip-item">
                <div class="tip-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="tip-text">
                    <strong>Hidrasi:</strong> Minumlah 8-10 gelas air putih setiap hari untuk menjaga tubuh tetap terhidrasi
                </div>
            </div>
            <div class="tip-item">
                <div class="tip-icon">
                    <i class="fas fa-walking"></i>
                </div>
                <div class="tip-text">
                    <strong>Olahraga:</strong> Lakukan aktivitas fisik ringan minimal 30 menit setiap hari
                </div>
            </div>
        </div>
    </div>
@endsection

@section('announcement')
    <div class="announcement-panel">
        <div class="announcement-header">
            <h5 class="announcement-title">
                <i class="fas fa-bullhorn me-2"></i>
                Pengumuman & Informasi
            </h5>
        </div>
        <div class="announcement-content">
            <div class="announcement-item priority-high">
                <div class="announcement-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="announcement-text">
                    <strong>Pemberitahuan Penting:</strong><br>
                    Sistem akan mengalami maintenance pada Minggu, 15 Juni 2025 pukul 02:00-04:00 WIB.
                </div>
            </div>

            <div class="announcement-item priority-medium">
                <div class="announcement-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="announcement-text">
                    <strong>Fitur Baru:</strong><br>
                    Sekarang Anda dapat memberikan rating dan ulasan setelah konsultasi selesai.
                </div>
            </div>

            <div class="announcement-item priority-low">
                <div class="announcement-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="announcement-text">
                    <strong>Reminder:</strong><br>
                    Jangan lupa konfirmasi kehadiran H-1 sebelum jadwal konsultasi Anda.
                </div>
            </div>
        </div>
    </div>
@endsection
