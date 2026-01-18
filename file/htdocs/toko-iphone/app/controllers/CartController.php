<?php

class CartController {

    public function add()
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION['user'])) {
            echo json_encode(['login' => false]);
            return;
        }

        $id    = $_POST['id'];
        $name  = $_POST['name'];
        $price = $_POST['price'];

        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'name'  => $name,
                'price' => $price,
                'qty'   => 1
            ];
        } else {
            $_SESSION['cart'][$id]['qty']++;
        }

        $count = 0;
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['qty'];
        }

        echo json_encode([
            'login' => true,
            'count' => $count
        ]);
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $cart = $_SESSION['cart'] ?? [];
        require '../app/views/cart/index.php';
    }

    public function update()
    {
        $id  = $_POST['id'];
        $qty = (int) $_POST['qty'];

        if ($qty <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['qty'] = $qty;
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        unset($_SESSION['cart'][$id]);
    }

    public function checkout()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        if (empty($_SESSION['cart'])) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $db = new PDO(
            "mysql:host=localhost;dbname=toko_iphone;charset=utf8",
            "root",
            "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $cart = $_SESSION['cart'];
        $total = 0;

        foreach ($cart as $c) {
            $total += $c['price'] * $c['qty'];
        }

        // ⬇️ PENTING: kolom INI HARUS ADA DI DB
        // orders.user_email (VARCHAR)
        $stmt = $db->prepare("INSERT INTO orders (user_id, total) VALUES (?,?)");
        $stmt->execute([$_SESSION['user']['id'], $total]);


        $orderId = $db->lastInsertId();

        $stmtItem = $db->prepare(
            "INSERT INTO order_items (order_id, product_name, price, qty)
             VALUES (?, ?, ?, ?)"
        );

        foreach ($cart as $c) {
            $stmtItem->execute([
                $orderId,
                $c['name'],
                $c['price'],
                $c['qty']
            ]);
        }

        unset($_SESSION['cart']);

        header('Location: ' . BASE_URL . '/orders');
        exit;
    }
}
