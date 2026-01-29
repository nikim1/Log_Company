<div class="modal fade" id="companyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="companyModalLabel">
                    <i class="bi bi-building me-2" style="color: #667eea;"></i>
                    Добави компания
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="companyForm" method="POST" action="{{ route('save-company') }}">
                    @csrf
                    <input type="hidden" id="companyMethod" name="_method" value="">

                    <div class="mb-3">
                        <label for="company_name" class="form-label fw-semibold">
                            <i class="bi bi-building me-1"></i>Име на компанията
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="company_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_city" class="form-label fw-semibold">
                            <i class="bi bi-buildings me-1"></i>Град
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="company_city" name="city" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_address" class="form-label fw-semibold">
                            <i class="bi bi-geo-alt me-1"></i>Адрес
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="company_address" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_phone" class="form-label fw-semibold">
                            <i class="bi bi-telephone me-1"></i>Телефон
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="company_phone"
                            placeholder="08XXXXXXXX" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="company_email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Имейл адрес
                        </label>
                        <input type="email" class="form-control form-control-lg rounded-3" id="company_email"
                            placeholder="name@example.com" name="email" required>
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
    function resetCompanyForm() {
        document.getElementById('companyForm').reset();
        document.getElementById('companyForm').action = "{{ route('save-company') }}";
        document.getElementById('companyMethod').value = '';
        document.getElementById('companyModalLabel').textContent = 'Добави компания';
    }

    function editCompany(company) {
        document.getElementById('companyForm').action = `/save-company/${company.id}`;
        document.getElementById('companyMethod').value = 'PUT';
        document.getElementById('companyModalLabel').textContent = 'Редактирай компания';
        document.getElementById('company_name').value = company.name;
        document.getElementById('company_city').value = company.city;
        document.getElementById('company_address').value = company.address;
        document.getElementById('company_phone').value = company.phone;
        document.getElementById('company_email').value = company.email;
        new bootstrap.Modal(document.getElementById('companyModal')).show();
    }

    $('#companyModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>