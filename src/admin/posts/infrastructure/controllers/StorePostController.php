<?php

namespace Src\admin\posts\infrastructure\controllers;

use Src\admin\posts\app\storePostUseCase;
use Src\admin\posts\infrastructure\repositories\postRepository;
use Src\admin\posts\infrastructure\validators\storePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Src\shared\infrastructure\repository\UlidGenerator;
final class StorePostController extends Controller
{
    public function __invoke(storePostRequest $request)
    {
        try {
            $postRepository = new postRepository();
            $Ulid = new UlidGenerator();
            $storePost = new storePostUseCase($postRepository, $Ulid);
            $storePost->execute(
                $request->title,
                $request->description,
                Auth::user()->id
            );
            return redirect()->route('admin.posts.index')->with('success', 'Post creado exitosamente');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
