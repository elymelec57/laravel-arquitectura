<?php

namespace Src\admin\user\domain\contracts;

use Src\admin\user\domain\entities\User;

interface UserRepositoryInterface
{
    public function create(User $user): void;
    public function update(User $user): void;
    public function delete(User $user): void;
    public function findById(int $id): ?User;
    public function findAll(): array;
}
