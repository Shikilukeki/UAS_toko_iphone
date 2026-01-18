<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin · Edit Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f5f5f7">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>🔑 Admin · Edit Produk</h4>
        <a href="<?= BASE_URL ?>" class="btn btn-outline-secondary btn-sm">← Kembali</a>
    </div>

    <?php
    // DUMMY DATA PRODUK
    $products = [
        [
            'name' => 'iPhone 15 Pro',
            'price' => 19999000,
            'status' => 'aktif'
        ],
        [
            'name' => 'iPhone 15',
            'price' => 15999000,
            'status' => 'aktif'
        ]
    ];
    ?>

    <?php foreach ($products as $index => $p): ?>
        <div class="card mb-3">
            <div class="card-body">
                <form>
                    <div class="mb-2">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" value="<?= $p['name'] ?>">
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" value="<?= $p['price'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option <?= $p['status'] === 'aktif' ? 'selected' : '' ?>>aktif</option>
                            <option <?= $p['status'] === 'nonaktif' ? 'selected' : '' ?>>nonaktif</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-dark btn-sm">
                        Simpan (dummy)
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
