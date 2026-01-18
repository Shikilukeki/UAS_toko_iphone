<?php

require_once '../app/models/Product.php';

class ProductController
{
    private function adminOnly()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_URL);
            exit;
        }
    }

    public function adminIndex()
    {
        $this->adminOnly();
        $products = Product::all();
        require '../app/views/admin/product/index.php';
    }

    public function store()
    {
        $this->adminOnly();

        Product::store([
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'image' => $_POST['image']
        ]);

        header('Location: ' . BASE_URL . '/admin/product');
    }

    public function delete()
    {
        $this->adminOnly();
        Product::delete($_GET['id']);
        header('Location: ' . BASE_URL . '/admin/product');
    }
}
