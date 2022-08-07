<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Bantuan;
use App\Models\Gejala;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class GejalaController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users = Auth::user();
            return $next($request);
        });
    }

    /** route: adm.master.gejala */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $gejala = Gejala::all();
            return DataTables::of($gejala)
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
        return view('admin.master.gejala', array(
            'judul' => "Dashboard Administrator | MyGecko v.1",
            'menuUtama' => 'master',
            'menuKedua' => 'gejala',
        ));
    }

    /** route: adm.master.gejala.save */
    public function store(Request $request)
    {
        if ($request->routeIs('adm.*')) {
            $rules = [
                'name' => 'required|max:125',
            ];
            $message = [
                'name.required' => 'Anda harus mengisi nama gejala terlebih dahulu!',
                'name.max' => 'Panjang karakter yang diperbolehkan adalah 125 karakter!',
            ];
            $request->validateWithBag('tambah', $rules, $message);
            DB::beginTransaction();
            try{
                $bantuan = new Bantuan("2");
                $kode = $bantuan->generateKode();
                $gejala= new Gejala();
                $gejala->kode = $kode;
                $gejala->name = $request->name;
                $gejala->save();
                DB::commit();
                notify()->success('Data Gejala berhasil ditambahkan!');
                return redirect(route('adm.master.gejala'));
            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('adm.master.gejala'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }
}
