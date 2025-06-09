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
            <h1 class="dashboard-title">Daftar Poli</h1>
            <p class="dashboard-subtitle">Selamat datang di halaman daftar poli</p>
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
        @foreach ($polis as $poli)
            <div class="stat-card card-primary" onclick="bukaModal('{{ $poli->id }}', '{{ $poli->nama_poli }}')"
                style="cursor: pointer;">
                <div class="stat-card-header">
                    <div class="stat-icon">
                        <i class="fa-solid fa-house-medical"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $poli->dokter_count }}</div>
                    <div class="stat-label">{{ $poli->nama_poli }}</div>
                    <div class="stat-description">{{ $poli->keterangan }}</div>
                </div>
            </div>
        @endforeach
        <div id="modalPendaftaran" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="tutupModal()">&times;</span>
                <h2>Pendaftaran Poli</h2>
                <p>Anda akan mendaftar ke <strong id="modalNamaPoli"></strong></p>
                <form action="{{ route('pasien.poli.daftar-poli.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="poli_id" id="modalPoliId">
                    <div class="form-group">
                        <label for="id_jadwal">Pilih Jadwal:</label>
                        <select name="id_jadwal" id="id_jadwal" required>
                            @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">
                                    {{ $jadwal->dokter->nama }} - {{ $jadwal->hari }} ({{ $jadwal->jam_mulai }} -
                                    {{ $jadwal->jam_selesai }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keluhan">Keluhan:</label>
                        <textarea name="keluhan" id="keluhan" rows="3" required></textarea>
                    </div>

                    <button type="submit">Konfirmasi Pendaftaran</button>
                </form>
            </div>
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
@endsection
<script>
    function bukaModal(id, nama) {
        document.getElementById('modalPoliId').value = id;
        document.getElementById('modalNamaPoli').textContent = nama;
        document.getElementById('modalPendaftaran').style.display = 'flex';
    }

    function tutupModal() {
        document.getElementById('modalPendaftaran').style.display = 'none';
    }
</script>
<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        min-width: 300px;
        max-width: 500px;
    }

    .close {
        float: right;
        font-size: 1.5em;
        cursor: pointer;
    }
</style>
