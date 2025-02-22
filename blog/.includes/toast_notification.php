<!-- Bootstrap Toast -->
<?php if (isset($_SESSION['notification'])): ?>
  <div id="notifikasi" class="bs-toast toast fade bg-<?= $_SESSION['notification'] ['type'] ?> position-absolute m-3 end-0" role="alert" data-bs-autohide="true">
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <strong class="me-auto"><?= $_SESSION['notification'] ['title'] ?? 'Notifikasi' ?></strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <?= $_SESSION['notification'] ['message'] ?>
    </div>
  </div>
<?php endif; ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.getElementById('notifikasi');
    if (toastEl) {
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }
  });
</script>