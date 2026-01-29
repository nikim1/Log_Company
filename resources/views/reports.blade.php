@extends('layouts.app')
@section('title', 'Справки')
@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Справки за компанията</h2>

    <!-- Filter Form -->
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-body">
            <form method="GET" action="{{ route('reports') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="employee_id" class="form-label fw-semibold">Избери служител</label>
                    <select name="employee_id" id="employee_id" class="form-select">
                        <option value="">Всички</option>
                        @foreach($employees->where('position', 'office') as $employee)
                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="client_id" class="form-label fw-semibold">Избери клиент</label>
                    <select name="client_id" id="client_id" class="form-select">
                        <option value="">Всички</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Период</label>
                    <div class="d-flex gap-2">
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-funnel-fill me-1"></i>Филтрирай
                    </button>
                    <a href="{{ route('reports') }}" class="btn btn-outline-secondary">Изчисти</a>
                </div>
            </form>
        </div>
    </div>

    <!-- a. Всички служители -->
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Служители в компанията</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse($employees as $employee)
                <li class="list-group-item">{{ $employee->user->name }} ({{ $employee->position }})</li>
                @empty
                <li class="list-group-item text-muted">Няма служители</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- b. Всички клиенти -->
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Клиенти на компанията</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse($clients as $client)
                <li class="list-group-item">{{ $client->user->name }} ({{ $client->phone }})</li>
                @empty
                <li class="list-group-item text-muted">Няма клиенти</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- c. Всички регистрирани пратки -->
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Всички регистрирани пратки</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Подател</th>
                            <th>Получател</th>
                            <th>Регистрирана от</th>
                            <th>Тегло</th>
                            <th>Цена</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allShipments as $shipment)
                        <tr>
                            <td>{{ $shipment->sender->user->name }}</td>
                            <td>{{ $shipment->receiver->user->name }}</td>
                            <td>{{ $shipment->registeredBy->user->name ?? '-' }}</td>
                            <td>{{ $shipment->weight }} кг</td>
                            <td>{{ $shipment->price }} лв</td>
                            <td>{{ $statuses[$shipment->status] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted">Няма пратки</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- d. Пратки по служител -->
    @if(!empty($shipmentsByEmployee))
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Пратки регистрирани от служител</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Подател</th>
                            <th>Получател</th>
                            <th>Тегло</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($shipmentsByEmployee as $shipment)
                        <tr>
                            <td>{{ $shipment->sender->user->name }}</td>
                            <td>{{ $shipment->receiver->user->name }}</td>
                            <td>{{ $shipment->weight }} кг</td>
                            <td>{{ $statuses[$shipment->status] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted">Няма пратки</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- e. Пратки изпратени, но не доставени -->
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Пратки изпратени, но не доставени</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Подател</th>
                            <th>Получател</th>
                            <th>Тегло</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingDeliveries as $shipment)
                        <tr>
                            <td>{{ $shipment->sender->user->name }}</td>
                            <td>{{ $shipment->receiver->user->name }}</td>
                            <td>{{ $shipment->weight }} кг</td>
                            <td>{{ $statuses[$shipment->status] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted">Няма пратки</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- f. Всички пратки, които са изпратени от даден клиент  -->
    @if(!empty($shipmentsBySender))
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Пратки изпратени от клиента</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Получател</th>
                            <th>Тегло</th>
                            <th>Статус</th>
                            <th>Подадена</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($shipmentsBySender as $shipment)
                        <tr>
                            <td>{{ $shipment->receiver->user->name }}</td>
                            <td>{{ $shipment->weight }} кг</td>
                            <td>{{ $statuses[$shipment->status] }}</td>
                            <td>{{ date('d.m.Y h:i', strtotime($shipment->created_at)) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted">Няма пратки</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- g. Всички пратки, които са получени от даден клиент  -->
    @if(!empty($shipmentsByReceiver))
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Пратки получени от клиента</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Получател</th>
                            <th>Тегло</th>
                            <th>Статус</th>
                            <th>Подадена</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($shipmentsByReceiver as $shipment)
                        <tr>
                            <td>{{ $shipment->receiver->user->name }}</td>
                            <td>{{ $shipment->weight }} кг</td>
                            <td>{{ $statuses[$shipment->status] }}</td>
                            <td>{{ date('d.m.Y h:i', strtotime($shipment->created_at)) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted">Няма пратки</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- h. Приходи -->
    @if($request->start_date && $request->end_date)
    <div class="card mb-4 shadow-sm rounded-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">Приходи за периода ({{ date('d.m.y', strtotime($request->start_date)) }} - {{ date('d.m.y', strtotime($request->end_date)) }})</h5>
        </div>
        <div class="card-body">
            <h3 class="text-success">{{ number_format($revenue, 2) }} лв</h3>
        </div>
    </div>
    @endif
</div>
@endsection