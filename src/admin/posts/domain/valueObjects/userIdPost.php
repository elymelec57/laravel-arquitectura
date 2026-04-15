<?php

namespace Src\admin\posts\domain\valueObjects;

class userIdPost
{
    private int $user_id;
    public function __construct(int $user_id)
    {
        if ($user_id <= 0) {
            throw new \Exception("El id del usuario debe ser mayor a 0");
        }
        if (!is_int($user_id)) {
            throw new \Exception("El id del usuario debe ser un entero");
        }
        $this->user_id = $user_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}