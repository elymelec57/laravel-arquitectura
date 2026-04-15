<?php

namespace Src\admin\posts\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\admin\posts\infrastructure\repositories\listPostRepository;
use Src\admin\posts\app\listPostUseCase;

final class ListPostsController extends Controller
{
    public function __invoke()
    {
        try {
            $listPostRepository = new listPostRepository();
            $listPost = new listPostUseCase($listPostRepository);
            $posts = $listPost->execute();
            return inertia('admin/posts/index', ['posts' => $posts]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}