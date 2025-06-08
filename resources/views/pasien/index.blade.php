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
    <!-- Stats Cards -->
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

    <!-- Quick Actions -->
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

    <!-- Recent Activity -->
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

    <!-- Health Tips Widget -->
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

@push('styles')
    <style>
        /* Dashboard Header */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
        }

        .header-content .dashboard-title {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .dashboard-subtitle {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar i {
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .user-details .user-name {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .user-status {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 4px solid;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), transparent);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .card-primary {
            border-left-color: #3498db;
        }

        .card-success {
            border-left-color: #2ecc71;
        }

        .card-info {
            border-left-color: #9b59b6;
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .card-primary .stat-icon {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }

        .card-success .stat-icon {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }

        .card-info .stat-icon {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
        }

        .stat-trend {
            color: #27ae60;
            font-size: 0.9rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 0.25rem;
        }

        .stat-description {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* Quick Actions */
        .quick-actions-section,
        .recent-activity-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .quick-action-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .quick-action-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
            text-decoration: none;
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 1.2rem;
        }

        .action-content h4 {
            margin: 0 0 0.25rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .action-content p {
            margin: 0;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        /* Recent Activity */
        .activity-list {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 1px solid #ecf0f1;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
            font-size: 0.9rem;
        }

        .activity-content h4 {
            margin: 0 0 0.25rem 0;
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .activity-content p {
            margin: 0 0 0.25rem 0;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #95a5a6;
        }

        /* Health Tips Widget */
        .health-tips-widget {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 2rem;
        }

        .widget-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .widget-title {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .widget-date {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .tip-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .tip-item:last-child {
            margin-bottom: 0;
        }

        .tip-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 0.9rem;
        }

        .tip-text {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Announcement Panel */
        .announcement-panel {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .announcement-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
        }

        .announcement-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .announcement-content {
            padding: 1rem;
        }

        .announcement-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .announcement-item:last-child {
            margin-bottom: 0;
        }

        .priority-high {
            background: #fef5e7;
            border-left-color: #f39c12;
        }

        .priority-medium {
            background: #e8f5e8;
            border-left-color: #27ae60;
        }

        .priority-low {
            background: #e3f2fd;
            border-left-color: #3498db;
        }

        .announcement-icon {
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .priority-high .announcement-icon {
            color: #f39c12;
        }

        .priority-medium .announcement-icon {
            color: #27ae60;
        }

        .priority-low .announcement-icon {
            color: #3498db;
        }

        .announcement-text {
            flex: 1;
            font-size: 0.9rem;
            line-height: 1.5;
            color: #2c3e50;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions-grid {
                grid-template-columns: 1fr;
            }

            .quick-action-item {
                padding: 1rem;
            }
        }

        /* Background Colors */
        .bg-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }

        .bg-success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
        }

        .bg-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
        }

        .bg-info {
            background: linear-gradient(135deg, #9b59b6, #8e44ad);
        }
    </style>
@endpush
