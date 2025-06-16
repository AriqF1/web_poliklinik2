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
            <h1 class="dashboard-title">Dashboard Riwayat Pemeriksaan </h1>
            <p class="dashboard-subtitle">Selamat datang {{ $dokter->name }}, kelola riwayat pemeriksaan pasien anda dengan
                mudah</p>
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
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $riwayat->count() }}</h3>
                    <p>Total Pemeriksaan</p>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $riwayat->unique('daftarPoli.pasien.id')->count() }}</h3>
                    <p>Pasien</p>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-pills"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $riwayat->sum(function ($item) {return $item->detailPeriksa->count();}) }}</h3>
                    <p>Total Obat</p>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-info">
                    <h3>Rp {{ number_format($riwayat->sum('biaya_periksa'), 0, ',', '.') }}</h3>
                    <p>Total Pendapatan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="examination-list">
        @forelse($riwayat as $index => $item)
            <div class="examination-item">
                <div class="examination-content">
                    <div class="examination-avatar">
                        <div class="avatar">
                            <i class="fas fa-user-injured"></i>
                        </div>
                    </div>

                    <div class="examination-details">
                        <div class="examination-number">
                            #{{ $item->daftarPoli->pasien->no_rm }}
                        </div>

                        <h3 class="patient-name">{{ $item->daftarPoli->pasien->user->name }}</h3>
                        <p class="examination-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($item->tgl_periksa)->format('d M Y') }}
                        </p>

                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="detail-label">Diagnosa Pemeriksaan</div>
                                <p class="detail-value">{{ Str::limit($item->catatan, 100) }}</p>
                            </div>

                            <div class="detail-item">
                                <div class="detail-label">Obat yang Diberikan</div>
                                <div class="medications-list">
                                    @foreach ($item->detailPeriksa->take(3) as $detail)
                                        <span class="medication-tag">{{ $detail->obat->nama_obat }}</span>
                                    @endforeach
                                    @if ($item->detailPeriksa->count() > 3)
                                        <span class="medication-tag">+{{ $item->detailPeriksa->count() - 3 }}
                                            lainnya</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="examination-cost">
                        <h3 class="cost-amount">Rp {{ number_format($item->biaya_periksa, 0, ',', '.') }}</h3>
                        <p style="color: #666; margin: 0;">Biaya Pemeriksaan</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>Belum Ada Pemeriksaan</h3>
                <p>Riwayat pemeriksaan akan muncul di sini setelah ada data pemeriksaan.</p>
            </div>
        @endforelse
    </div>
@endsection
<style>
    /* Content Section Styling */
    .dashboard-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #fff 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .stat-info h3 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 0.25rem 0;
        line-height: 1.2;
    }

    .stat-info p {
        font-size: 0.875rem;
        color: #64748b;
        margin: 0;
        font-weight: 500;
    }

    /* Examination List */
    .examination-list {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .examination-item {
        padding: 2rem;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
        position: relative;
    }

    .examination-item:last-child {
        border-bottom: none;
    }

    .examination-content {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 2rem;
        align-items: start;
    }

    .examination-avatar {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .examination-avatar .avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        position: relative;
    }

    .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 16px;
        height: 16px;
        background: #10b981;
        border: 3px solid white;
        border-radius: 50%;
    }

    .examination-details {
        min-width: 0;
    }

    .examination-number {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.375rem 0.875rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }

    .patient-name {
        font-size: 1.375rem;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 0.5rem 0;
        line-height: 1.3;
    }

    .examination-date {
        color: #64748b;
        font-size: 0.9rem;
        margin: 0 0 1.25rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .examination-date i {
        color: #94a3b8;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-top: 1rem;
    }

    .detail-item {
        background: #f8fafc;
        padding: 1.25rem;
        border-radius: 12px;
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .detail-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.625rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 0.95rem;
        color: #334155;
        margin: 0;
        line-height: 1.6;
        font-weight: 500;
    }

    .medications-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.625rem;
    }

    .medication-tag {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.375rem 0.875rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .medication-tag:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
    }

    .examination-cost {
        text-align: right;
        padding: 0.5rem;
    }

    .cost-amount {
        font-size: 1.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0 0 0.25rem 0;
        line-height: 1.2;
    }

    .examination-cost p {
        color: #64748b;
        margin: 0;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
    }

    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        color: #334155;
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1rem;
        line-height: 1.6;
        max-width: 400px;
        margin: 0 auto;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .dashboard-container {
            padding: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .examination-content {
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .examination-item {
            padding: 1.5rem;
        }

        .examination-content {
            grid-template-columns: 1fr;
            gap: 1rem;
            text-align: center;
        }

        .examination-cost {
            text-align: center;
            margin-top: 1rem;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .patient-name {
            font-size: 1.25rem;
        }

        .cost-amount {
            font-size: 1.375rem;
        }
    }

    @media (max-width: 480px) {
        .dashboard-container {
            padding: 0.75rem;
        }

        .examination-item {
            padding: 1rem;
        }

        .stat-content {
            flex-direction: column;
            text-align: center;
            gap: 0.75rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }

        .medications-list {
            justify-content: center;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
