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
            <a href="#" class="quick-action-item">
                <div class="action-icon bg-primary">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-content">
                    <h4>Buat Janji</h4>
                    <p>Jadwalkan konsultasi baru</p>
                </div>
            </a>

            <a href="#" class="quick-action-item">
                <div class="action-icon bg-success">
                    <i class="fas fa-history"></i>
                </div>
                <div class="action-content">
                    <h4>Riwayat Medis</h4>
                    <p>Lihat rekam medis Anda</p>
                </div>
            </a>

            <a href="#" class="quick-action-item">
                <div class="action-icon bg-warning">
                    <i class="fas fa-prescription-bottle"></i>
                </div>
                <div class="action-content">
                    <h4>Resep Obat</h4>
                    <p>Kelola resep dan obat</p>
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

    <div class="recent-activity-section">
        <h3 class="section-title">
            <i class="fas fa-clock me-2"></i>
            Aktivitas Terbaru
        </h3>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon bg-success">
                    <i class="fas fa-check"></i>
                </div>
                <div class="activity-content">
                    <h4>Pemeriksaan Selesai</h4>
                    <p>Konsultasi dengan Dr. Ahmad - Poli Umum</p>
                    <span class="activity-time">2 jam yang lalu</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon bg-primary">
                    <i class="fas fa-calendar"></i>
                </div>
                <div class="activity-content">
                    <h4>Janji Temu Dijadwalkan</h4>
                    <p>Besok, 09:00 - Dr. Sarah - Poli Anak</p>
                    <span class="activity-time">1 hari yang lalu</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon bg-info">
                    <i class="fas fa-prescription"></i>
                </div>
                <div class="activity-content">
                    <h4>Resep Diterbitkan</h4>
                    <p>3 jenis obat untuk pengobatan flu</p>
                    <span class="activity-time">3 hari yang lalu</span>
                </div>
            </div>
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
