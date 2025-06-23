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
                <h1 class="header-title">Dashboard Poli</h1>
                <p class="header-subtitle">Selamat datang {{ $pasien->name }}, silahkan untuk mendaftar poli sebelum
                    melakukan pemeriksaan
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
        <div class="section-header">
            <h3 class="section-title">
                <i class="fas fa-hospital-user me-2"></i>
                Daftar Poli Tersedia
            </h3>
        </div>
        <div class="stats-grid">
            @php
                $icons = [
                    1 => 'fa-heart-pulse',
                    2 => 'fa-notes-medical',
                    3 => 'fa-tooth',
                    4 => 'fa-child',
                    5 => 'fa-x-ray',
                ];
                $colors = [
                    1 => 'primary',
                    2 => 'success',
                    3 => 'warning',
                    4 => 'info',
                    5 => 'danger',
                ];
            @endphp
            @foreach ($polis as $poli)
                <div class="stat-card {{ $colors[$poli->id] ?? 'primary' }}"
                    onclick="bukaModal('{{ $poli->id }}', '{{ $poli->nama_poli }}')" style="cursor: pointer;">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fa-solid {{ $icons[$poli->id] ?? 'fa-question' }}"></i>
                        </div>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">{{ $poli->dokter_count }}</div>
                        <div class="stat-label">{{ $poli->nama_poli }}</div>
                        <div class="stat-description">{{ $poli->keterangan }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Pendaftaran --}}
    <div id="modalPendaftaran" class="modal">
        <div class="modal-content">
            <span class="close" onclick="tutupModal()">&times;</span>
            <h5 class="section-title">Pendaftaran Poli</h5>
            <p>Anda akan mendaftar ke <strong id="modalNamaPoli"></strong></p>
            <form action="{{ route('pasien.poli.daftar-poli.store') }}" method="POST">
                @csrf
                <input type="hidden" name="poli_id" id="modalPoliId">
                <div class="mb-3">
                    <label for="id_jadwal">Pilih Jadwal:</label>
                    <select name="id_jadwal" id="id_jadwal" class="form-control" required>
                        <option value="">Pilih Jadwal Dokter</option>
                        @foreach ($jadwals as $jadwal)
                            <option value="{{ $jadwal->id }}" data-poli-id="{{ $jadwal->dokter->poli_id ?? '' }}">
                                {{ $jadwal->dokter->user->name ?? 'Dokter tidak ditemukan' }} - {{ $jadwal->hari }}
                                ({{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="keluhan">Keluhan:</label>
                    <textarea name="keluhan" id="keluhan" rows="3" class="form-control" required></textarea>
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" class="btn btn-secondary" onclick="tutupModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Konfirmasi Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>

    <div class="history-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="fa-solid fa-house-medical-circle-xmark me-2"></i>
                <span>Keterangan Poli</span>
            </h3>
        </div>
        <div class="history-list">
            @forelse ($poliact as $item)
                <div class="history-card">
                    <div class="card-header">
                        <div class="patient-info">
                            <div class="patient-avatar" style="background: var(--info-color);">
                                <i class="fa-solid {{ $icons[$item->id] ?? 'fa-question' }}"></i>
                            </div>
                            <div>
                                <h4 class="patient-name">{{ $item->nama_poli }}</h4>
                                <p class="patient-id">{{ $item->keterangan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="detail-section">
                            <h4 class="detail-title"></i>Dokter Tersedia: </h4>
                            <div class="detail-content">
                                @forelse ($item->dokter as $dokter)
                                    <p> - {{ $dokter->user->name }}</p>
                                @empty
                                    <p><strong>Belum ada dokter tersedia.</strong></p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-illustration">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3 class="empty-title">Belum ada poli aktif tersedia.</h3>
                    <p class="empty-description">Silahkan cek kembali nanti atau hubungi administrasi.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

<script>
    function bukaModal(poliId, namaPoli) {
        document.getElementById('modalPoliId').value = poliId;
        document.getElementById('modalNamaPoli').innerText = namaPoli;

        const modal = document.getElementById('modalPendaftaran');
        modal.style.display = 'flex';

        const selectJadwal = document.getElementById('id_jadwal');
        const options = selectJadwal.querySelectorAll('option');

        let hasVisibleOptions = false;
        options.forEach(option => {
            if (option.value === "") {
                option.style.display = '';
            } else {
                const optionPoliId = option.getAttribute('data-poli-id');
                if (optionPoliId === poliId) {
                    option.style.display = '';
                    hasVisibleOptions = true;
                } else {
                    option.style.display = 'none';
                }
            }
        });

        const firstVisibleOption = Array.from(options).find(option => option.style.display === '' && option.value !==
            "");
        if (firstVisibleOption) {
            selectJadwal.value = firstVisibleOption.value;
        } else {
            selectJadwal.value = '';
        }
    }

    function tutupModal() {
        document.getElementById('modalPendaftaran').style.display = 'none';
        document.querySelector('#modalPendaftaran form').reset();
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalPendaftaran');
        if (event.target == modal) {
            modal.style.display = "none";
            document.querySelector('#modalPendaftaran form').reset();
        }
    }
</script>
<style>
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 40px;
        width: 90%;
        max-width: 500px;
        position: relative;
        box-shadow:
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: slideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Close Button */
    .close {
        position: absolute;
        right: 20px;
        top: 20px;
        color: #64748b;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        background: rgba(0, 0, 0, 0.05);
    }

    .close:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        transform: scale(1.1);
    }

    /* Header */
    h2 {
        color: #1e293b;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .modal-content p {
        color: #64748b;
        margin-bottom: 30px;
        font-size: 16px;
        line-height: 1.5;
    }

    .modal-content p strong {
        color: #7c3aed;
        font-weight: 600;
    }

    /* Form Styles */
    form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .form-group {
        position: relative;
        display: flex;
        flex-direction: column;
    }

    label {
        color: #374151;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Input Styles */
    select,
    textarea {
        padding: 16px 20px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        font-family: inherit;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        outline: none;
    }

    select:focus,
    textarea:focus {
        border-color: #7c3aed;
        box-shadow:
            0 0 0 3px rgba(124, 58, 237, 0.1),
            0 10px 25px -5px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
        transform: translateY(-2px);
    }

    select:hover,
    textarea:hover {
        border-color: #c7d2fe;
        background: rgba(255, 255, 255, 0.9);
    }

    /* Select Dropdown */
    select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 16px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 48px;
    }

    /* TextArea */
    textarea {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    textarea::placeholder {
        color: #9ca3af;
        font-style: italic;
    }

    /* Submit Button */
    button[type="submit"] {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 18px 32px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 10px;
        position: relative;
        overflow: hidden;
    }

    button[type="submit"]:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    button[type="submit"]:hover {
        transform: translateY(-3px);
        box-shadow:
            0 15px 35px -5px rgba(102, 126, 234, 0.4),
            0 5px 15px -5px rgba(0, 0, 0, 0.1);
    }

    button[type="submit"]:hover:before {
        left: 100%;
    }

    button[type="submit"]:active {
        transform: translateY(-1px);
    }
</style>
