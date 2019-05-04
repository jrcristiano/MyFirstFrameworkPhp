<?php

namespace Core;

class Request
{   
    public function isMethod(string $method)
    {   
        $method = strtoupper($method);

        if ($_SERVER['REQUEST_METHOD'] === $method) {
            return true;
        }

        return false;
    }

    public function input(string $name)
    {
        if ($this->isMethod('post')) {
            return filter_input(INPUT_POST, $name);   
        }

        return filter_input(INPUT_GET, $name);
    }
    
    public function all()
    {   
        if ($this->isMethod('post')) {
            $request = filter_input_array(INPUT_POST) ?? [];
            return $request;
        }

        return filter_input_array(INPUT_GET) ?? [];
    }
}
