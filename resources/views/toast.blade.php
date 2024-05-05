
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 10">
    <div id="notification" class="toast align-items-center fade hide bg-primary text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ $toastMessage }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    const loadToast = () => {
        const toastElement = document.getElementById("notification");
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
</script>