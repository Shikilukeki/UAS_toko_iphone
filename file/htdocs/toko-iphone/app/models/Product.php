<?php

class Product
{
    public static function all()
    {
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [
                [
                    'id' => 1,
                    'name' => 'iPhone 15 Pro',
                    'price' => 19999000,
                    'image' => 'iphone15Pro.png'
                ],
                [
                    'id' => 2,
                    'name' => 'iPhone 15',
                    'price' => 15999000,
                    'image' => 'iphone15.png'
                ]
            ];
        }
        return $_SESSION['products'];
    }

    public static function store($data)
    {
        $products = self::all();
        $data['id'] = time();
        $products[] = $data;
        $_SESSION['products'] = $products;
    }

    public static function delete($id)
    {
        $products = self::all();
        $_SESSION['products'] = array_filter($products, fn($p) => $p['id'] != $id);
    }
}
