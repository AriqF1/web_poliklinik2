<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@php
    $showTables = false;
    $showFullscreen = false;
@endphp

@extends('layout.index')

@section('title', 'Dashboard | Dokter')
@section('dashboard', 'Dokter')

@section('header')
    <div class="modern-header">
        <div class="header-main">
            <div class="header-content">
                <h1 class="header-title">Dashboard Dokter</h1>
                <p class="header-subtitle">Selamat datang {{ $dokter->name }}, pantau kesehatan pasien anda dengan mudah</p>
            </div>
            <div class="doctor-profile">
                <div class="doctor-avatar">
                    <div class="avatar-circle">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="status-dot"></span>
                </div>
                <div class="user-details">
                    <div class="doctor-name">{{ $dokter->name }}</div>
                    <div class="doctor-status">Dokter Aktif</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="dashboard-container">
        <div class="stats-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-bolt me-2"></i>
                    Aksi Cepat
                </h3>
            </div>
            <div class="stats-grid">
                <a href="{{ route('dokter.poli.index') }}" class="stat-card primary">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Buka Poli</div>
                        <div class="stat-description">Jadwalkan Poli Minggu ini</div>
                    </div>
                </a>

                <a href="{{ route('dokter.riwayat.index') }}" class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-history"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Riwayat Periksa</div>
                        <div class="stat-description">Lihat rekam medis pasien anda</div>
                    </div>
                </a>

                <a href="#" class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-prescription-bottle"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">Lihat Obat Tersedia</div>
                        <div class="stat-description">Kelola resep dan obat</div>
                    </div>
                </a>

                <a href="#" class="stat-card info">
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
        <div class="dashboard-container">
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
                                    <p class="patient-id">Sekarang Anda dapat memberikan rating dan ulasan setelah
                                        konsultasi
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
                                    <p class="patient-id">Jangan lupa konfirmasi kehadiran H-1 sebelum jadwal konsultasi
                                        Anda.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
