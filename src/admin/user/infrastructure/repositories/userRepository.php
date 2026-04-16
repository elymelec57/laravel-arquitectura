<?php

namespace Src\admin\user\infrastructure\repositories;

use Illuminate\Support\Collection;
use Src\admin\user\domain\contracts\UserRepositoryInterface;
use Src\admin\user\domain\entities\User;
use App\Models\User as UserModel;
use Src\admin\user\domain\valueObjects\UserEmail;
use Src\admin\user\domain\valueObjects\UserName;
use Src\admin\user\domain\valueObjects\UserPassword;

class userRepository implements UserRepositoryInterface
{
    public function create(User $user): User
    {
        // TODO: Implement create() method.
        $userModel = UserModel::create([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);
        $userModel->assignRole('User');
        $user = new User($userModel->id, new UserName($userModel->name), new UserEmail($userModel->email), new UserPassword($userModel->password));
        return $user; 
    }

    // public function update(User $user): void
    // {
    //     // TODO: Implement update() method.
    // }

    // public function delete(User $user): void
    // {
    //     // TODO: Implement delete() method.
    // }

    // public function findById(int $id): ?User
    // {
    //     // TODO: Implement findById() method.
    // }

    public function findAll(): Collection
    {
        // TODO: Implement findAll() method.
        return UserModel::role('User')->get()->map(function ($userModel) {
            return $userModel->toArray();
        });
    }
}
