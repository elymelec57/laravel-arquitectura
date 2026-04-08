<?php

namespace Src\admin\posts\app;

use Src\admin\posts\domain\entities\Post;
use Src\admin\posts\domain\contracts\postRepositoryInterface;
use Src\admin\posts\domain\valueObjects\titlePost;
use Src\admin\posts\domain\valueObjects\descriptionPost;

class storePostUseCase
{
    public function __construct(private postRepositoryInterface $postRepository)
    {
    }

    public function execute(int $id, string $title, string $description): void
    {
        $post = new Post($id, new titlePost($title), new descriptionPost($description));
        $this->postRepository->create($post);
    }
}