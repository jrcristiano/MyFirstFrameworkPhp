<?php

namespace App\Repositories;

use App\Factories\UserFactory as User;

class UserRepository
{   
    private $user;

    public function __construct()
    {
        $this->user = (new User)->getUser();
    }

    public function all()
    {
        $response = $this->user->all();
        return json($response);
    }

    public function first()
    {
        $response = $this->user->first();
        return json($response);
    }

    public function create($data)
    {
        return $this->user->create($data);
    }

    public function update($id, $data)
    {
        return $this->user->update($id, $data);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

    public function getInstance()
    {
        return $this->user->getInstance();
    } 
}
