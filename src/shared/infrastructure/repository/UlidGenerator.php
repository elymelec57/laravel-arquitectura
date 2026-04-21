<?php

namespace Src\shared\infrastructure\repository;

use Src\shared\domain\contracts\identityGenerator;
use Illuminate\Support\Str;

class UlidGenerator implements identityGenerator
{
    public function generate(): string
    {
        return Str::ulid();
    }
}