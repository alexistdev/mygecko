<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RuleController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    /** route: adm.master.user */
    public function index()
    {

        return view('admin.master.rule', array(
            'judul' => "Dashboard Administrator | MyGecko v.1",
            'menuUtama' => 'master',
            'menuKedua' => 'rule',
        ));
    }
}
