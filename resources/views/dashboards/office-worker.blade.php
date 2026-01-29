<!-- Statistics -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center p-4">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex p-3 mb-3">
                    <i class="bi bi-hourglass-split fs-2 text-warning"></i>
                </div>
                <h3 class="fw-bold mb-1">{{ $pendingShipments->count() }}</h3>
                <p class="text-muted mb-0">Чакащи пратки</p>
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
                <p class="text-muted mb-0">Доставени пратки</p>
            </div>
        </div>
    </div>
</div>

<!-- Pending Shipments - To be assigned -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white border-0 p-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-hourglass-split me-2" style="color: #667eea;"></i>Чакащи пратки
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3">Подател</th>
                        <th class="py-3">Получател</th>
                        <th class="py-3">Куриер</th>
                        <th class="py-3">Доставка</th>
                        <th class="py-3">Тегло</th>
                        <th class="py-3">Цена</th>
                        <th class="py-3">Дата</th>
                        <th class="py-3">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingShipments as $shipment)
                    <tr>
                        <td class="py-3">{{ $shipment->sender->user->name }}</td>
                        <td class="py-3">{{ $shipment->receiver->user->name }}</td>
                        <td class="py-3">
                            @if($shipment->receiveShipment->delivery_type == 'address' || $shipment->sendShipment->delivery_type == 'address')
                            <span>{{ $shipment->receiveShipment->courier->user->name }}</span>
                            @else
                            <span> - </span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($shipment->sendShipment->sender_type == 'office')
                            <span class="badge bg-info">Офис</span>
                            @else
                            <span class="badge bg-primary">Адрес</span>
                            @endif
                            ⇒
                            @if($shipment->receiveShipment->delivery_type == 'office')
                            <span class="badge bg-info">Офис</span>
                            @else
                            <span class="badge bg-primary">Адрес</span>
                            @endif
                        </td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">{{ number_format($shipment->price, 2) }} лв</td>
                        <td class="py-3">{{ date('d.m.Y', strtotime($shipment->created_at)) }}</td>
                        <td class="py-3">
                            @if($shipment->sendShipment->sender_type == 'office' && $shipment->receiveShipment->delivery_type == 'office')
                            <!-- If both sender and receiver are offices -->
                            <form action="{{ route('deliver-shipment', $shipment->id) }}" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success rounded-3">
                                    <i class="bi bi-send me-1"></i>Изпрати
                                </button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-primary rounded-3" onclick='assignCourier(@json($shipment))'
                                @if(($shipment->status != 'pending' && $shipment->sendShipment->sender_type == 'address') ||
                                ($shipment->status != 'at_office' && $shipment->sendShipment->sender_type == 'office')) disabled @endif>
                                <i class="bi bi-person-plus me-1"></i>Назначи куриер
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Няма чакащи пратки</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delivered Shipments -->
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
                        <th class="py-3">Куриер</th>
                        <th class="py-3">Доставка</th>
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
                            @if($shipment->receiveShipment->delivery_type == 'address' || $shipment->sendShipment->delivery_type == 'address')
                            <span>{{ $shipment->receiveShipment->courier->user->name }}</span>
                            @else
                            <span> - </span>
                            @endif
                        </td>
                        <td class="py-3">
                            @if($shipment->sendShipment->sender_type == 'office')
                            <span class="badge bg-info">Офис</span>
                            @else
                            <span class="badge bg-primary">Адрес</span>
                            @endif
                            ⇒
                            @if($shipment->receiveShipment->delivery_type == 'office')
                            <span class="badge bg-info">Офис</span>
                            @else
                            <span class="badge bg-primary">Адрес</span>
                            @endif
                        </td>
                        <td class="py-3">{{ $shipment->weight }} кг</td>
                        <td class="py-3">
                            {{ date('d.m.Y h:i', strtotime($shipment->delivered_at)) ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Няма доставени пратки</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('modals.assign-courier-modal')