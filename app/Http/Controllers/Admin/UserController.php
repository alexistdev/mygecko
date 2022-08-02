<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('role_id', "3")->get();
            return DataTables::of($user)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d-m-Y H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $btn = "<button class=\"btn btn-sm btn-primary ml-1 open-edit\" data-id=\"$row->id\" data-name=\"$row->name\" data-email=\"$row->email\" data-toggle=\"modal\" data-target=\"#modalEdit\"> Edit</button>";
                    $btn = $btn . "<button class=\"btn btn-sm btn-danger ml-1 open-hapus\" data-id=\"$row->id\" data-toggle=\"modal\" data-target=\"#modalHapus\"> Hapus</button>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.master.user', array(
            'judul' => "Dashboard Administrator | MyJob v.1",
            'menuUtama' => 'master',
            'menuKedua' => 'user',
        ));
    }

    /** route: adm.master.usersave */
    public function store(Request $request)
    {
        if ($request->routeIs('adm.*')) {
            $rules = [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email|max:125',
                'password' => 'required|min:6|max:16',
            ];
            $message = [
                'name.required' => "Nama pengguna harus diisi!",
                'name.max' => "Panjang karakter yang diperbolehkan adalah 255 karakter!",
                'email.required' => "Email pengguna harus diisi!",
                'email.email' => "Silahkan gunakan alamat email yang valid!",
                'email.unique' => "Email sudah terdaftar di dalam database!",
                'email.max' => "Panjang karakter yang diperbolehkan adalah 125 karakter!",
                'password.min' => "Panjang karakter yang minimal adalah 6 karakter!",
                'password.max' => "Panjang karakter yang minimal adalah 16 karakter!",
            ];
            $request->validateWithBag('tambah', $rules, $message);
            DB::beginTransaction();
            try {
                $user = new User();
                $user->role_id = 3;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->status = 1;
                $user->password = Hash::make($request->password);
                $user->save();
                DB::commit();
                notify()->success('Data pengguna berhasil ditambahkan !');
                return redirect(route('adm.master.user'));
            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('adm.master.user'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }

    /** route: adm.master.userupdate*/
    public function update(Request $request)
    {
        if ($request->routeIs('adm.*')) {
            $rules = [
                'user_id' => 'required|numeric',
                'name' => 'required|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($request->user_id),
                    'max:125',
                ],
                'password' => 'nullable|min:6|max:16',
            ];
            $message = [
                'user_id.required' => "ID tidak ditemukan silahkan refresh halaman!",
                'user_id.numeric' => "ID tidak ditemukan silahkan refresh halaman!",
                'name.required' => "Nama pengguna harus diisi!",
                'name.max' => "Panjang karakter yang diperbolehkan adalah 255 karakter!",
                'email.required' => "Email pengguna harus diisi!",
                'email.email' => "Silahkan gunakan alamat email yang valid!",
                'email.unique' => "Email sudah terdaftar di dalam database!",
                'email.max' => "Panjang karakter yang diperbolehkan adalah 125 karakter!",
                'password.min' => "Panjang karakter yang minimal adalah 6 karakter!",
                'password.max' => "Panjang karakter yang minimal adalah 16 karakter!",
            ];
            $request->validateWithBag('edit', $rules, $message);
            DB::beginTransaction();
            try {
                $user = User::findOrFail($request->user_id);
                if ($request->password !== null) {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                    ]);
                } else {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                    ]);
                }
                DB::commit();
                notify()->success('Data pengguna berhasil diupdate !');
                return redirect(route('adm.master.user'));
            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('adm.master.user'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }

    /** route: adm.master.userdelete */
    public function destroy(Request $request)
    {
        if ($request->routeIs('adm.*')) {
            $rules = [
                'user_id' => 'required|numeric',
            ];
            $message = [
                'user_id.required' => "ID tidak ditemukan silahkan refresh halaman!",
                'user_id.numeric' => "ID tidak ditemukan silahkan refresh halaman!",
            ];
            $request->validateWithBag('hapus', $rules, $message);
            DB::beginTransaction();
            try{
                $user = User::findOrFail($request->user_id);
                $user->delete();
                DB::commit();
                notify()->error('Pengguna berhasil dihapus !', "Hapus");
                return redirect(route('adm.master.user'));
            } catch (Exception $e) {
                DB::rollback();
                notify()->error($e->getMessage());
                return redirect(route('adm.master.user'));
            }
        } else {
            return abort("404", "NOT FOUND");
        }
    }
}
