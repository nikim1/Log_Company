<div class="modal fade" id="assignCourierModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-plus me-2" style="color: #667eea;"></i>
                    Назначи куриер
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('assign-courier', ':id') }}" id="assignCourierForm">
                    @csrf

                    <div class="mb-3" id="courierField">
                        <select class="form-select form-select-lg rounded-3" id="courier_id" name="courier_id">
                            <option value="">Изберете куриер</option>
                            @foreach($couriers ?? [] as $courier)
                            <option value="{{ $courier->id }}">
                                {{ $courier->user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-check-circle me-2"></i>Назначи
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
    function assignCourier(shipment) {
        const form = document.getElementById('assignCourierForm');
        form.action = form.action.replace(':id', shipment.id);

        new bootstrap.Modal(document.getElementById('assignCourierModal')).show();
    }

    $('#assignCourierModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>