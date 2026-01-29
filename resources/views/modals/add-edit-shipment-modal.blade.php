<div class="modal fade" id="shipmentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-plus-circle me-2" style="color: #667eea;"></i>
                    Нова пратка
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('save-shipment') }}">
                    @csrf
                    <input type="hidden" id="shipmentMethod" name="_method" value="">

                    <div class="mb-3">
                        <label for="receiver_id" class="form-label fw-semibold">
                            <i class="bi bi-person me-1"></i>Получател
                        </label>
                        <select class="form-select form-select-lg rounded-3"
                            id="receiver_id" name="receiver_id" required>
                            <option value="">Изберете получател</option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}">
                                {{ $client->user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="send_type" class="form-label fw-semibold">
                                <i class="bi bi-box-seam me-1"></i>Тип изпращане
                            </label>
                            <select class="form-select form-select-lg rounded-3" id="send_type" name="send_type" required>
                                <option value="">Изберете</option>
                                <option value="office">От офис</option>
                                <option value="address">От адрес</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="send_office_field" style="display: none;">
                            <label for="send_office_id" class="form-label fw-semibold">Офис</label>
                            <select class="form-select form-select-lg rounded-3" id="send_office_id" name="send_office_id">
                                <option value="">Изберете офис</option>
                                @foreach($offices ?? [] as $office)
                                <option value="{{ $office->id }}">{{$office->city}}, {{ $office->address }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="send_address_field" style="display: none;">
                            <label for="send_address" class="form-label fw-semibold">Адрес</label>
                            <select class="form-select form-select-lg rounded-3" id="send_address" name="send_address">
                                <option value="">Изберете адрес</option>
                                @foreach($addresses ?? [] as $address)
                                <option value="{{ $address->id }}">{{ $address->city }}, {{ $address->address }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="delivery_type" class="form-label fw-semibold">
                                <i class="bi bi-truck me-1"></i>Тип доставка
                            </label>
                            <select class="form-select form-select-lg rounded-3" id="delivery_type" name="delivery_type" required>
                                <option value="">Изберете</option>
                                <option value="office">До офис</option>
                                <option value="address">До адрес</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="delivery_office_field" style="display: none;">
                            <label for="delivery_office_id" class="form-label fw-semibold">Офис</label>
                            <select class="form-select form-select-lg rounded-3" id="delivery_office_id" name="delivery_office_id">
                                <option value="">Изберете офис</option>
                                @foreach($offices ?? [] as $office)
                                <option value="{{ $office->id }}">{{$office->city}}, {{ $office->address }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3" id="delivery_address_field" style="display: none;">
                            <label for="delivery_address" class="form-label fw-semibold">Адрес</label>
                            <select class="form-select form-select-lg rounded-3" id="delivery_address" name="delivery_address">
                                <option value="">Изберете адрес</option>
                                @foreach($addresses ?? [] as $address)
                                <option value="{{ $address->id }}">{{ $address->city }}, {{ $address->address }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="weight" class="form-label fw-semibold">
                            <i class="bi bi-speedometer me-1"></i>Тегло (кг)
                        </label>
                        <input type="number" class="form-control form-control-lg rounded-3" id="weight"
                            name="weight" step="0.1" min="0.1" placeholder="1.5" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" id="submit_shipment" class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-send me-2"></i>Създай пратка
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">
                            Отказ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Send type toggle
    document.getElementById('send_type')?.addEventListener('change', function() {
        const sendOfficeField = document.getElementById('send_office_field');
        const sendAddressField = document.getElementById('send_address_field');

        if (this.value == 'office') {
            sendOfficeField.style.display = 'block';
            sendAddressField.style.display = 'none';
            document.getElementById('send_office_id').required = true;
            document.getElementById('send_address').required = false;
        } else if (this.value == 'address') {
            sendOfficeField.style.display = 'none';
            sendAddressField.style.display = 'block';
            document.getElementById('send_office_id').required = false;
            document.getElementById('send_address').required = true;
        }
    });

    // Delivery type toggle
    document.getElementById('delivery_type')?.addEventListener('change', function() {
        const deliveryOfficeField = document.getElementById('delivery_office_field');
        const deliveryAddressField = document.getElementById('delivery_address_field');

        if (this.value == 'office') {
            deliveryOfficeField.style.display = 'block';
            deliveryAddressField.style.display = 'none';
            document.getElementById('delivery_office_id').required = true;
            document.getElementById('delivery_address').required = false;
        } else if (this.value == 'address') {
            deliveryOfficeField.style.display = 'none';
            deliveryAddressField.style.display = 'block';
            document.getElementById('delivery_office_id').required = false;
            document.getElementById('delivery_address').required = true;
        }
    });

    function editShipment(shipment) {
        console.log(shipment, shipment.send_shipment);
        const form = document.querySelector('#shipmentModal form');
        form.action = `/save-shipment/${shipment.id}`;

        let methodInput = document.getElementById('shipmentMethod');
        methodInput.value = 'POST';

        document.querySelector('#shipmentModal .modal-title').textContent = 'Редактирай пратка';
        document.getElementById('submit_shipment').innerHTML = '<i class="bi bi-send me-2"></i>Запази';
        document.getElementById('receiver_id').value = shipment.receiver_id || '';
        document.getElementById('weight').value = shipment.weight || '';
        document.getElementById('send_type').value = shipment.send_shipment.sender_type || '';
        document.getElementById('delivery_type').value = shipment.receive_shipment.delivery_type || '';

        // Show/hide fields depending on type
        const sendOfficeField = document.getElementById('send_office_field');
        const sendAddressField = document.getElementById('send_address_field');
        if (shipment.send_shipment.sender_type == 'office') {
            sendOfficeField.style.display = 'block';
            sendAddressField.style.display = 'none';
            document.getElementById('send_office_id').required = true;
            document.getElementById('send_address').required = false;
            document.getElementById('send_office_id').value = shipment.send_shipment.office_id || '';
        } else if (shipment.send_shipment.sender_type == 'address') {
            sendOfficeField.style.display = 'none';
            sendAddressField.style.display = 'block';
            document.getElementById('send_office_id').required = false;
            document.getElementById('send_address').required = true;
            document.getElementById('send_address').value = shipment.send_shipment.address_id || '';
        }

        const deliveryOfficeField = document.getElementById('delivery_office_field');
        const deliveryAddressField = document.getElementById('delivery_address_field');
        if (shipment.receive_shipment.delivery_type == 'office') {
            deliveryOfficeField.style.display = 'block';
            deliveryAddressField.style.display = 'none';
            document.getElementById('delivery_office_id').required = true;
            document.getElementById('delivery_address').required = false;
            document.getElementById('delivery_office_id').value = shipment.receive_shipment.office_id || '';
        } else if (shipment.receive_shipment.delivery_type == 'address') {
            deliveryOfficeField.style.display = 'none';
            deliveryAddressField.style.display = 'block';
            document.getElementById('delivery_office_id').required = false;
            document.getElementById('delivery_address').required = true;
            document.getElementById('delivery_address').value = shipment.receive_shipment.address_id || '';
        }

        new bootstrap.Modal(document.getElementById('shipmentModal')).show();
    }


    $('#shipmentModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>