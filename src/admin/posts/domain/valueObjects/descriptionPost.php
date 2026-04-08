<?php

namespace Src\admin\posts\domain\valueObjects;

class descriptionPost
{
    private string $description;
    public function __construct(string $description) {
        if(strlen($description) < 3) {
            throw new \Exception("La descripcion debe tener al menos 3 caracteres");
        }
        if(!preg_match("/^[a-zA-Z ]+$/", $description)) {
            throw new \Exception("La descripcion solo puede contener letras y espacios");
        }
        if(strlen($description) > 100) {
            throw new \Exception("La descripcion no puede exceder los 100 caracteres");
        }
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
