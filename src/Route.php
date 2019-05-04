<?php

namespace Core;

class Route
{
    public function __construct(string $route)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exp = explode('.', $route);
            $controller = "App\\Controllers\\{$exp[0]}Controller";
            $repository = "App\\Repositories\\{$exp[0]}Repository";
            $action = $exp[1];
    
            $refMethod = new \ReflectionMethod($controller, $action);
    
            foreach ($refMethod->getParameters() as $param) {
    
                if ($param->getClass() && $param->getClass()->name === 'Core\\Request') {
                    $requestClass = $param->getClass()->name;
                    $requestClass = new $requestClass;
    
                    return (new $controller(new $repository))->$action($requestClass);
                }
    
            }
    
            return (new $controller(new $repository))->$action();
        }
    }
}
