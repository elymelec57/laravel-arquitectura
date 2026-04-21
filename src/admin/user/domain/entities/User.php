<?php

namespace Src\admin\user\domain\entities;

use Src\admin\user\domain\valueObjects\UserEmail;
use Src\admin\user\domain\valueObjects\UserName;
use Src\admin\user\domain\valueObjects\UserPassword;
use Src\admin\user\domain\valueObjects\UserId;

class User
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;
    public function __construct(UserId $id, UserName $name, UserEmail $email, UserPassword $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id->value();
    }

    public function getName(): string
    {
        return $this->name->getName();
    }

    public function getEmail(): string
    {
        return $this->email->getEmail();
    }

    public function getPassword(): string
    {
        return $this->password->getPassword();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->getName(),
            'email' => $this->email->getEmail(),
            'password' => $this->password->getPassword(),
        ];
    }
}
