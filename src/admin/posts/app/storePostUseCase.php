<?php

namespace Src\admin\posts\app;

use Src\admin\posts\domain\entities\Post;
use Src\admin\posts\domain\contracts\postRepositoryInterface;
use Src\admin\posts\domain\valueObjects\titlePost;
use Src\admin\posts\domain\valueObjects\descriptionPost;
use Src\admin\posts\domain\valueObjects\userIdPost;
use Src\admin\posts\domain\valueObjects\idPost;
use Src\shared\domain\contracts\identityGenerator;
class storePostUseCase
{
    public function __construct(
        private postRepositoryInterface $postRepository,
        private identityGenerator $identityGenerator
    ) {
    }

    public function execute(string $title, string $description, int $user_id): void
    {
        $id = $this->identityGenerator->generate();
        $post = new Post(new idPost($id), new titlePost($title), new descriptionPost($description), new userIdPost($user_id));
        $this->postRepository->create($post);
    }
}