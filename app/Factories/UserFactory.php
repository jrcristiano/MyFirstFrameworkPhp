<?php

namespace App\Factories;

use App\User;
use Core\Hack\Conn;
use Core\Hack\Adapters\MysqlAdapter as Adapter;

class UserFactory
{
    public function getUser()
    {   
        $conn = $this->getInstance();
        $user = new User(new Adapter($conn));

        return $user;
    }

    public function getInstance()
    {   
        $conn = new Conn;
        $conn->config([
            'dsn' => 'mysql:host=localhost;dbname=app;charset=utf8mb4',
            'user' => 'root',
            'passwd' => 'aero\Quimic@1'
        ]);

        return $conn->getInstance();
    }
}
