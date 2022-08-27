<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Basispengetahuan;
use App\Models\Jawaban;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class Deteksi extends Controller
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
        $cekJawaban = Jawaban::with('basis')->where('user_id',$this->users->id)->get();
        if($cekJawaban->count() != 0){
            $data =array();
            foreach($cekJawaban as $jw){
                $data[] = $jw->basispengetahuan_id;
            }
            $kode = collect($cekJawaban)->last()->basis->kode;
            $cekApakahAdatidak = Jawaban::where('kode',$kode)->where('jawaban',2)->count();
            if($cekApakahAdatidak != 0){
                $basisPengetahuan =  Basispengetahuan::whereNotIn('id',$data)->whereNotIn('kode',[$kode])->first();
                $selesai =  $this->cek_solusi($kode);
            } else{
                $basisPengetahuan =  Basispengetahuan::whereNotIn('id',$data)->where('kode',$kode)->first();
                $selesai =  $this->cek_solusi($kode);

            }
        } else {
            $count = Basispengetahuan::count();
            $randomID = rand(1,round((0.7) * $count));
            $basisPengetahuan = Basispengetahuan::with('gejala')->findOrFail($randomID);
            $selesai = 1;
        }
        if($selesai == 1){
            return view('user.deteksi',array(
                'judul' => "Dashboard Administrator | MyGecko v.1",
                'menuUtama' => 'deteksi',
                'menuKedua' => 'deteksi',
                'dataGejala' => $basisPengetahuan,
                'selesai' => $selesai,
            ));
        } else {
            $basis = Basispengetahuan::where('kode',$kode)->first();
            $solusi = Penyakit::findOrFail($basis->penyakit_id);
            $jawaban = Jawaban::with('basis')->where('kode',$kode)->get();
            return view('user.deteksi',array(
                'judul' => "Dashboard Administrator | MyGecko v.1",
                'menuUtama' => 'deteksi',
                'menuKedua' => 'deteksi',
                'solusi' => $solusi->name,
                'selesai' => $selesai,
                'jawaban' => $jawaban,
            ));
        }
    }

    private function cek_solusi($kode)
    {
        $jawaban = Jawaban::where('kode',$kode)->get();
        $basis = Basispengetahuan::where('kode',$kode)->get();
        if($jawaban->count() == $basis->count()){
            $cekJawaban = collect($jawaban)->where('jawaban',"==",2)->count();
            if($cekJawaban != 0){
                return 1;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    public function simpan_jawaban(Request $request)
    {
        if ($request->routeIs('user.*')) {
            $rules = [
                'jawaban' => 'required|max:255',
                'basis_id' => 'required|numeric',
            ];
            $message = [
                'jawaban.required' => 'Silahkan pilih jawaban anda!',
                'jawaban.max' => 'Silahkan pilih jawaban anda!',
                'basispengetahuan_id.required' => 'ID tidak ditemukan silahkan refresh halaman!',
                'basispengetahuan_id.max' => 'ID tidak ditemukan silahkan refresh halaman!',
            ];
            $request->validateWithBag('tambah', $rules, $message);
            DB::beginTransaction();
            try{
                $basis = Basispengetahuan::where('id',$request->basis_id)->first();
                $jawaban = new Jawaban();
                $jawaban->basispengetahuan_id = $request->basis_id;
                $jawaban->user_id =  $this->users->id;
                $jawaban->jawaban =  $request->jawaban;
                $jawaban->kode = $basis->kode;
                $jawaban->save();
                DB::commit();
                notify()->success('Jawaban Anda disimpan!');
                return redirect(route('user.deteksi'));

            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('user.deteksi'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }

    public function ulangi(){
        Jawaban::where('user_id', $this->users->id)->delete();
        notify()->success("data berhasil dihapus!");
        return redirect(route('user.deteksi'));
    }
}
