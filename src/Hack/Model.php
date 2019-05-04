<?php

namespace Core\Hack;

use Core\Hack\Interfaces\{
    Builder, 
    Director
};

abstract class Model implements Director
{   
    private $driver;

    public function __construct(Builder $driver)
    {   
        $this->driver = $driver;
        $this->table();
    }

    public function table()
    {
        $table = explode('\\', get_called_class());
        $table = array_pop($table);
        $table = strtolower($table);
        
        if ($this->table) {
            return $this->driver->setTable($this->table);   
        }
        
        return $this->driver->setTable($table);
    }

    public function all()
    {
        return $this->driver->select()
            ->exec()
            ->all();
    }

    public function first()
    {
        return $this->driver->select()
            ->exec()
            ->first();
    }

    public function create($data)
    {
        return $this->driver->create($data)
            ->exec();
    }

    public function update($id, $data)
    {
        return $this->driver->update($id, $data)
            ->exec();
    }

    public function delete($id)
    {
        return $this->driver->delete($id)
            ->exec();
    }
}
