<?php

namespace Src\admin\user\domain\valueObjects;

class UserName
{
    private string $name;
    public function __construct(string $name) {
        if(strlen($name) < 3) {
            throw new \Exception("El nombre debe tener al menos 3 caracteres");
        }
        if(!preg_match("/^[a-zA-Z ]+$/", $name)) {
            throw new \Exception("El nombre solo puede contener letras y espacios");
        }
        if(strlen($name) > 50) {
            throw new \Exception("El nombre no puede exceder los 50 caracteres");
        }
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}