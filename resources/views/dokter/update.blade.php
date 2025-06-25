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
                <h1 class="header-title">Update Data Dokter</h1>
                <p class="header-subtitle">Selamat datang {{ $dokter->name }}, silahkan update data diri anda</p>
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

            <a href="#profile-update-section" class="stat-card info">
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
    <div>
        <div class="profile-update-section" id="profile-update-section">
            <div class="section-header">
                <h3 class="section-title">
                    <i class="fas fa-edit me-2"></i>
                    Form Update Profil Dokter
                </h3>
            </div>
            <div class="form-container">
                <form action="{{ route('dokter.profile.store') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <input type="text" id="alamat" name="alamat"
                            value="{{ old('alamat', auth()->user()->dokter->alamat ?? '') }}">
                        @error('alamat')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP:</label>
                        <input type="text" id="no_hp" name="no_hp"
                            value="{{ old('no_hp', auth()->user()->dokter->no_hp ?? '') }}">
                        @error('no_hp')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="poli_id">Poli:</label>
                        <select id="poli_id" name="poli_id" class="form-select">
                            @foreach ($polis as $poli)
                                <option value="{{ $poli->id }}" {{ (auth()->user()->dokter->poli_id ?? '') == $poli->id ? 'selected' : '' }}>
                                    {{ $poli->nama_poli }}
                                </option>
                            @endforeach
                        </select>
                        @error('poli_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru:</label>
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin ubah">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<style>
    .profile-update-section {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
    }

    .profile-update-section .section-header {
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .profile-update-section .section-title {
        font-size: 1.5rem;
        color: #333;
        display: flex;
        align-items: center;
    }

    .profile-update-section .section-title i {
        color: var(--primary-color);
    }

    .form-container .form-group {
        margin-bottom: 20px;
    }

    .form-container label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="password"],
    .form-container select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        color: #333;
        transition: border-color 0.3s ease;
    }

    .form-container input[type="text"]:focus,
    .form-container input[type="email"]:focus,
    .form-container input[type="password"]:focus,
    .form-container select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
    }

    .form-container .btn-primary {
        background-color: var(--primary-color);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .form-container .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .alert.alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        padding: 8px 15px;
        margin-top: 5px;
        font-size: 0.875em;
    }
</style>