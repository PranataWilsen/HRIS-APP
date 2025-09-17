<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('layout', ['content' => view('home')]);
    }
}
