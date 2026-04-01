<?php

namespace Src\admin\user\domain\valueObjects;

class UserPassword
{
    private string $password;
    public function __construct(string $password) {
        if(strlen($password) < 6) {
            throw new \Exception("La contraseña debe tener al menos 6 caracteres");
        }
        if(strlen($password) > 255) {
            throw new \Exception("La contraseña no puede exceder los 255 caracteres");
        }
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
