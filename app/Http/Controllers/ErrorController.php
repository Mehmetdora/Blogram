<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error_404()
    {
        return view('errors.error_404');
    }
}