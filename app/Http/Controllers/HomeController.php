<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        echo 'id: '.Auth::id();
        echo '</br>';
        echo "name: " .auth()->user()->name;
    }
}
