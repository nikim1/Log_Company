@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(102, 126, 234, 0.3) !important;
    }
</style>
<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header text-white text-center py-4 border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-box-arrow-in-right fs-1 mb-3 d-block"></i>
                        <h3 class="fw-bold mb-1">Добре дошли отново!</h3>
                        <p class="mb-0 opacity-75">Влезте във вашия акаунт</p>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1"></i>Имейл адрес
                                </label>
                                <input type="email"
                                    class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com"
                                    required autofocus>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock me-1"></i>Парола
                                </label>
                                <input type="password"
                                    class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="••••••••" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-lg w-100 text-white rounded-3 shadow-sm mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Вход
                            </button>
                        </form>
                    </div>

                    <div class="card-footer text-center py-2 bg-light border-0">
                        <p class="mb-0">
                            Нямате акаунт?
                            <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: #667eea;">
                                Регистрирайте се
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="text-center mt-4">
                    <p class="text-muted mb-2">
                        <i class="bi bi-shield-check me-1"></i>
                        Вашите данни са защитени
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection