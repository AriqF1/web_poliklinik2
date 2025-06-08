@php
    $showTables = false;
    $showFullscreen = false;
@endphp


@extends('layout.index')

@section('title', 'Dashboard Dokter')
@section('dashboard', 'Dokter')
@section('header')
    <h1>Dashboard Dokter</h1>
    <div class="user-info">
        <div class="user-avatar">
            <i class="fas fa-user-md"></i>
        </div>
        {{-- <div class="user-name">{{ $dokter->nama }}</div> --}}
    </div>

@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Pasien Anda</div>
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
        {{-- <div class="card-value">{{ $jumlahPasien }}</div> --}}
        <div class="card-label">Jumlah Antrian Pasien Anda</div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Janji Hari Ini</div>
            <div class="card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
        {{-- <div class="card-value">{{ $janjiTemu }}</div> --}}
        <div class="card-label">Janji temu </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Selesai</div>
            <div class="card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        {{-- <div class="card-value">{{ $jumlahPemeriksaan }}</div> --}}
        <div class="card-label">Total Pemeriksaan Selesai</div>
    </div>
@endsection
@section('table')


@endsection
