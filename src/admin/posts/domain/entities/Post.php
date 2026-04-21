<?php

namespace Src\admin\posts\domain\entities;

use Src\admin\posts\domain\valueObjects\titlePost;
use Src\admin\posts\domain\valueObjects\descriptionPost;
use Src\admin\posts\domain\valueObjects\userIdPost;
use Src\admin\posts\domain\valueObjects\idPost;

class Post
{
    private idPost $id;
    private titlePost $title;
    private descriptionPost $description;
    private userIdPost $user_id; // id del usuario que creo el post
    // private string $image;
    // private string $category;
    // private string $tags;
    // private string $status;
    // private string $created_at;
    // private string $updated_at;
    public function __construct(idPost $id, titlePost $title, descriptionPost $description, userIdPost $user_id,
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
        $this->user_id = $user_id;
    }

    public function getId(): string
    {
        return $this->id->value();
    }

    public function getTitle(): string
    {
        return $this->title->getTitle();
    }

    public function getDescription(): string
    {
        return $this->description->getDescription();
    }

    public function getUserIdPost(): int
    {
        return $this->user_id->getUserId();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'title' => $this->title->getTitle(),
            'description' => $this->description->getDescription(),
            'user_id' => $this->user_id->getUserId(),
        ];
    }
}