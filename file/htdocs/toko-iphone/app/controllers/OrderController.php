<?php

class OrderController {

public function index()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    $db = new PDO(
        "mysql:host=localhost;dbname=toko_iphone;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $limit = 5;
    $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page  = max(1, $page);
    $offset = ($page - 1) * $limit;

    $search = $_GET['q'] ?? '';

    if ($_SESSION['user']['role'] === 'admin') {
        // ADMIN: search by order ID
        $stmt = $db->prepare(
            "SELECT * FROM orders
             WHERE id LIKE ?
             ORDER BY id DESC
             LIMIT $limit OFFSET $offset"
        );
        $stmt->execute(["%$search%"]);

        $countStmt = $db->prepare(
            "SELECT COUNT(*) FROM orders WHERE id LIKE ?"
        );
        $countStmt->execute(["%$search%"]);

    } else {
        // USER: hanya order milik sendiri (PAKE user_id)
        $stmt = $db->prepare(
            "SELECT * FROM orders
             WHERE user_id = ?
             ORDER BY id DESC
             LIMIT $limit OFFSET $offset"
        );
        $stmt->execute([$_SESSION['user']['id']]);

        $countStmt = $db->prepare(
            "SELECT COUNT(*) FROM orders WHERE user_id = ?"
        );
        $countStmt->execute([$_SESSION['user']['id']]);
    }

    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalData = $countStmt->fetchColumn();
    $totalPage = ceil($totalData / $limit);

    require '../app/views/orders/index.php';
}

}
