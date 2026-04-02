<?php

namespace Src\admin\user\app;

use Src\admin\user\domain\contracts\UserRepositoryInterface;
use Src\admin\user\domain\entities\User;
use Src\admin\user\domain\valueObjects\UserEmail;
use Src\admin\user\domain\valueObjects\UserName;
use Src\admin\user\domain\valueObjects\UserPassword;

class CreateUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function execute(int $id, string $name, string $email, string $password): User
    {
        $user = new User($id, new UserName($name), new UserEmail($email), new UserPassword($password));
        return $this->userRepository->create($user);
    }
}