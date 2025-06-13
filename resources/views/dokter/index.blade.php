<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@php
    $showTables = false;
    $showFullscreen = false;
@endphp

@extends('layout.index')

@section('title', 'Dashboard | Dokter')
@section('dashboard', 'Dokter')
@section('header')
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">Dashboard Dokter</h1>
            <p class="dashboard-subtitle">Selamat datang {{ $dokter->name }}, pantau kesehatan pasien anda dengan mudah</p>
        </div>
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-details">
                <div class="user-status">Dokter Aktif</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="stats-grid">
        <div class="quick-actions-section">
            <h3 class="section-title">
                <i class="fas fa-bolt me-2"></i>
                Aksi Cepat
            </h3>
            <div class="quick-actions-grid">
                <a href="{{ route('dokter.poli.index') }}" class="quick-action-item">
                    <div class="action-icon bg-primary">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="action-content">
                        <h4>Buka Poli</h4>
                        <p>Jadwalkan Poli Minggu ini</p>
                    </div>
                </a>

                <a href="#" class="quick-action-item">
                    <div class="action-icon bg-success">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="action-content">
                        <h4>Riwayat Medis</h4>
                        <p>Lihat rekam medis pasien anda</p>
                    </div>
                </a>

                <a href="#" class="quick-action-item">
                    <div class="action-icon bg-warning">
                        <i class="fas fa-prescription-bottle"></i>
                    </div>
                    <div class="action-content">
                        <h4>Lihat Obat Tersedia</h4>
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
                @foreach ($pasienPoli as $item)
                    <div class="activity-item">
                        <div class="activity-icon bg-primary">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="activity-content">
                            <h4>{{ $item->pasien->nama }}</h4>
                            <p>{{ $item->keluhan }}</p>
                            <p>{{ $item->no_antrian }}</p>
                            <span class="activity-time">{{ $item->jadwalPeriksa->hari }}
                                ({{ $item->jadwalPeriksa->jam_mulai }} - {{ $item->jadwalPeriksa->jam_selesai }})
                            </span>
                        </div>
                    </div>
                @endforeach

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
