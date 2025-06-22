<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="{{ asset('css/dashboard-periksa.css') }}">
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
                <h1 class="header-title">Dashboard Periksa </h1>
                <p class="header-subtitle">Selamat datang {{ $dokter->name }}, periksa pasien anda dengan mudah</p>
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
        <div class="history-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-clock me-2"></i>
                    Daftar Pemeriksaan Pasien
                </h3>
            </div>
            <div class="history-list">
                @forelse ($pasienPoli as $item)
                    <div class="history-card" style="cursor: pointer;"
                        onclick="bukaModal('{{ $item->id }}', '{{ $item->pasien->user->name }}', '{{ $item->keluhan }}')">
                        <div class="card-header">
                            <div class="patient-info">
                                <div class="patient-avatar" style="background: var(--primary-color);">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                                <div>
                                    <h4 class="patient-name">Nama Pasien : {{ $item->pasien->user->name }}</h4>
                                    <p class="patient-id">Keluhan : {{ $item->keluhan }}</p>
                                </div>
                            </div>
                            <div class="examination-meta">
                                <p class="examination-date">Antrian ke - {{ $item->no_antrian }}</p>
                                <span class="examination-date"><strong>Pada {{ $item->jadwalPeriksa->hari }}
                                        ({{ $item->jadwalPeriksa->jam_mulai }} - {{ $item->jadwalPeriksa->jam_selesai }})
                                    </strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-illustration">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3 class="empty-title">Tidak ada pasien dalam antrian pemeriksaan saat ini.</h3>
                        <p class="empty-description">Silahkan tunggu pasien yang mendaftar atau cek jadwal poli Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Modal Pemeriksaan --}}
    <div id="modalPemeriksaan" class="modal">
        <div class="modal-content">
            <span class="close" onclick="tutupModal()">&times;</span>
            <h5 id="modalNamaPasien">Nama Pasien</h5>

            <form action="{{ route('dokter.periksa.store') }}" method="POST" id="formPemeriksaan">
                @csrf
                <input type="hidden" id="modalPoliId" name="id_daftar_poli">

                <div class="mb-3">
                    <label for="tgl_periksa" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Periksa:</label>
                    <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control" required
                        value="{{ date('Y-m-d') }}">
                    @error('tgl_periksa')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="catatan" class="block text-gray-700 text-sm font-bold mb-2">Catatan Pemeriksaan:</label>
                    <textarea name="catatan" id="catatan" rows="3" class="form-control" required>{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3 checkbox-group">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Obat:</label>
                    @if ($obats->isEmpty())
                        <p class="text-gray-600 text-sm">Tidak ada obat tersedia.</p>
                    @else
                        @foreach ($obats as $obat)
                            <div class="checkbox-item">
                                <input type="checkbox" name="obat_ids[]" id="obat_{{ $obat->id }}"
                                    value="{{ $obat->id }}"
                                    {{ in_array($obat->id, old('obat_ids', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300">
                                <label for="obat_{{ $obat->id }}" class="ml-2 text-gray-700">{{ $obat->nama_obat }}
                                    (Rp {{ number_format($obat->harga, 0, ',', '.') }})
                                </label>
                            </div>
                        @endforeach
                    @endif
                    @error('obat_ids')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    @error('obat_ids.*')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" class="btn btn-secondary" onclick="tutupModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<script>
    function bukaModal(poliId, namaPasien) {
        const modal = document.getElementById('modalPemeriksaan');
        document.getElementById('modalNamaPasien').textContent = `Pemeriksaan - ${namaPasien}`;
        document.getElementById('modalPoliId').value = poliId;
        modal.style.display = 'flex';
    }

    function tutupModal() {
        document.getElementById('modalPemeriksaan').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalPemeriksaan');
        if (event.target === modal) {
            modal.style.display = "none";
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
        display: flex;
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
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 10px;
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
