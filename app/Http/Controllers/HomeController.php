<?php

namespace App\Http\Controllers;

use App\Artigos;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $artigos = auth()->user()->artigos()->paginate(6);

        return view('home', [
            'artigos' => $artigos
        ]);
    }
}
