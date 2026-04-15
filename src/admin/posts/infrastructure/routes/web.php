<?php

namespace Src\admin\posts\infrastructure\routes;

use Illuminate\Support\Facades\Route;
use Src\admin\posts\infrastructure\controllers\CreatePostController;
use Src\admin\posts\infrastructure\controllers\StorePostController;
use Src\admin\posts\infrastructure\controllers\ListPostsController;

Route::prefix('/admin/posts')->group(function () {
    Route::get('/', [ListPostsController::class, '__invoke'])->name('admin.posts.index');
    Route::get('/create', [CreatePostController::class, '__invoke'])->name('admin.posts.create');
    Route::post('/store/post', [StorePostController::class, '__invoke'])->name('admin.posts.store');
});