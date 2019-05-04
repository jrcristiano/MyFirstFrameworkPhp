<?php

namespace Core;

class Router extends BaseRouter
{   
    public function get($url, $method)
    {
        return $this->request($url, $method);
    }

    public function post($url, $method)
    {   
        return $this->request($url, $method);
    }

    public function put($url, $method)
    {

    }

    public function delete($url, $method)
    {
        
    }
}
