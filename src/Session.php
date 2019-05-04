<?php

namespace Core;

class Session
{      
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

    public function set($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function get($key)
    {
        if ($this->session[$key]) {
            return $this->session[$key];
        }

        return false;
    }

    public function destroy($keys)
    {
        if (is_array($keys)) {
            foreach ($keys as $key) {
                unset($this->session[$key]);
            }
        }
        
        unset($this->session[$key]);
    }
}
