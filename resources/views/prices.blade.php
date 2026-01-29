@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Цени на пратки</h1>
        <p class="text-muted">Прегледайте нашите тарифи за изпращане на пратки.</p>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Price per kg -->
        <div class="col-md-6 col-lg-4">
            <div class="card rounded-4 shadow-sm border-0 text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-box-seam fs-1" style="color:#667eea;"></i>
                </div>
                <h3 class="fw-bold mb-2">2.00лв/кг</h3>
                <p class="text-muted mb-0">Цена на килограм за пратки</p>
            </div>
        </div>

        <!-- Office Delivery Fee -->
        <div class="col-md-6 col-lg-4">
            <div class="card rounded-4 shadow-sm border-0 text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-building fs-1" style="color:#38b000;"></i>
                </div>
                <h3 class="fw-bold mb-2">1.50лв</h3>
                <p class="text-muted mb-0">Такса за доставка до офис</p>
            </div>
        </div>

        <!-- Address Delivery Fee -->
        <div class="col-md-6 col-lg-4">
            <div class="card rounded-4 shadow-sm border-0 text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-house fs-1" style="color:#ff6b6b;"></i>
                </div>
                <h3 class="fw-bold mb-2">3.50лв</h3>
                <p class="text-muted mb-0">Такса за доставка до адрес</p>
            </div>
        </div>

        <!-- Minimum Price -->
        <div class="col-md-6 col-lg-4">
            <div class="card rounded-4 shadow-sm border-0 text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-cash fs-1" style="color:#ffd60a;"></i>
                </div>
                <h3 class="fw-bold mb-2">5.00лв</h3>
                <p class="text-muted mb-0">Минимална цена на пратка</p>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <h5>Как се изчислява цената на пратка?</h5>
        <p class="text-muted">
            Цена = (Тегло на пратката × Цена на кг) + Такса за доставка<br>
            <strong>Такса за доставка:</strong> До офис: 1.50лв, До адрес: 3.50лв<br>
            Ако изчислената цена е по-малка от минималната цена (5.00лв), тогава се прилага минималната цена.
        </p>
    </div>
</div>
@endsection