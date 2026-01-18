<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin · Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h4 class="mb-3">Manajemen Produk iPhone</h4>

    <form method="post" action="<?= BASE_URL ?>/admin/product/store" class="card p-3 mb-4">
        <h6>Tambah Produk</h6>
        <input name="name" class="form-control mb-2" placeholder="Nama iPhone" required>
        <input name="price" class="form-control mb-2" placeholder="Harga" required>
        <input name="image" class="form-control mb-2" placeholder="Nama file gambar (ex: iphone15.png)" required>
        <button class="btn btn-dark">Tambah</button>
    </form>

    <table class="table table-white table-bordered">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['name'] ?></td>
            <td>Rp <?= number_format($p['price'],0,',','.') ?></td>
            <td>
                <a href="<?= BASE_URL ?>/admin/product/delete?id=<?= $p['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Hapus produk?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="<?= BASE_URL ?>" class="btn btn-secondary">← Kembali ke Home</a>
</div>

</body>
</html>
