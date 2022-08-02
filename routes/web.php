<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,
    UserController as UserAdmin};


Route::get('/', function () {
    return view('welcome');
});

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
    });
});

require __DIR__.'/auth.php';
