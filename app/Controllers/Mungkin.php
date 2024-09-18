<?php

namespace App\Controllers;

class Mungkin extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function yaitu()
    {
        echo 'Coba bisaD' ;
    }
}
