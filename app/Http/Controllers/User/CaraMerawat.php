<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaraMerawat extends Controller
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
        return view('user.caramerawat',array(
            'judul' => "Dashboard Administrator | MyJob v.1",
            'menuUtama' => 'caramerawat',
            'menuKedua' => 'caramerawat',
        ));
    }
}
