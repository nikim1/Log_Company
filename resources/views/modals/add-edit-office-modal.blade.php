<div class="modal fade" id="officeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="officeModalLabel">
                    <i class="bi bi-geo-alt me-2" style="color: #667eea;"></i>
                    Добави офис
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="officeForm" method="POST" action="{{ route('save-office') }}">
                    @csrf
                    <input type="hidden" id="officeMethod" name="_method" value="">

                    <div class="mb-3">
                        <label for="office_company_id" class="form-label fw-semibold">
                            <i class="bi bi-building me-1"></i>Компания
                        </label>
                        <select class="form-select form-select-lg rounded-3" id="office_company_id" name="company_id" required>
                            <option value="">Изберете компания</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="office_name" class="form-label fw-semibold">
                            <i class="bi bi-briefcase me-1"></i>Име
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="office_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="office_city" class="form-label fw-semibold">
                            <i class="bi bi-buildings me-1"></i>Град
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="office_city" name="city" required>
                    </div>

                    <div class="mb-3">
                        <label for="office_address" class="form-label fw-semibold">
                            <i class="bi bi-geo-alt me-1"></i>Адрес
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="office_address" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="office_phone" class="form-label fw-semibold">
                            <i class="bi bi-telephone me-1"></i>Телефон
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="office_phone" name="phone" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-check-circle me-2"></i>Запази
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
    function resetOfficeForm() {
        document.getElementById('officeForm').reset();
        document.getElementById('officeForm').action = "{{ route('save-office') }}";
        document.getElementById('officeMethod').value = '';
        document.getElementById('officeModalLabel').textContent = 'Добави офис';
    }

    function editOffice(office) {
        document.getElementById('officeForm').action = `/save-office/${office.id}`;
        document.getElementById('officeMethod').value = 'PUT';
        document.getElementById('officeModalLabel').textContent = 'Редактирай офис';
        document.getElementById('office_company_id').value = office.company_id;
        document.getElementById('office_name').value = office.name;
        document.getElementById('office_phone').value = office.city;
        document.getElementById('office_address').value = office.address;
        document.getElementById('office_phone').value = office.phone;
        new bootstrap.Modal(document.getElementById('officeModal')).show();
    }

    $('#officeModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>