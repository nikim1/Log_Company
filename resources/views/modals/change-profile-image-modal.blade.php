<div class="modal fade" id="uploadImageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-camera me-2" style="color: #667eea;"></i>
                    Смени профилна снимка
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('profile-image-update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="profile_image" class="form-label fw-semibold">
                            <i class="bi bi-image me-1"></i>Избери снимка
                        </label>
                        <input type="file" class="form-control form-control-lg rounded-3" id="profile_image" name="profile_image" accept="image/*" required>
                        <small class="text-muted">Максимален размер: 2MB. Формати: JPG, PNG, GIF</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3">
                            <i class="bi bi-upload me-2"></i>Качи снимка
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
    $('#uploadImageModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>