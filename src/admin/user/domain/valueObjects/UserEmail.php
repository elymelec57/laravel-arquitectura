<?php

namespace Src\admin\user\domain\valueObjects;

class UserEmail
{
    private string $email;
    public function __construct(string $email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("El email no es valido");
        }
        if(strlen($email) > 255) {
            throw new \Exception("El email no puede exceder los 255 caracteres");
        }
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
