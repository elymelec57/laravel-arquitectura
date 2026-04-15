<?php

namespace Src\admin\posts\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\admin\posts\infrastructure\repositories\postRepository;
use Src\admin\posts\app\listPostUseCase;

final class ListPostsController extends Controller
{
    public function __invoke()
    {
        try {
            $postRepository = new postRepository();
            $listPost = new listPostUseCase($postRepository);
            $posts = $listPost->execute();
            return inertia('admin/posts/index', ['posts' => $posts]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}