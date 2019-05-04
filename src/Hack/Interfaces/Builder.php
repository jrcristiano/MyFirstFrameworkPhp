<?php

namespace Core\Hack\Interfaces;

interface Builder
{
    public function select($columns = '*', array $data = []);
    public function all();
    public function first();
    public function create(array $data);
    public function update($id, array $data);
    public function delete(int $id);
}
