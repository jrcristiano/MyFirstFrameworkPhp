<?php

namespace Core;

use Core\Resolver;

abstract class BaseRouter
{   
    public abstract function get($url, $method);
    public abstract function post($url, $method);
    public abstract function put($url, $method);
    public abstract function delete($url, $method);

    public function request($url, $method)
    {
        $path = $_SERVER['PHP_SELF'] ?? '/';
        
        if (strlen($path) > 1) {
            $path = rtrim($path, '/');
        }

        if ($path === $url) {
            $controller = '\\App\\Controllers\\' . $this->controller($method);
            $action = $this->action($method);
            $resolver = new Resolver;

            return $resolver->handler($controller, $action);
        }
    }

    private function action($action)
    {
        $action = explode('@', $action);
        return array_pop($action);
    }

    private function controller($controller)
    {
        $controller = explode('@', $controller);
        return $controller[0];
    }
}
