<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PenyakitController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    /** route: adm.master.penyakit */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $penyakit = Penyakit::all();
            return DataTables::of($penyakit)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = "<button class=\"btn btn-sm btn-primary ml-1 open-edit\" data-id=\"$row->id\" data-kode=\"$row->kode\" data-name=\"$row->name\" data-toggle=\"modal\" data-target=\"#modalEdit\"> Edit</button>";
                    $btn = $btn . "<button class=\"btn btn-sm btn-danger ml-1 open-hapus\" data-id=\"$row->id\" data-toggle=\"modal\" data-target=\"#modalHapus\"> Hapus</button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.master.penyakit', array(
            'judul' => "Dashboard Administrator | MyJob v.1",
            'menuUtama' => 'master',
            'menuKedua' => 'penyakit',
        ));
    }
}
