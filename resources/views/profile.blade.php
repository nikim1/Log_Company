@extends('layouts.app')
@section('title', 'My profile')

@section('content')
<style>
    .btn:not(.btn-close):hover {
        transform: translateY(-2px);
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>

<div class="py-5" style="background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); min-height: 100vh;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <!-- Cover Image -->
                        <div class="position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 200px;">
                            <div class="position-absolute bottom-0 start-0 w-100 p-4">
                                <div class="d-flex align-items-end">
                                    <!-- Avatar -->
                                    <div class="position-relative">
                                        <div class="bg-white rounded-circle p-2 shadow-lg" style="width: 120px; height: 120px;">
                                            @if(Auth::user()->profile_image)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="rounded-circle w-100 h-100 object-fit-cover">
                                            @else
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center w-100 h-100">
                                                <i class="bi bi-person-fill fs-1 text-primary"></i>
                                            </div>
                                            @endif
                                        </div>
                                        <button class="position-absolute bottom-0 end-0 btn btn-sm btn-light rounded-circle p-2"
                                            data-bs-toggle="modal" data-bs-target="#uploadImageModal" title="Смени снимка">
                                            <i class="bi bi-camera-fill"></i>
                                        </button>
                                    </div>

                                    <!-- User Info -->
                                    <div class="ms-4 mb-3 text-white">
                                        <h2 class="fw-bold mb-1">{{ Auth::user()->name }}</h2>
                                        <p class="mb-0 opacity-75">
                                            <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Actions -->
                        <div class="p-4 bg-light">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-3">
                                        <i class="bi bi-{{ Auth::user()->hasRole('admin') ? 'shield-check' : (Auth::user()->hasRole(['courier', 'office worker']) ? 'briefcase' : 'person') }} me-1"></i>
                                        @if(Auth::user()->hasRole('admin'))
                                        Администратор
                                        @elseif(Auth::user()->hasRole('courier'))
                                        Куриер
                                        @elseif(Auth::user()->hasRole('office worker'))
                                        Офис служител
                                        @else
                                        Клиент
                                        @endif
                                    </span>
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-3 ms-2">
                                        <i class="bi bi-calendar-check me-1"></i>
                                        Присъединил се {{ date('d.m.Y', strtotime(Auth::user()->created_at)) }}
                                    </span>
                                </div>
                                <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="bi bi-pencil me-2"></i>Редактирай профил
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <!-- Security Card -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-shield-check me-2" style="color: #667eea;"></i>Сигурност
                        </h5>

                        <button class="btn btn-outline-primary w-100 rounded-3 mb-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="bi bi-key me-2"></i>Смяна на парола
                        </button>

                        <form action="{{ route('delete-profile') }}" method="POST" onsubmit="return confirm('Сигурни ли сте, че искате да изтриете акаунта си? Това действие е необратимо!');">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100 rounded-3">
                                <i class="bi bi-trash me-2"></i>Изтрий акаунт
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Activity -->
            @if(Auth::user()->hasRole('client'))
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="bi bi-info-circle me-2" style="color: #667eea;"></i>
                            Информация за акаунта
                        </h5>
                        <div class="p-3 bg-light rounded-3">
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-telephone me-1"></i>Телефон
                            </small>
                            <p class="mb-0 fw-semibold">{{ Auth::user()->client->phone }}</p>
                        </div>
                        <div class="p-3 bg-light rounded-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted d-block">
                                    <i class="bi bi-envelope me-1"></i>Адреси
                                </small>
                                <button class="btn btn-sm btn-outline-success add-btn" title="Добави адрес"
                                    data-bs-toggle="modal" data-bs-target="#clientAddressModal" onclick="resetClientAddressForm()">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </div>

                            @forelse($clientAddresses as $address)
                            <div class="address-item d-flex align-items-center mb-2" data-id="{{ $address->id }}">
                                <span class="flex-grow-1 address-text">{{ $address->city }}, {{ $address->address }}</span>

                                <button class="btn btn-sm btn-outline-primary ms-2 edit-btn" title="Редактиране"
                                    onclick='editClientAddress(@json($address))'>
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <form action="{{ route('delete-address', $address->id) }}" method="POST" class="ms-2 d-inline" onsubmit="return confirm('Сигурни ли сте че искате да изтриете този адрес?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Изтриване">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                            @empty
                            <p class="text-muted mb-0">Няма добавени адреси</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@include('modals.add-edit-client-address-modal')
@include('modals.edit-profile-modal')
@include('modals.change-profile-image-modal')
@include('modals.change-profile-password-modal')
@endsection

@section('script')
<script>
    function editClientAddress(address) {
        document.getElementById('addressForm').action = `/save-address/${address.id}`;
        document.getElementById('addressMethod').value = 'PUT';
        document.getElementById('addressModalTitle').textContent = 'Редактирай адрес';
        document.getElementById('addressInput').value = address.address;
        document.getElementById('cityInput').value = address.city;
        new bootstrap.Modal(document.getElementById('clientAddressModal')).show();
    }

    function resetClientAddressForm() {
        document.getElementById('addressForm').reset();
        document.getElementById('addressForm').action = "{{ route('save-address') }}";
        document.getElementById('addressMethod').value = '';
        document.getElementById('addressModalTitle').textContent = 'Добави адрес';
    }
</script>
@endsection