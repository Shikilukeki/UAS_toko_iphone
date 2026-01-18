<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login · iPhone Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f5f5f7; }
        .login-box {
            max-width: 380px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }
        .form-control { border-radius: 12px; }
        .btn-dark { border-radius: 14px; }
    </style>
</head>
<body>

<div class="login-box text-center">
    <i class="bi bi-apple fs-1 mb-3"></i>
    <h4>Masuk ke iPhone Store</h4>
    <p class="text-muted mb-3">Gunakan akun kamu</p>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= BASE_URL ?>/auth/processLogin">
        <div class="mb-3 text-start">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-4 text-start">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-dark w-100">Login</button>
    </form>

    <a href="<?= BASE_URL ?>" class="d-block mt-3 text-muted text-decoration-none">
        ← Kembali ke Beranda
    </a>

    <hr>

    <small class="text-muted">
        Admin: admin@iphone.com / admin123<br>
        User: user@iphone.com / user123
    </small>
</div>

</body>
</html>
