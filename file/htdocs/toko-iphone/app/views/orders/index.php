<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

<h5>Riwayat Pesanan</h5>

<form method="get" class="mb-3">
    <input type="hidden" name="url" value="orders">
    <input type="text" name="q" class="form-control"
           placeholder="Cari ID order..."
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
</form>

<?php if (empty($orders)): ?>
    <div class="alert alert-info">Belum ada transaksi</div>
<?php else: ?>
    <ul class="list-group mb-3">
        <?php foreach ($orders as $o): ?>
            <li class="list-group-item d-flex justify-content-between">
                <span>#<?= $o['id'] ?></span>
                <strong>Rp <?= number_format($o['total'], 0, ',', '.') ?></strong>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                <li class="page-item <?= ($i == ($_GET['page'] ?? 1)) ? 'active' : '' ?>">
                    <a class="page-link"
                       href="?url=orders&page=<?= $i ?>&q=<?= urlencode($_GET['q'] ?? '') ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
<?php endif; ?>

<a href="<?= BASE_URL ?>" class="btn btn-secondary mt-3">← Kembali</a>

</div>
</body>
</html>
