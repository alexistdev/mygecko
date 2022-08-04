<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pengenalan extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        return view('user.pengenalan',array(
            'judul' => "Dashboard Administrator | MyGecko v.1",
            'menuUtama' => 'pengenalan',
            'menuKedua' => 'pengenalan',
        ));
    }
}
