<?php

namespace Src\shared\domain\contracts;

interface identityGenerator
{
    public function generate(): string;
}
