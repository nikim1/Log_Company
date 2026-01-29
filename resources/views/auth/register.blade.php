@extends('layouts.app')

@section('title', 'Регистрация')

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
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Header -->
                    <div class="card-header text-white text-center py-4 border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-person-plus fs-1 mb-3 d-block"></i>
                        <h3 class="fw-bold mb-1">Създайте акаунт</h3>
                        <p class="mb-0 opacity-75">Присъединете се към нашата платформа</p>
                    </div>

                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bi bi-person me-1"></i>Име и фамилия
                                </label>
                                <input type="text"
                                    class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Иван Иванов"
                                    required autofocus>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope me-1"></i>Имейл адрес
                                </label>
                                <input type="email"
                                    class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="role" class="form-label fw-semibold">
                                    <i class="bi bi-person-badge me-1"></i>Роля
                                </label>
                                <select
                                    class="form-select form-select-lg rounded-3 @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                    <option value="" selected disabled>Изберете роля</option>
                                    <option value="courier" @if(old('role')=='courier' ) selected @endif>Куриер</option>
                                    <option value="office worker" @if(old('role')=='office worker' ) selected @endif>Офис-служител</option>
                                    <option value="client" @if(old('role')=='client' ) selected @endif>Клиент</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4" id="company-dropdown">
                                <label for="company" class="form-label fw-semibold">
                                    <i class="bi bi-buildings me-1"></i>Компания
                                </label>
                                <select id="company" class="form-select" name="company">
                                    <option value="" selected disabled>Изберете компания</option>
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4" id="office-dropdown">
                                <label for="office" class="form-label fw-semibold">
                                    <i class="bi bi-building me-1"></i>Офис
                                </label>
                                <select id="office" class="form-select" name="office" disabled>
                                    <option value="" selected disabled>Изберете офис</option>
                                </select>
                            </div>

                            <div class="mb-4" id="phone-field" style="display: none;">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="bi bi-telephone me-1"></i>Телефонен номер </label>
                                <input type="text" class="form-control form-control-lg rounded-3 @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}" placeholder="08XXXXXXXX">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="bi bi-lock me-1"></i>Парола
                                    </label>
                                    <input type="password"
                                        class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="••••••••" required>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Минимум 8 символа</small>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold">
                                        <i class="bi bi-lock-fill me-1"></i>Потвърдете парола
                                    </label>
                                    <input type="password" class="form-control form-control-lg rounded-3" id="password_confirmation"
                                        name="password_confirmation" placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-lg w-100 text-white rounded-3 shadow-sm mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="bi bi-person-plus me-2"></i>Регистрация
                            </button>
                        </form>

                        <!-- Security Info -->
                        <div class="mt-4 p-3 bg-light rounded-3">
                            <div class="row text-center">
                                <div class="col-4">
                                    <i class="bi bi-shield-check fs-4" style="color: #667eea;"></i>
                                    <p class="small mb-0 mt-2">Сигурност</p>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-lightning-charge fs-4" style="color: #667eea;"></i>
                                    <p class="small mb-0 mt-2">Бързо</p>
                                </div>
                                <div class="col-4">
                                    <i class="bi bi-hand-thumbs-up fs-4" style="color: #667eea;"></i>
                                    <p class="small mb-0 mt-2">Лесно</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center py-4 bg-light border-0">
                        <p class="mb-0">
                            Вече имате акаунт?
                            <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color: #667eea;">
                                Влезте тук
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const officesByCompany = @json($officesByCompany);

        const roleSelect = document.getElementById('role');
        const phoneField = document.getElementById('phone-field');

        const companyWrapper = document.getElementById('company-dropdown');
        const officeWrapper = document.getElementById('office-dropdown');

        const companySelect = document.getElementById('company');
        const officeSelect = document.getElementById('office');

        function toggleFields() {
            const role = roleSelect.value;

            // phone field - only for client
            phoneField.style.display = role === 'client' ? 'block' : 'none';

            // office - only for office worker
            if (role === 'office worker') {
                officeWrapper.style.display = 'block';
                officeSelect.required = true;
            } else {
                officeWrapper.style.display = 'none';
                officeSelect.required = false;
                officeSelect.value = '';
                officeSelect.disabled = true;
            }
        }

        companySelect.addEventListener('change', function() {
            if (roleSelect.value !== 'office worker') return;

            const companyId = companySelect.value;
            const offices = officesByCompany[companyId] || [];

            officeSelect.innerHTML = '<option value="" selected disabled>Изберете офис</option>';

            offices.forEach(office => {
                const option = document.createElement('option');
                option.value = office.id;
                option.textContent = office.name + '; ' + office.city + '; ' + office.address;
                officeSelect.appendChild(option);
            });

            officeSelect.disabled = false;
        });

        roleSelect.addEventListener('change', toggleFields);

        toggleFields();
    });
</script>
@endsection