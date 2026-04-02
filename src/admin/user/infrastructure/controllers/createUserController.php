<?php

namespace Src\admin\user\infrastructure\controllers;

use Inertia\Inertia;

class createUserController
{
    public function __invoke()
    {
        return Inertia::render('admin/user/create');
    }
}
