<?php

namespace Src\admin\posts\infrastructure\controllers;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
final class CreatePostController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('admin/posts/create');
    }
}