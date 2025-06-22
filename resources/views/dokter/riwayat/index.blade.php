<link rel="stylesheet" href="{{ asset('css/dashboard-riwayat.css') }}">
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
            <div class="header-text">
                <h1 class="header-title">Riwayat Pemeriksaan</h1>
                <p class="header-subtitle">Kelola dan pantau riwayat pemeriksaan pasien Anda</p>
            </div>
            <div class="doctor-profile">
                <div class="doctor-avatar">
                    <div class="avatar-circle">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="status-dot"></div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">{{ $dokter->name }}</h3>
                    <span class="doctor-status">Dokter Aktif</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="dashboard-container">
        <!-- Statistics Overview -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card primary">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-number">{{ $riwayat->count() }}</h3>
                        <p class="stat-label">Total Pemeriksaan</p>
                    </div>
                </div>

                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-number">{{ $riwayat->unique('daftarPoli.pasien.id')->count() }}</h3>
                        <p class="stat-label">Pasien Terdaftar</p>
                    </div>
                </div>

                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-capsules"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-number">
                            {{ $riwayat->sum(function ($item) {return $item->detailPeriksa->count();}) }}</h3>
                        <p class="stat-label">Obat Diresepkan</p>
                    </div>
                </div>

                <div class="stat-card info">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                    <div class="stat-body">
                        <h3 class="stat-number">Rp {{ number_format($riwayat->sum('biaya_periksa'), 0, ',', '.') }}</h3>
                        <p class="stat-label">Total Pendapatan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examination History -->
        <div class="history-section">
            <div class="section-header">
                <h2 class="section-title">Riwayat Pemeriksaan Terbaru</h2>
                <div class="section-actions">
                    <button class="btn-filter">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    <button class="btn-export">
                        <i class="fas fa-download"></i>
                        Export
                    </button>
                </div>
            </div>

            <div class="history-list">
                @forelse($riwayat as $index => $item)
                    <div class="history-card">
                        <div class="card-header">
                            <div class="patient-info">
                                <div class="patient-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="patient-details">
                                    <h3 class="patient-name">{{ $item->daftarPoli->pasien->user->name }}</h3>
                                    <span class="patient-id">RM: {{ $item->daftarPoli->pasien->no_rm }}</span>
                                </div>
                            </div>
                            <div class="examination-meta">
                                <div class="examination-date">
                                    <i class="fas fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d M Y') }}
                                </div>
                                <div class="examination-cost">
                                    Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="examination-details">
                                <div class="detail-section">
                                    <h4 class="detail-title">
                                        <i class="fas fa-clipboard-check"></i>
                                        Diagnosa & Catatan
                                    </h4>
                                    <p class="detail-content">{{ Str::limit($item->catatan, 150) }}</p>
                                </div>

                                <div class="detail-section">
                                    <h4 class="detail-title">
                                        <i class="fas fa-pills"></i>
                                        Obat yang Diberikan
                                    </h4>
                                    <div class="medications">
                                        @foreach ($item->detailPeriksa->take(4) as $detail)
                                            <span class="medication-pill">{{ $detail->obat->nama_obat }}</span>
                                        @endforeach
                                        @if ($item->detailPeriksa->count() > 4)
                                            <span class="medication-pill more">+{{ $item->detailPeriksa->count() - 4 }}
                                                lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-illustration">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 class="empty-title">Belum Ada Riwayat Pemeriksaan</h3>
                        <p class="empty-description">Riwayat pemeriksaan pasien akan ditampilkan di sini setelah Anda
                            melakukan pemeriksaan pertama.</p>
                        <button class="btn-primary">
                            <i class="fas fa-plus"></i>
                            Mulai Pemeriksaan
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


@endsection
