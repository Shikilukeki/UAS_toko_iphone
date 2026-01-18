<?php
$isLogin = isset($_SESSION['user']);
$isAdmin = $isLogin && $_SESSION['user']['role'] === 'admin';

$cartCount = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qty'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>iPhone Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #f5f5f7; }
        .navbar { background-color: #ffffff; }
        .carousel-item img {
            height: 220px;
            object-fit: cover;
        }
        .product-card img {
            height: 170px;
            object-fit: contain;
            padding: 10px;
        }
    </style>
</head>
<body>

<!-- TOAST -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastKeranjang" class="toast text-bg-dark">
        <div class="toast-body" id="toastMsg"></div>
    </div>
</div>

<!-- HEADER -->
<nav class="navbar fixed-top border-bottom">
    <div class="container-fluid d-flex align-items-center">

        <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#menu">
            <i class="bi bi-list fs-4"></i>
        </button>

        <span class="fw-semibold mx-auto">iPhone Store</span>

        <div class="d-flex align-items-center gap-2">
            <?php if ($isAdmin): ?>
                <span title="Admin">🔑</span>
            <?php endif; ?>

            <?php if ($isLogin): ?>
                <a href="<?= BASE_URL ?>/auth/logout" class="btn">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                </a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/auth/login" class="btn">
                    <i class="bi bi-person fs-5"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- MENU -->
<div class="offcanvas offcanvas-start" id="menu" style="width:65%;">
    <div class="offcanvas-header">
        <h5>Menu</h5>
        <button class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="list-unstyled fs-5">

            <li class="mb-3">
                <a href="<?= BASE_URL ?>" class="text-dark text-decoration-none">Beranda</a>
            </li>

            <?php if (!$isAdmin): ?>
            <li class="mb-3 d-flex justify-content-between align-items-center">
                <a href="<?= BASE_URL ?>/cart" class="text-dark text-decoration-none">
                    Keranjang
                </a>

                <?php if ($cartCount > 0): ?>
                    <span id="cartBadge" class="badge bg-dark rounded-pill">
                        <?= $cartCount ?>
                    </span>
                <?php endif; ?>
            </li>
            <?php endif; ?>

            <?php if ($isLogin): ?>
            <li class="mb-3">
                <a href="<?= BASE_URL ?>/orders" class="text-dark text-decoration-none">
                <?= $isAdmin ? 'Pesanan Masuk' : 'Pesanan Saya' ?>
                </a>
            </li>
            <?php endif; ?>

            <?php if ($isLogin): ?>
                <li>
                    <a href="<?= BASE_URL ?>/auth/logout" class="text-dark text-decoration-none">
                        Logout
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?= BASE_URL ?>/auth/login" class="text-dark text-decoration-none">
                        Login
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</div>

<div style="height:60px;"></div>

<!-- BANNER (AMAN, GA DIUBAH) -->
<div class="container mt-3">
    <div id="banner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#banner" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#banner" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#banner" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner rounded-4 overflow-hidden">
            <div class="carousel-item active">
                <img src="<?= BASE_URL ?>/assets/img/banner/banner1.jpg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>/assets/img/banner/banner2.jpg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>/assets/img/banner/banner3.jpg" class="d-block w-100">
            </div>
        </div>
    </div>
</div>

<!-- PRODUCT -->
<div class="container mt-4">
    <h5>Produk iPhone</h5>

    <div class="row g-3">

<?php
$products = [
    ['id'=>1,'name'=>'iPhone 15 Pro 512GB','price'=>19999000,'img'=>'iphone15Pro.png'],
    ['id'=>2,'name'=>'iPhone 15 256GB','price'=>15999000,'img'=>'iphone15.png'],
];
?>

<?php foreach ($products as $p): ?>
<div class="col-6">
    <div class="card product-card">
        <img src="<?= BASE_URL ?>/assets/img/product/<?= $p['img'] ?>">
        <div class="card-body">
            <h6><?= $p['name'] ?></h6>
            <p class="text-muted">Rp <?= number_format($p['price'],0,',','.') ?></p>

            <?php if ($isAdmin): ?>
                <button class="btn btn-outline-dark btn-sm w-100" disabled>
                    Edit Produk
                </button>
            <?php else: ?>
                <button
                class="btn btn-dark btn-sm w-100 add-to-cart"
                data-id="<?= $p['id'] ?>"
                data-name="<?= $p['name'] ?>"
                data-price="<?= $p['price'] ?>"
                >
                Tambah ke Keranjang
                </button>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    console.log('JS KELOAD');
    console.log(document.querySelectorAll('.add-to-cart'));

    const toastEl = document.getElementById('toastKeranjang');
    const toastMsg = document.getElementById('toastMsg');
    const toast = new bootstrap.Toast(toastEl);

document.querySelectorAll('.add-to-cart').forEach(btn => {
  btn.addEventListener('click', () => {

    const formData = new FormData();
    formData.append('id', btn.dataset.id);
    formData.append('name', btn.dataset.name);
    formData.append('price', btn.dataset.price);

    fetch("<?= BASE_URL ?>/cart/add", {
      method: 'POST',
      body: formData
    })
    .then(r => r.json())
    .then(res => {

      if (res.login === false) {
        toastMsg.innerText = "Kamu harus login sebelum melakukan pembelian";
        toast.show();
        setTimeout(() => location.href = "<?= BASE_URL ?>/auth/login", 1200);
        return;
      }

      toastMsg.innerText = "Produk ditambahkan ke keranjang";
      toast.show();

      let badge = document.getElementById('cartBadge');
      if (!badge) {
        badge = document.createElement('span');
        badge.id = 'cartBadge';
        badge.className = 'badge bg-dark rounded-pill';
        document.querySelector('#menu a[href="<?= BASE_URL ?>/cart"]')
          .parentElement.appendChild(badge);
      }
      badge.innerText = res.count;
    });
  });
});

});
</script>

</body>
</html>
