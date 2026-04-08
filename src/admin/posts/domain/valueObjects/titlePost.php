<?php

namespace Src\admin\posts\domain\valueObjects;

class titlePost
{
    private string $title;
    public function __construct(string $title) {
        if(strlen($title) < 3) {
            throw new \Exception("El titulo debe tener al menos 3 caracteres");
        }
        if(!preg_match("/^[a-zA-Z ]+$/", $title)) {
            throw new \Exception("El titulo solo puede contener letras y espacios");
        }
        if(strlen($title) > 50) {
            throw new \Exception("El titulo no puede exceder los 50 caracteres");
        }
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}