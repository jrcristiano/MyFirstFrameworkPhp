<?php

namespace Core\Hack;

class Conn
{   
    private $config;
    private $instance = null;

    public function config(array $config)
    {
        $this->config = $config;
    }

    public function getInstance()
    {
        if (!$this->instance) {
            $dsn = $this->config['dsn'] ?? null;
            $user = $this->config['user'] ?? null;
            $passwd = $this->config['passwd'] ?? null;
            $options = $this->config['options'] ?? [];

            $this->instance = new \PDO($dsn, $user, $passwd, $options);
        }

        return $this->instance;
    }
}
