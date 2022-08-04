<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,
    UserController as UserAdmin,
    GejalaController as GejalaAdmin,
    PenyakitController as PenyakitAdmin};
use App\Http\Controllers\User\{DashboardController as DashUser,CaraMerawat as CaraUser,
Pengenalan as PengenalanUser};




Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class, 'index'])->name('adm.dashboard');


        Route::get('/admin/user', [UserAdmin::class, 'index'])->name('adm.master.user');
        Route::post('/admin/user', [UserAdmin::class, 'store'])->name('adm.master.usersave');
        Route::patch('/admin/user', [UserAdmin::class, 'update'])->name('adm.master.userupdate');
        Route::delete('/admin/user', [UserAdmin::class, 'destroy'])->name('adm.master.userdelete');

        Route::get('/admin/gejala', [GejalaAdmin::class, 'index'])->name('adm.master.gejala');

        Route::get('/admin/penyakit', [PenyakitAdmin::class, 'index'])->name('adm.master.penyakit');


    });

    Route::group(['roles' => 'user'], function () {
        Route::get('/user/dashboard', [DashUser::class, 'index'])->name('usr.dashboard');
        Route::get('/user/caramerawat', [CaraUser::class, 'index'])->name('user.caramerawat');
        Route::get('/user/pengenalan', [PengenalanUser::class, 'index'])->name('user.pengenalan');
    });
});

require __DIR__.'/auth.php';
