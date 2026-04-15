<?php

namespace Src\admin\posts\domain\contracts;

interface ListPostsInterface
{
    public function getAllPosts(): array;
}
