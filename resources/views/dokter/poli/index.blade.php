<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@php
    $showTables = false;
    $showFullscreen = false;
@endphp

@extends('layout.index')

@section('title', 'Poli | Dokter')
@section('dashboard', 'Dokter')
@section('header')
    <div class="dashboard-header">
        <div class="header-content">
            <h1 class="dashboard-title">Daftar Poli</h1>
            <p class="dashboard-subtitle">Selamat datang di halaman poli, silahkan kelola poli anda</p>
        </div>
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-details">
                <div class="user-name">{{ $dokter->name }}</div>
                <div class="user-status">Dokter Aktif</div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="stats-grid">
        <div class="stat-card card-primary" style="cursor: pointer;">
            <div class="stat-card-header">
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
        <div class="stat-card card-info" style="cursor: pointer;"
            onclick="bukaModal('{{ $poli->id }}', '{{ $poli->nama_poli }}')">
            <div class="stat-card-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-house-medical"></i>
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
    <div class="recent-activity-section">
        <h3 class="section-title">
            <i class="fas fa-clock me-2"></i>
            Pemeriksaan Pasien Terbaru
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
        backdrop-filter: blur(3px);
        animation: fadeIn 0.3s ease-out;
    }

    .modal-content {
        background: white;
        padding: 10px;
        border-radius: 12px;
        min-width: 350px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        position: relative;
        animation: slideIn 0.3s ease-out;
        overflow: hidden;
        max-height: 90vh;
        overflow-y: auto;
    }

    .close {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 1.8em;
        cursor: pointer;
        color: white;
        transition: all 0.2s ease;
        z-index: 10;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
    }

    .close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    /* Modal Header - FIXED */
    #modalNamaPoli {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px 60px 25px 30px;
        margin: 0;
        font-size: 1.4em;
        font-weight: 600;
        border-radius: 12px 12px 0 0;
    }

    /* Modal Body - Form Container */
    .modal-form-container {
        padding: 30px;
    }

    /* Form Enhancements */
    .mb-3 {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 0.9em;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 1em;
        transition: all 0.3s ease;
        background: #f8f9fa;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-control:hover {
        border-color: #c1c7d0;
    }

    /* Select Dropdown */
    select.form-control {
        cursor: pointer;
        appearance: none;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"><path fill="%23666" d="M6 8L2 4h8z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 40px;
    }

    /* Time Input */
    input[type="time"].form-control {
        cursor: pointer;
    }

    /* Button Styles */
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 1em;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        width: 100%;
        margin-top: 10px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        to {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
    }
</style>
