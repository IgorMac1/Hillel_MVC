<?php

namespace App\Controllers;


use Core\Controller;
use Core\View;

class UsersController extends Controller
{

    public function index()
    {
        View::render('admin/dashboard');
    }
}