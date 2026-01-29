<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-pencil me-2" style="color: #667eea;"></i>
                    Редактирай профил
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('edit-profile') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-semibold">
                            <i class="bi bi-person me-1"></i>Име
                        </label>
                        <input type="text" class="form-control form-control-lg rounded-3" id="edit_name" name="name" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Имейл
                        </label>
                        <input type="email" class="form-control form-control-lg rounded-3" id="edit_email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-check-circle me-2"></i>Запази промените
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
    $('#editProfileModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>