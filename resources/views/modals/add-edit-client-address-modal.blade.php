<div class="modal fade" id="clientAddressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form id="addressForm" class="modal-content" method="POST" action="{{ route('save-address') }}">
            @csrf
            <input type="hidden" id="addressMethod" name="_method" value="">

            <div class="modal-header">
                <h5 class="modal-title" id="addressModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="cityInput" name="city" class="form-control mb-3" placeholder="Град" required>
                <input type="text" id="addressInput" name="address" class="form-control" placeholder="Адрес" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отказ</button>
                <button type="submit" class="btn btn-primary">Запази</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#clientAddressModal').on('hide.bs.modal', function(e) {
        window.location.reload();
    });
</script>