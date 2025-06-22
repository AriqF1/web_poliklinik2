<link rel="stylesheet" href="{{ asset('css/dashboard-poli.css') }}">
@php
    $showTables = false;
    $showFullscreen = false;
@endphp

@extends('layout.index')

@section('title', 'Poli | Dokter')
@section('dashboard', 'Dokter')
@section('header')
    <div class="modern-header">
        <div class="header-main">
            <div class="header-content">
                <h1 class="header-title">Daftar Poli</h1>
                <p class="header-subtitle">Selamat datang di halaman poli, silahkan kelola poli anda</p>
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
        <div class="stats-grid stats-section">
            <div class="stat-card primary" style="cursor: pointer;">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fa-solid fa-house-medical"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">{{ $poli->nama_poli }}</div>
                    <div class="stat-description">{{ $poli->keterangan }}</div>
                </div>
            </div>
            <div class="stat-card info" style="cursor: pointer;"
                onclick="bukaModal('{{ $poli->id }}', '{{ $poli->nama_poli }}')">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="stat-trend">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                </div>
                <div class="stat-content">
                    <div class="stat-label">Buka Jadwal Poli</div>
                    <div class="stat-description">Buka Jadwal Poli Anda Minggu ini</div>
                </div>
            </div>
        </div>
        <div class="history-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-clock me-2"></i>
                    Pemeriksaan Pasien Terbaru
                </h3>
            </div>
            <div class="history-list">
                <div class="history-card">
                    <div class="card-header">
                        <div class="patient-info">
                            <div class="patient-avatar" style="background: var(--success-color);">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <h4 class="patient-name">Pemeriksaan Selesai</h4>
                                <p class="patient-id">Konsultasi dengan Dr. Ahmad - Poli Umum</p>
                            </div>
                        </div>
                        <div class="examination-meta">
                            <span class="activity-time examination-date">2 jam yang lalu</span>
                        </div>
                    </div>
                </div>
                <div class="history-card">
                    <div class="card-header">
                        <div class="patient-info">
                            <div class="patient-avatar" style="background: var(--primary-color);">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <h4 class="patient-name">Janji Temu Dijadwalkan</h4>
                                <p class="patient-id">Besok, 09:00 - Dr. Sarah - Poli Anak</p>
                            </div>
                        </div>
                        <div class="examination-meta">
                            <span class="activity-time examination-date">1 hari yang lalu</span>
                        </div>
                    </div>
                </div>
                <div class="history-card">
                    <div class="card-header">
                        <div class="patient-info">
                            <div class="patient-avatar" style="background: var(--info-color);">
                                <i class="fas fa-prescription"></i>
                            </div>
                            <div>
                                <h4 class="patient-name">Resep Diterbitkan</h4>
                                <p class="patient-id">3 jenis obat untuk pengobatan flu</p>
                            </div>
                        </div>
                        <div class="examination-meta">
                            <span class="activity-time examination-date">3 hari yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modalbukaPoli" class="modal">
            <div class="modal-content">
                <span class="close" onclick="tutupModal()">&times;</span>
                <h5 id="modalNamaPoli">Jadwal Poli</h5>

                <form action="{{ route('dokter.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" id="modalPoliId" name="poli_id">
                        <label for="hari">Hari</label>
                        <select name="hari" class="form-control" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" name="is_aktif" id="is_aktif" value="1">
                        <label for="is_aktif">Aktifkan Jadwal Ini</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    function bukaModal(id, nama) {
        document.getElementById('modalPoliId').value = id;
        document.getElementById('modalNamaPoli').textContent = `Jadwal untuk ${nama}`;
        document.getElementById('modalbukaPoli').style.display = 'flex';
    }

    function tutupModal() {
        document.getElementById('modalbukaPoli').style.display = 'none';
    }
    window.onclick = function(event) {
        const modal = document.getElementById('modalbukaPoli');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
