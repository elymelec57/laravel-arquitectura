<?php

namespace Src\admin\posts\domain\entities;

use Src\admin\posts\domain\valueObjects\titlePost;
use Src\admin\posts\domain\valueObjects\descriptionPost;

class Post
{
    private int $id;
    private titlePost $title;
    private descriptionPost $description;
    // private string $image;
    // private string $category;
    // private string $tags;
    // private string $status;
    // private string $created_at;
    // private string $updated_at;
    public function __construct(int $id, titlePost $title, descriptionPost $description,
        // public string $image,
        // public string $category,
        // public string $tags,
        // public string $status,
        // public string $created_at,
        // public string $updated_at,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title->getTitle();
    }

    public function getDescription(): string
    {
        return $this->description->getDescription();
    }
}