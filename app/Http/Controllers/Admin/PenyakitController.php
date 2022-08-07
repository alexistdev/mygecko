<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Bantuan;
use Exception;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            return DataTables::of(collect($penyakit)->sortDesc())
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
            'judul' => "Dashboard Administrator | MyGecko v.1",
            'menuUtama' => 'master',
            'menuKedua' => 'penyakit',
        ));
    }

    /** route: adm.master.penyakit.save */
    public function store(Request $request)
    {
        if ($request->routeIs('adm.*')) {
            $rules = [
                'name' => 'required|max:125',
            ];
            $message = [
                'name.required' => 'Anda harus mengisi nama penyakit terlebih dahulu!',
                'name.max' => 'Panjang karakter yang diperbolehkan adalah 125 karakter!',
            ];
            $request->validateWithBag('tambah', $rules, $message);
            DB::beginTransaction();
            try{
                $bantuan = new Bantuan("1");
                $kode = $bantuan->generateKode();
                $penyakit = new Penyakit();
                $penyakit->kode = $kode;
                $penyakit->name = $request->name;
                $penyakit->save();
                DB::commit();
                notify()->success('Data Penyakit berhasil ditambahkan!');
                return redirect(route('adm.master.penyakit'));
            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('adm.master.penyakit'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }
}
