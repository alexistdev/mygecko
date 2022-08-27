<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,
    UserController as UserAdmin,
    GejalaController as GejalaAdmin,
    PenyakitController as PenyakitAdmin,
    BasispengetahuanController as BasisAdmin,
RuleController as RuleAdmin};
use App\Http\Controllers\User\{DashboardController as DashUser,CaraMerawat as CaraUser,
Pengenalan as PengenalanUser,
MorphController as MorphUser,
Penyakitpengobatan as PPUser,
Deteksi as DetUser};




Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('adm.dashboard');

        Route::get('/admin/basis_pengetahuan', [BasisAdmin::class, 'index'])->name('adm.basispengetahuan');
        Route::post('/admin/basis_pengetahuan', [BasisAdmin::class, 'store'])->name('adm.basispengetahuan.save');

        Route::get('/admin/rule', [RuleAdmin::class, 'index'])->name('adm.rule');

        Route::get('/admin/user', [UserAdmin::class, 'index'])->name('adm.master.user');
        Route::post('/admin/user', [UserAdmin::class, 'store'])->name('adm.master.usersave');
        Route::patch('/admin/user', [UserAdmin::class, 'update'])->name('adm.master.userupdate');
        Route::delete('/admin/user', [UserAdmin::class, 'destroy'])->name('adm.master.userdelete');

        Route::get('/admin/gejala', [GejalaAdmin::class, 'index'])->name('adm.master.gejala');
        Route::post('/admin/gejala', [GejalaAdmin::class, 'store'])->name('adm.master.gejala.save');

        Route::get('/admin/penyakit', [PenyakitAdmin::class, 'index'])->name('adm.master.penyakit');
        Route::post('/admin/penyakit', [PenyakitAdmin::class, 'store'])->name('adm.master.penyakit.save');


    });

    Route::group(['roles' => 'user'], function () {
        Route::get('/user/dashboard', [DashUser::class, 'index'])->name('usr.dashboard');
        Route::get('/user/caramerawat', [CaraUser::class, 'index'])->name('user.caramerawat');
        Route::get('/user/pengenalan', [PengenalanUser::class, 'index'])->name('user.pengenalan');
        Route::get('/user/morph', [MorphUser::class, 'index'])->name('user.morph');
        Route::get('/user/penyakitpengobatan', [PPUser::class, 'index'])->name('user.penyakitpengobatan');
        Route::get('/user/deteksi', [DetUser::class, 'index'])->name('user.deteksi');
        Route::post('/user/deteksi', [DetUser::class, 'simpan_jawaban'])->name('user.deteksi.save');
        Route::get('/user/deteksi/ulangi', [DetUser::class, 'ulangi'])->name('user.deteksi.ulangi');
    });
});

require __DIR__.'/auth.php';
