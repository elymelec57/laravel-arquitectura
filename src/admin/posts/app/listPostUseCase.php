<?php

namespace Src\admin\posts\app;

use Src\admin\posts\domain\contracts\postRepositoryInterface;

final class listPostUseCase
{
    public function __construct(private postRepositoryInterface $postRepository)
    {
    }

    public function execute()
    {
        $posts = $this->postRepository->getAllPosts();
        return array_map(function ($post) {
            return $post->toArray();
        }, $posts);
    }
}
