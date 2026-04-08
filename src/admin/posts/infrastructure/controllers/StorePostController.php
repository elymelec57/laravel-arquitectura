<?php

namespace Src\admin\posts\infrastructure\controllers;

use Src\admin\posts\app\storePostUseCase;
use Src\admin\posts\infrastructure\repositories\postRepository;
use Src\admin\posts\infrastructure\validators\storePostRequest;
use App\Http\Controllers\Controller;

final class StorePostController extends Controller
{
    public function __invoke(storePostRequest $request)
    {
        try {
            $postRepository = new postRepository();
            $storePost = new storePostUseCase($postRepository);
            $storePost->execute(
                $request->id,
                $request->title,
                $request->description
            );
            return redirect()->route('admin.posts.index')->with('success', 'Post creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
