<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-building fs-2 text-primary"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $companies->count() }}</h3>
                <p class="text-muted mb-0">Компании</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-geo-alt fs-2 text-success"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $offices->count() }}</h3>
                <p class="text-muted mb-0">Офиси</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-people fs-2 text-warning"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $users->count() }}</h3>
                <p class="text-muted mb-0">Потребители</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-box-seam fs-2 text-info"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $shipments->count() }}</h3>
                <p class="text-muted mb-0">Пратки</p>
            </div>
        </div>
    </div>
</div>

<!-- Companies Table -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-building me-2" style="color: #667eea;"></i>Компании
            </h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#companyModal" onclick="resetCompanyForm()">
                <i class="bi bi-plus-circle me-2"></i>Добави компания
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Име</th>
                        <th class="py-3">Град</th>
                        <th class="py-3">Адрес</th>
                        <th class="py-3">Телефон</th>
                        <th class="py-3">Имейл</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td class="py-3">{{ $company->name }}</td>
                        <td class="py-3">{{ $company->city }}</td>
                        <td class="py-3">{{ $company->address }}</td>
                        <td class="py-3">{{ $company->phone }}</td>
                        <td class="py-3">{{ $company->email }}</td>
                        <td class="py-3">
                            <button class="btn btn-sm btn-outline-primary rounded-3" onclick='editCompany(@json($company))'>
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('delete-company', $company->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Сигурни ли сте?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Няма добавени компании</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Offices Table -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-geo-alt me-2" style="color: #667eea;"></i>Офиси
            </h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#officeModal" onclick="resetOfficeForm()">
                <i class="bi bi-plus-circle me-2"></i>Добави офис
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Име</th>
                        <th class="py-3">Град</th>
                        <th class="py-3">Адрес</th>
                        <th class="py-3">Телефон</th>
                        <th class="py-3">Компания</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offices as $office)
                    <tr>
                        <td class="py-3">{{ $office->name }}</td>
                        <td class="py-3">{{ $office->city }}</td>
                        <td class="py-3">{{ $office->address }}</td>
                        <td class="py-3">{{ $office->phone }}</td>
                        <td class="py-3">{{ $office->company->name }}</td>
                        <td class="py-3">
                            <button class="btn btn-sm btn-outline-primary rounded-3" onclick='editOffice(@json($office))'>
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('delete-office', $office->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Сигурни ли сте?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Няма добавени офиси</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-people me-2" style="color: #667eea;"></i>Потребители
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Име</th>
                        <th class="py-3">Имейл</th>
                        <th class="py-3">Роля</th>
                        <th class="py-3">Регистриран</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="py-3">{{ $user->name }}</td>
                        <td class="py-3">{{ $user->email }}</td>
                        <td class="py-3">
                            @if($user->hasRole('client'))
                            <span class="badge bg-danger">Клиент</span>
                            @elseif($user->hasRole('office worker'))
                            <span class="badge bg-primary">Офис служител</span>
                            @else
                            <span class="badge bg-success">Куриер</span>
                            @endif
                        </td>
                        <td class="py-3">{{ date('d.m.Y', strtotime($user->created_at)) }}</td>
                        <td class="py-3">
                            <form action="{{ route('delete-user', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Сигурни ли сте?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Няма потребители</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Shipments Table -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-box-seam me-2" style="color: #667eea;"></i>Пратки
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Подател</th>
                        <th class="py-3">Получател</th>
                        <th class="py-3">Тегло</th>
                        <th class="py-3">Цена</th>
                        <th class="py-3">Статус</th>
                        <th class="py-3">Изпратена на</th>
                        <th class="py-3">Доставена на</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shipments as $shipment)
                    <tr>
                        <td class="py-3">{{ $shipment->sender->user->name }}</td>
                        <td class="py-3">{{ $shipment->receiver->user->name }}</td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">{{ $shipment->price }} лв</td>
                        <td class="py-3">
                            <span class="badge bg-{{ $shipment->status == 'pending' ? 'secondary' : ($shipment->status == 'at_office' ? 'success' : 'warning') }}">
                                {{ $statuses[$shipment->status] }}
                            </span>
                        </td>
                        <td class="py-3">{{ date('d.m.Y', strtotime($shipment->created_at)) }}</td>
                        <td class="py-3">
                            @if($shipment->delivered_at)
                            {{ date('d.m.Y h:i', strtotime($shipment->delivered_at)) }}
                            @else
                            -
                            @endif
                        </td>
                        <td class="py-3">
                            <button class="btn btn-sm btn-outline-info rounded-3" onclick='showShipmentInfo(@json($shipment))'>
                                <i class="bi bi-info-circle"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Няма пратки</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('modals.add-edit-company-modal')
@include('modals.add-edit-office-modal')
@include('modals.shipment-info-modal')