<?php

namespace Src\admin\posts\infrastructure\repositories;

use Src\admin\posts\domain\contracts\postRepositoryInterface;
use Src\admin\posts\domain\entities\Post;
use Src\admin\posts\domain\valueObjects\titlePost;
use Src\admin\posts\domain\valueObjects\descriptionPost;
use App\Models\Post as PostModel;

class postRepository implements postRepositoryInterface
{
    public function create(Post $post): void
    {
        PostModel::create([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'description' => $post->getDescription(),
        ]);
    }

    // public function update(Post $post): void
    // {
    //     $post->save();
    // }

    // public function delete(Post $post): void
    // {
    //     $post->delete();
    // }

    public function findById(int $id): ?Post
    {
        $post = PostModel::find($id);
        return new Post(
            $post->id,
            new titlePost($post->title),
            new descriptionPost($post->description)
        );
    }

    public function findAll(): array
    {
       $posts = PostModel::all();
        return $posts->map(function ($post) {
            return new Post(
                $post->id,
                new titlePost($post->title),
                new descriptionPost($post->description)
            );
        })->toArray();
    }
}
