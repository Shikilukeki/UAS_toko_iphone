<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_URL', '/toko-iphone/public');

require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/CartController.php';
require_once '../app/controllers/OrderController.php';

$url = $_GET['url'] ?? '';
$url = trim($url, '/');

switch ($url) {

    case '':
        require '../app/views/home/index.php';
        break;

    // AUTH
    case 'auth/login':
        (new AuthController())->login();
        break;

    case 'auth/processLogin':
        (new AuthController())->processLogin();
        break;

    case 'auth/logout':
        (new AuthController())->logout();
        break;

    // CART
    case 'cart':
        (new CartController())->index();
        break;

    case 'cart/add':
        (new CartController())->add();
        break;

    case 'cart/update':
        (new CartController())->update();
        break;

    case 'cart/delete':
        (new CartController())->delete();
        break;

    case 'cart/checkout':
        (new CartController())->checkout();
        break;

    // ORDERS
    case 'orders':
        (new OrderController())->index();
        break;

    default:
        http_response_code(404);
        echo '404 Not Found';
}
