<div class="container mt-4">
    <h5 class="mb-3">Produk iPhone</h5>
    <div class="row g-3">

        <?php foreach ($products as $p): ?>
        <div class="col-6">
            <div class="card product-card">
                <img src="assets/img/product/<?= $p['image']; ?>" class="card-img-top">
                <div class="card-body">
                    <h6><?= $p['name']; ?></h6>
                    <p class="text-muted">Rp <?= number_format($p['price']); ?></p>
                    <a href="#" class="btn btn-dark btn-sm w-100">Tambah ke Cart</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>
