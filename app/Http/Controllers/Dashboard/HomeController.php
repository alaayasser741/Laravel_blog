<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $name = 'Alaa';
        $age = 21;
        return view('dashboard.index', compact('name', 'age'));
    }
}
