<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-key me-2" style="color: #667eea;"></i>
                    Смяна на парола
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('change-password') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i>Текуща парола
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3" id="current_password" name="current_password" required>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1"></i>Нова парола
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3" id="new_password" name="password" required>
                        <small class="text-muted">Минимум 8 символа</small>
                    </div>

                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1"></i>Потвърди нова парола
                        </label>
                        <input type="password" class="form-control form-control-lg rounded-3" id="new_password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-check-circle me-2"></i>Смени паролата
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
    $('#changePasswordModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>