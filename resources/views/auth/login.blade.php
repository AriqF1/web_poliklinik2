@extends('auth.app')
@section('title', 'PoliCare | Login')
@section('content-login')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2>Selamat Datang Kembali!</h2>
    <p class="text-muted mb-4">Masukkan Akun Anda.</p>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="form-group">
            <label for="login-email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Masukkan Email"
                    value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="login-password" class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" id="login-password" name="password"
                    placeholder="Masukkan Password" required>
            </div>
        </div>

        <div class=" row mb-4">
            <div class="col-6"></div>
            <div class="col-6 text-end">
                <a href="#" class="text-decoration-none">Lupa Password?</a>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-4">LogIn</button>
    </form>
    <div class="text-center">
        <p>Belum Punya Akun?</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                <i class="fas fa-user"></i> Daftar
            </a>
        </div>
    </div>
@endsection
