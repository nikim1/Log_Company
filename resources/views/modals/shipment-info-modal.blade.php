<div class="modal fade" id="shipmentInfoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-info-circle me-2" style="color: #667eea;"></i>
                    Информация за пратка
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <h6 class="fw-bold">🚚 Изпращане</h6>
                <p><strong>Тип:</strong> <span id="sender_type"></span></p>
                <p id="sender_office_row">
                    <strong>Офис:</strong> <span id="sender_office"></span>
                </p>
                <p id="sender_address_row">
                    <strong>Адрес:</strong> <span id="sender_address"></span>
                </p>
                <hr>
                <h6 class="fw-bold">📍 Доставка</h6>
                <p><strong>Тип:</strong> <span id="delivery_type"></span></p>
                <p id="delivery_office_row">
                    <strong>Офис:</strong> <span id="delivery_office"></span>
                </p>
                <p id="delivery_address_row">
                    <strong>Адрес:</strong> <span id="delivery_address"></span>
                </p>
                <p id="delivery_courier_row">
                    <strong>Куриер:</strong> <span id="delivery_courier"></span>
                </p>
                <hr>
                <h6 class="fw-bold">🧾 Регистрация</h6>
                <p><strong>Регистрирана от:</strong> <span id="registered_by"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
    function showShipmentInfo(shipment) {
        // Sender
        const sender = shipment.send_shipment;

        document.getElementById('sender_type').textContent = sender.sender_type == 'office' ? "Офис" : "Адрес";

        document.getElementById('sender_office_row').style.display = 'none';
        document.getElementById('sender_address_row').style.display = 'none';

        if (sender.sender_type == 'office') {
            document.getElementById('sender_office').textContent = `${sender.office.city}, ${sender.office.address}` ?? '-';
            document.getElementById('sender_office_row').style.display = 'block';
        } else {
            document.getElementById('sender_address').textContent = `${sender.address.city}, ${sender.address.address}` ?? '-';
            document.getElementById('sender_address_row').style.display = 'block';
        }

        // Receiver
        const receiver = shipment.receive_shipment;

        document.getElementById('delivery_type').textContent = receiver.delivery_type == 'office' ? "Офис" : "Адрес";

        document.getElementById('delivery_office_row').style.display = 'none';
        document.getElementById('delivery_address_row').style.display = 'none';
        document.getElementById('delivery_courier_row').style.display = 'none';

        if (receiver.delivery_type == 'office') {
            document.getElementById('delivery_office').textContent = `${receiver.office.city}, ${receiver.office.address}` ?? '-';
            document.getElementById('delivery_office_row').style.display = 'block';
        } else {
            document.getElementById('delivery_address').textContent = `${receiver.address.city}, ${receiver.address.address}` ?? '-';
            document.getElementById('delivery_courier').textContent = receiver.courier?.user.name ?? '-';

            document.getElementById('delivery_address_row').style.display = 'block';
            document.getElementById('delivery_courier_row').style.display = 'block';
        }

        // Registered
        document.getElementById('registered_by').textContent = shipment.registered_by?.user.name ?? '-';
        console.log(shipment, receiver);

        new bootstrap.Modal(document.getElementById('shipmentInfoModal')).show();
    }
</script>