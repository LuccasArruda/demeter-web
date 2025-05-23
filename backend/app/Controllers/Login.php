<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function Index(): string
    {
        return view('login');
    }
}