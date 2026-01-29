@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }

    .min-vh-75 {
        min-height: 75vh;
    }
</style>

<div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 90vh;">
    <div class="container py-5">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-6 text-white">
                <h1 class="display-3 fw-bold mb-4">Логистична Компания</h1>
                <p class="lead mb-4 fs-4">Управлявайте пратки, офиси и клиенти ефективно с нашата модерна платформа</p>

                <div class="d-flex gap-3 mb-4">
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 py-3 rounded-3 shadow">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Вход
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 py-3 rounded-3">
                        <i class="bi bi-person-plus me-2"></i>Регистрация
                    </a>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="position-relative">
                    <img src="{{ asset('storage/site_images/welcome.jpg') }}" class="img-fluid rounded-4 shadow-lg" style="transform: rotate(-2deg);">
                </div>
            </div>
        </div>
    </div>

    <!-- Curve -->
    <div class="bg-white position-absolute bottom-0 start-0 w-100" style="height:80px; border-radius:50% 50% 0 0;"></div>
</div>

<!-- Features -->
<div class="container py-5 my-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Нашите Услуги</h2>
        <p class="text-muted fs-5">Бърза и надеждна доставка на вашите пратки</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="bi bi-truck fs-1 text-primary"></i>
                    </div>
                    <h4 class="card-title mb-3">Бърза Доставка</h4>
                    <p class="card-text text-muted">Доставяме вашите пратки бързо и сигурно до всяка точка на страната</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="bi bi-geo-alt fs-1 text-success"></i>
                    </div>
                    <h4 class="card-title mb-3">Проследяване</h4>
                    <p class="card-text text-muted">Следете статуса на вашите пратки в реално време</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 hover-lift">
                <div class="card-body text-center p-4">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="bi bi-shield-check fs-1 text-warning"></i>
                    </div>
                    <h4 class="card-title mb-3">Сигурност</h4>
                    <p class="card-text text-muted">Гарантираме безопасността на всяка изпратена пратка</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-primary mb-2">500+</h2>
                    <p class="text-muted mb-0">Доставки на ден</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-primary mb-2">50+</h2>
                    <p class="text-muted mb-0">Офиси</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-primary mb-2">1000+</h2>
                    <p class="text-muted mb-0">Клиенти</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <h2 class="display-4 fw-bold text-primary mb-2">24/7</h2>
                    <p class="text-muted mb-0">Поддръжка</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection