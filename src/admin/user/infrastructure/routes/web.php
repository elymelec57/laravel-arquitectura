<?php

namespace Src\admin\user\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\admin\user\infrastructure\controllers\createUserController;
use Src\admin\user\infrastructure\controllers\storeUserController;
use Src\admin\user\infrastructure\controllers\getAllUserController;
use Src\admin\user\infrastructure\middelware\accedAdmin;

Route::prefix('/admin/users')->middleware([accedAdmin::class])->group(function () {
    Route::get('/', [getAllUserController::class, '__invoke'])->name('admin.users.index');
    Route::get('/create', [createUserController::class, '__invoke'])->name('admin.users.create');
    Route::post('/store/user', [storeUserController::class, '__invoke'])->name('admin.users.store');
});