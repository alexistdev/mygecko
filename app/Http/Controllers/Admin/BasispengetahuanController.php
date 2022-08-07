<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Bantuan;
use App\Models\Basispengetahuan;
use App\Models\Gejala;
use Exception;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class BasispengetahuanController extends Controller
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
            $basis = Basispengetahuan::with('penyakit','gejala');
            return DataTables::of($basis)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->editColumn('penyakit', function ($request) {
                    return "[".$request->penyakit->kode."]"." ".$request->penyakit->name;
                })

                ->editColumn('gejala', function ($request) {
                    return "[".$request->gejala->kode."]"." ".$request->gejala->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = "<button class=\"btn btn-sm btn-primary ml-1 open-edit\" data-id=\"$row->id\" data-kode=\"$row->kode\" data-name=\"$row->name\" data-toggle=\"modal\" data-target=\"#modalEdit\"> Edit</button>";
                    $btn = $btn . "<button class=\"btn btn-sm btn-danger ml-1 open-hapus\" data-id=\"$row->id\" data-toggle=\"modal\" data-target=\"#modalHapus\"> Hapus</button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $gejala = Gejala::all();
        $penyakit = Penyakit::all();
        return view('admin.master.basis', array(
            'judul' => "Dashboard Administrator | MyGecko v.1",
            'menuUtama' => 'master',
            'menuKedua' => 'basispengetahuan',
            'dataGejala' => $gejala,
            'dataPenyakit' => $penyakit,
        ));
    }

    /** route: adm.basispengetahuan.save */
    public function store(Request $request)
    {
        if ($request->routeIs('adm.*')) {
            $rules = [
                'penyakit_id' => 'required|numeric',
                'gejala_id' => 'required|numeric',
            ];
            $message = [
                'penyakit_id.required' => 'Anda harus memilih jenis penyakit terlebih dahulu!',
                'penyakit_id.numeric' => 'Anda harus memilih jenis penyakit terlebih dahulu!',
                'gejala_id.required' => 'Anda harus memilih jenis gejala terlebih dahulu!',
                'gejala_id.numeric' => 'Anda harus memilih jenis gejala terlebih dahulu!',
            ];
            $request->validateWithBag('tambah', $rules, $message);
            DB::beginTransaction();
            try{
                $cekData = Basispengetahuan::where('penyakit_id',$request->penyakit_id)->where('gejala_id',$request->gejala_id)->count();
                if($cekData >0 ){
                    DB::rollback();
                    notify()->error('Data sudah ada !',"gagal");
                } else{
                    $bantuan = new Bantuan("3");
                    $kode = $bantuan->generateKode();
                    $basis = new Basispengetahuan();
                    $basis->kode = $kode;
                    $basis->penyakit_id = $request->penyakit_id;
                    $basis->gejala_id = $request->gejala_id;
                    $basis->save();
                    DB::commit();
                    notify()->success('Data basis pengetahuan berhasil ditambahkan !');
                }
                return redirect(route('adm.basispengetahuan'));
            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('adm.basispengetahuan'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }
}
