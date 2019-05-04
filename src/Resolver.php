<?php

namespace Core;

class Resolver implements \ArrayAccess
{   
    use Collection;

    public function handler(string $class, string $method = null)
    {
        $ref = new \ReflectionClass($class);

        $instance = $this->instance($ref);
        
        if (!$method) {
            return $instance;
        }

        $refMethod = new \ReflectionMethod($instance, $method);

        $parameters = $this->parameters($refMethod);

        // Equivale à $instance->$method($parameters);
        return call_user_func_array([$instance, $method], $parameters);
    }

    public function instance($ref)
    {
        $constructor = $ref->getConstructor();

        if (!$constructor) {
            return $ref->newInstance();
        }

        $parameters = $this->parameters($constructor);

        return $ref->newInstanceArgs($parameters);
    }

    public function parameters($method)
    {
        $parameters = [];
        foreach ($method->getParameters() as $param) {
            
            $offsetExists = $this->offsetExists((string) $param->getType());

            if ($param->getType() !== null && $offsetExists) {
                $parameters[] = $this->offsetGet((string) $param->getType());
                continue;
            }

            if ($param->getClass()) {
                $parameters[] = $this->handler($param->getClass()->getName());
                continue;   
            }

            if ($param->isOptional()) {
                $parameters[] = $param->getDefaultValue();
                continue;
            }

        }

        return $parameters;
    }
}
