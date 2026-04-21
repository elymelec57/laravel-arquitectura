<?php

namespace Src\admin\posts\domain\valueObjects;

class idPost
{
    private string $id;
    public function __construct(string $id)
    {
        if(empty($id)) {
            throw new \Exception('El id no puede estar vacio');
        }
        if(strlen($id) > 255) {
            throw new \Exception('El id no puede exceder los 255 caracteres');
        }
        if(!preg_match('/^[a-zA-Z0-9]+$/', $id)) {
            throw new \Exception('El id solo puede contener letras y numeros');
        }
        // if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/', $id)) {
        //     throw new \Exception('El id no es valido');
        // }
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }
}