<?php

namespace Src\admin\posts\domain\contracts;

use Src\admin\posts\domain\entities\Post;
interface postRepositoryInterface
{
    public function create(Post $post): void;
    // public function update(Post $post): void;
    // public function delete(Post $post): void;
    public function findById(int $id): ?Post;

    // public function findAll(): array;
}