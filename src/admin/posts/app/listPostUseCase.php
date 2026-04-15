<?php

namespace Src\admin\posts\app;

use Src\admin\posts\domain\contracts\ListPostsInterface;

final class listPostUseCase
{
    public function __construct(private ListPostsInterface $listPostsInterface)
    {
    }

    public function execute()
    {
        $posts = $this->listPostsInterface->getAllPosts();
        return array_map(function ($post) {
            return $post->toArray();
        }, $posts);
    }
}
