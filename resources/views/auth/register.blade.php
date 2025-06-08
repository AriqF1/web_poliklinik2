@extends('auth.app')
@section('title', 'PoliCare | Register')
@section('content-register')
    <h2>Buat Akun Baru</h2>
    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <div class="form-group">
            <label for="Nama" class="form-label">Nama</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" required>
            </div>
        </div>
        <div class="form-group">
            <label for="Alamat" class="form-label">Alamat</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-house"></i></span>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat"
                    required>
            </div>
        </div>
        <div class="form-group">
            <label for="No KTP" class="form-label">Nomor KTP</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan No. KTP"
                    required>
            </div>
        </div>
        <div class="form-group">
            <label for="Nomor Hp" class="form-label">Nomor Hp</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor "
                    required>
            </div>
        </div>

        <div class="form-group">
            <label for="Email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                    required>
            </div>
        </div>

        <div class="form-group">
            <label for="Password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="register-password" name="password"
                    placeholder="Masukkan password" required>
            </div>
            <div class="form-text">Minimal 8 karakter</div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-4"><span><i class="fa-solid fa-user-plus"></i> Buat
                Akun</span></button>
    </form>
@endsection
