<?php

namespace App\Controllers;

use Core\Controller;
use App\Repositories\UserRepository as User;
use Core\Request;

class UsersController extends Controller
{   
    private $repository;

    public function __construct()
    {
        $this->repository = new User;
    }

    public function index()
    {   
        $users = $this->repository->all();
        return view([
            'view' => ['template', 'pages/login'],
            'data' => $users
        ]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function delete($id)
    {

    }
}
