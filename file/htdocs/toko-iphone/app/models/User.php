<?php

class User
{
    private static $users = [
        [
            'email' => 'admin@iphone.com',
            'password' => 'admin123',
            'role' => 'admin',
            'name' => 'Admin Store'
        ],
        [
            'email' => 'user@iphone.com',
            'password' => 'user123',
            'role' => 'user',
            'name' => 'User Biasa'
        ]
    ];

    public static function findByEmail($email)
    {
        foreach (self::$users as $user) {
            if ($user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }
}
