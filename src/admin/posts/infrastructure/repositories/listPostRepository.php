<?php

namespace Src\admin\posts\infrastructure\repositories;

use Src\admin\posts\domain\contracts\ListPostsInterface;
use Src\admin\posts\domain\entities\Post;
use Src\admin\posts\domain\valueObjects\idPost;
use Src\admin\posts\domain\valueObjects\titlePost;
use Src\admin\posts\domain\valueObjects\descriptionPost;
use Src\admin\posts\domain\valueObjects\userIdPost;
use App\Models\Post as PostModel;

class listPostRepository implements ListPostsInterface
{
    public function getAllPosts(): array
    {
        $posts = PostModel::all();
        return $posts->map(function ($post) {
            return new Post(
                new idPost($post->id),
                new titlePost($post->title),
                new descriptionPost($post->description),
                new userIdPost($post->user_id)
            );
        })->toArray();
    }
}