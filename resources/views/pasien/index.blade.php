<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@php
    $showTables = false;
    $showFullscreen = false;
@endphp

@extends('layout.index')

@section('title', 'Dashboard | Pasien')
@section('dashboard', 'Pasien')
@section('header')
    <div class="modern-header">
        <div class="header-main">
            <div class="header-content">
                <h1 class="header-title">Dashboard Pasien</h1>
                <p class="header-subtitle">Selamat datang {{ $pasien->name }}, pantau dan periksa kesehatan anda dengan mudah
                </p>
            </div>
            <div class="doctor-profile">
                <div class="doctor-avatar">
                    <div class="avatar-circle">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="status-dot"></span>
                </div>
                <div class="user-details">
                    <div class="doctor-name">{{ $pasien->name }}</div>
                    <div class="doctor-status">Pasien Aktif</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $totalDokter ?? 0 }}</div>
                    <div class="stat-label">Dokter Tersedia</div>
                    <div class="stat-description">Siap melayani Anda</div>
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $janjiTemu ?? 0 }}</div>
                    <div class="stat-label">Janji Hari Ini</div>
                    <div class="stat-description">Jadwal konsultasi</div>
                </div>
            </div>

            <div class="stat-card info">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $jumlahPemeriksaan ?? 0 }}</div>
                    <div class="stat-label">Pemeriksaan Selesai</div>
                    <div class="stat-description">Pemeriksaan yang sudah diselesaikan</div>
                </div>
            </div>
        </div>
    </div>


    <div class="stats-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-bolt me-2"></i>
                Aksi Cepat
            </h3>
        </div>
        <div class="stats-grid">
            <a href="{{ route('pasien.poli.index') }}" class="stat-card primary" style="cursor: pointer;">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Buat Janji</div>
                    <div class="stat-description">Jadwalkan konsultasi baru</div>
                </div>
            </a>
            <a href="#" class="stat-card info" style="cursor: pointer;">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Profil Saya</div>
                    <div class="stat-description">Update informasi pribadi</div>
                </div>
            </a>
        </div>
    </div>
    <div class="history-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-heart me-2"></i>
                Tips Kesehatan Harian
            </h3>
            <div class="examination-date">{{ date('d M Y') }}</div>
        </div>
        <div class="history-list">
            <div class="history-card">
                <div class="card-header">
                    <div class="patient-info">
                        <div class="patient-avatar" style="background: var(--info-color);">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div>
                            <h4 class="patient-name">Hidrasi:</h4>
                            <p class="patient-id">Minumlah 8-10 gelas air putih setiap hari untuk menjaga tubuh tetap
                                terhidrasi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="history-card">
                <div class="card-header">
                    <div class="patient-info">
                        <div class="patient-avatar" style="background: var(--success-color);">
                            <i class="fas fa-walking"></i>
                        </div>
                        <div>
                            <h4 class="patient-name">Olahraga:</h4>
                            <p class="patient-id">Lakukan aktivitas fisik ringan minimal 30 menit setiap hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('announcement')
    <div class="history-section">
        <div class="section-header">
            <h5 class="section-title">
                <i class="fas fa-bullhorn me-2"></i>
                Pengumuman & Informasi
            </h5>
        </div>
        <div class="history-list">
            <div class="history-card">
                <div class="card-header">
                    <div class="patient-info">
                        <div class="patient-avatar" style="background: var(--danger-color);">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div>
                            <h4 class="patient-name">Pemberitahuan Penting:</h4>
                            <p class="patient-id">Sistem akan mengalami maintenance pada Minggu, 15 Juni 2025 pukul
                                02:00-04:00 WIB.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="history-card">
                <div class="card-header">
                    <div class="patient-info">
                        <div class="patient-avatar" style="background: var(--warning-color);">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h4 class="patient-name">Fitur Baru:</h4>
                            <p class="patient-id">Sekarang Anda dapat memberikan rating dan ulasan setelah konsultasi
                                selesai.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="history-card">
                <div class="card-header">
                    <div class="patient-info">
                        <div class="patient-avatar" style="background: var(--info-color);">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h4 class="patient-name">Reminder:</h4>
                            <p class="patient-id">Jangan lupa konfirmasi kehadiran H-1 sebelum jadwal konsultasi Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
