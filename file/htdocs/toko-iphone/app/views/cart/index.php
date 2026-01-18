<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Keranjang</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
<h5>Keranjang Belanja</h5>

<?php if (empty($cart)): ?>
    <div class="alert alert-info">Keranjang kosong</div>
    <a href="<?= BASE_URL ?>" class="btn btn-dark">Belanja</a>
<?php else: ?>

<ul class="list-group mb-3">
<?php
$total = 0;
foreach ($cart as $id => $item):
$total += $item['price'] * $item['qty'];
?>
<li class="list-group-item d-flex justify-content-between align-items-center">
    <div>
        <strong><?= $item['name'] ?></strong><br>
        <input type="number"
               min="1"
               value="<?= $item['qty'] ?>"
               class="form-control form-control-sm w-50 mt-1 qty"
               data-id="<?= $id ?>">
    </div>

    <div class="text-end">
        Rp <?= number_format($item['price'] * $item['qty'],0,',','.') ?><br>
        <button class="btn btn-sm btn-danger mt-2 delete"
                data-id="<?= $id ?>">
            Hapus
        </button>
    </div>
</li>
<?php endforeach; ?>
</ul>

<h6>Total: Rp <?= number_format($total,0,',','.') ?></h6>

<div class="d-flex gap-2 mt-3">
    <a href="<?= BASE_URL ?>" class="btn btn-secondary">← Lanjut Belanja</a>

<form action="<?= BASE_URL ?>/cart/checkout" method="post" class="d-inline">
    <button class="btn btn-dark mt-3">Checkout</button>
</form>

</div>

<?php endif; ?>
</div>

<script>
document.querySelectorAll('.qty').forEach(input => {
  input.addEventListener('change', () => {
    fetch("<?= BASE_URL ?>/cart/update", {
      method:'POST',
      body: new URLSearchParams({
        id: input.dataset.id,
        qty: input.value
      })
    }).then(() => location.reload());
  });
});

document.querySelectorAll('.delete').forEach(btn => {
  btn.addEventListener('click', () => {
    fetch("<?= BASE_URL ?>/cart/delete", {
      method:'POST',
      body: new URLSearchParams({
        id: btn.dataset.id
      })
    }).then(() => location.reload());
  });
});
</script>

</body>
</html>
