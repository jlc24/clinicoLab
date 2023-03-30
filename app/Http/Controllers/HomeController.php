<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Medico;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contcli = Cliente::count();
        $contmed = Medico::count();
        $contUser = User::count();
        return view('home', ['contcli' => $contcli, 'contmed' => $contmed, 'contUser' => $contUser]);
    }
}
