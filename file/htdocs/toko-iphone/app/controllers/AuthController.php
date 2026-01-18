<?php

class AuthController
{
    public function login()
    {
        require '../app/views/auth/login.php';
    }

    public function processLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // akun dummy
        $accounts = [
            [
                'id' => 1,
                'email' => 'admin@iphone.com',
                'password' => 'admin123',
                'role' => 'admin',
                'name' => 'Admin'
            ],
            [
                'id' => 2,
                'email' => 'user@iphone.com',
                'password' => 'user123',
                'role' => 'user',
                'name' => 'User'
            ]
        ];

        foreach ($accounts as $acc) {
            if ($acc['email'] === $email && $acc['password'] === $password) {
                $_SESSION['user'] = [
                    'id'    => $acc['id'],   // 🔥 INI KUNCI SEMUANYA
                    'email' => $acc['email'],
                    'name'  => $acc['name'],
                    'role'  => $acc['role']
                ];
                header('Location: ' . BASE_URL);
                exit;
            }
        }

        $_SESSION['error'] = 'Login gagal';
        header('Location: ' . BASE_URL . '/auth/login');
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}
