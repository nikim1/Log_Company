<!-- Statistics -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-truck fs-2 text-warning"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $assignedShipments->count() }}</h3>
                <p class="text-muted mb-0">За доставка</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-check-circle fs-2 text-success"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $deliveredShipments->count() }}</h3>
                <p class="text-muted mb-0">Доставени</p>
            </div>
        </div>
    </div>
</div>

<!-- Assigned Shipments - Pending Delivery -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-truck me-2" style="color: #667eea;"></i>Пратки за доставка
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Подател</th>
                        <th class="py-3">Получател</th>
                        <th class="py-3">Адрес за доставка</th>
                        <th class="py-3">Тегло</th>
                        <th class="py-3">Назначена на</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignedShipments as $shipment)
                    <tr>
                        <td class="py-3">
                            <div>{{ $shipment->sender->user->name }}</div>
                            <small class="text-muted">Тел: {{ $shipment->sender->phone }}</small>
                        </td>
                        <td class="py-3">
                            <div>{{ $shipment->receiver->user->name }}</div>
                            <small class="text-muted">Тел: {{ $shipment->receiver->phone }}</small>
                        </td>
                        <td class="py-3">
                            @if($shipment->delivery_type == 'office')
                            <span>Офис: {{ $shipment->receiveShipment->office->city }}, {{ $shipment->receiveShipment->office->address }}</span>
                            @else
                            <span>{{ $shipment->receiveShipment->address->city }}, {{ $shipment->receiveShipment->address->address }}</span>
                            @endif
                        </td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">{{ date('d.m.Y', strtotime($shipment->updated_at)) }}</td>
                        <td class="py-3">
                            @if($shipment->status != 'in_transit')
                            <form action="{{ route('shipment-accepted', $shipment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary rounded-3" onclick="return confirm('Потвърдете поемането на пратката')">
                                    <i class="bi bi-check-circle me-1"></i>Поета
                                </button>
                            </form>
                            @else
                            <form action="{{ route('deliver-shipment', $shipment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success rounded-3" onclick="return confirm('Потвърдете доставката на пратката')">
                                    <i class="bi bi-check-circle me-1"></i>Доставена
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Нямате пратки за доставка</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delivered Shipments Today -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-check-circle me-2" style="color: #667eea;"></i>Доставени пратки
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Подател</th>
                        <th class="py-3">Получател</th>
                        <th class="py-3">Адрес</th>
                        <th class="py-3">Тегло</th>
                        <th class="py-3">Доставена на</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deliveredShipments as $shipment)
                    <tr>
                        <td class="py-3">{{ $shipment->sender->user->name }}</td>
                        <td class="py-3">{{ $shipment->receiver->user->name }}</td>
                        <td class="py-3">
                            @if($shipment->delivery_type == 'office')
                            <span>Офис: {{ $shipment->receiveShipment->office->city }}, {{ $shipment->receiveShipment->office->address }}</span>
                            @else
                            <span>{{ $shipment->receiveShipment->address->city }}, {{ $shipment->receiveShipment->address->address }}</span>
                            @endif
                        </td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">
                            <span class="badge bg-success">
                                {{ date('d.m.Y h:i', strtotime($shipment->delivered_at)) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Няма доставени пратки</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>