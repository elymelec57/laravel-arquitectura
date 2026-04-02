<?php

namespace Src\admin\user\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\admin\user\infrastructure\controllers\createUserController;
use Src\admin\user\infrastructure\controllers\storeUserController;

Route::prefix('/admin/users')->group(function () {
    Route::get('/', function () { return 'Lista de usuarios'; })->name('admin.users.index');
    Route::get('/create', [createUserController::class, '__invoke'])->name('admin.users.create');
    Route::post('/store/user', [storeUserController::class, '__invoke'])->name('admin.users.store');
});