<!-- Statistics -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-box-seam fs-2 text-primary"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $sentShipments->count() }}</h3>
                <p class="text-muted mb-0">Изпратени пратки</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-inbox fs-2 text-success"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $receivedShipments->count() }}</h3>
                <p class="text-muted mb-0">Получени пратки</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-clock-history fs-2 text-warning"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $sentShipments->where('status', '!=', 'delivered')->count(); }}</h3>
                <p class="text-muted mb-0">В процес</p>
            </div>
        </div>
    </div>
</div>

<!-- Sent Shipments -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-send me-2" style="color: #667eea;"></i>Изпратени пратки
            </h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#shipmentModal">
                <i class="bi bi-plus-circle me-2"></i>Нова пратка
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Получател</th>
                        <th class="py-3">Доставка</th>
                        <th class="py-3">Тегло</th>
                        <th class="py-3">Цена</th>
                        <th class="py-3">Статус</th>
                        <th class="py-3">Изпратена на</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sentShipments as $shipment)
                    <tr>
                        <td class="py-3">{{ $shipment->receiver->user->name }}</td>
                        <td class="py-3">
                            @if($shipment->receiveShipment->delivery_type == 'office')
                            <span class="badge bg-info">Офис</span>
                            @else
                            <span class="badge bg-primary">Адрес</span>
                            @endif
                        </td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">{{ number_format($shipment->price, 2) }} лв</td>
                        <td class="py-3">
                            <span class="badge bg-{{ $shipment->status == 'pending' ? 'secondary' : ($shipment->status == 'at_office' ? 'success' : 'warning') }}">
                                {{ $statuses[$shipment->status] }}
                            </span>
                        </td>
                        <td class="py-3">{{ date('d.m.Y', strtotime($shipment->created_at)) }}</td>
                        <td class="py-3">
                            @if($shipment->status == 'pending')
                            <button type="submit" class="btn btn-sm btn-outline-primary rounded-3" onclick='editShipment(@json($shipment))'>
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('delete-shipment', $shipment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" onclick="return confirm('Сигурни ли сте?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Нямате изпратени пратки</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Received Shipments -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-inbox me-2" style="color: #667eea;"></i>Получени пратки
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Подател</th>
                        <th class="py-3">Доставка</th>
                        <th class="py-3">Тегло</th>
                        <th class="py-3">Получена на</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($receivedShipments as $shipment)
                    <tr>
                        <td class="py-3">{{ $shipment->sender->user->name }}</td>
                        <td class="py-3">
                            @if($shipment->receiveShipment->delivery_type == 'office')
                            Офис: {{ $shipment->receiveShipment->office->city}}, {{ $shipment->receiveShipment->office->address}}
                            @else
                            Адрес: {{ $shipment->receiveShipment->address->city}}, {{ $shipment->receiveShipment->address->address}}
                            @endif
                        </td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">
                            @if($shipment->delivered_at)
                            {{ date('d.m.Y h:i', strtotime($shipment->delivered_at)) }}
                            @else
                            -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Нямате получени пратки</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('modals.add-edit-shipment-modal')