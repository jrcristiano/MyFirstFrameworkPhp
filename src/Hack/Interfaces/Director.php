<?php

namespace Core\Hack\Interfaces;

interface Director
{
    public function all();
    public function first();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
