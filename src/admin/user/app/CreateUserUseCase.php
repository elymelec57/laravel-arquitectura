<?php

namespace Src\admin\user\app;

use Src\admin\user\domain\contracts\UserRepositoryInterface;
use Src\shared\domain\contracts\identityGenerator;
use Src\admin\user\domain\entities\User;
use Src\admin\user\domain\valueObjects\UserEmail;
use Src\admin\user\domain\valueObjects\UserName;
use Src\admin\user\domain\valueObjects\UserPassword;
use Src\admin\user\domain\valueObjects\UserId;

class CreateUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository, private identityGenerator $identityGenerator)
    {
    }

    public function execute(string $name, string $email, string $password): User
    {
        $id = $this->identityGenerator->generate();
        $user = new User(new UserId($id), new UserName($name), new UserEmail($email), new UserPassword($password));
        return $this->userRepository->create($user);
    }
}