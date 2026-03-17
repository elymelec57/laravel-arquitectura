<?php

namespace App\Services;

use App\Contracts\PostRepositoryInterface;
use App\Contracts\NotificationServiceInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

/**
 * ==========================================
 * D - Dependency Inversion Principle (DIP)
 * ==========================================
 * Nuestro servicio principal no depende de Modelos
 * (clases concretas) para operar la base de datos ni
 * para notificar. Depende enteramente de INTERFACES (abstracciones).
 * 
 * Es decir, el núcleo de la aplicación de Posts (Módulo Alto Nivel)
 * está totalmente desacoplado del motor de Base de Datos o Email (Módulos Bajo Nivel).
 */
class PostService
{
    private PostRepositoryInterface $repository;
    private NotificationServiceInterface $notifier;

    public function __construct(
        PostRepositoryInterface $repository,
        NotificationServiceInterface $notifier
    ) {
        $this->repository = $repository;
        $this->notifier = $notifier;
    }

    public function getAllPosts(): Collection
    {
        return $this->repository->all();
    }

    public function getPost(int $id): ?Post
    {
        return $this->repository->find($id);
    }

    public function createPost(array $data): Post
    {
        $post = $this->repository->create($data);
        $this->notifier->send("Un nevo post ha sido creado con ID: {$post->id}");
        return $post;
    }

    public function updatePost(Post $post, array $data): bool
    {
        $result = $this->repository->update($post, $data);
        if ($result) {
            $this->notifier->send("El post {$post->id} ha sido actualizado.");
        }
        return $result;
    }

    public function deletePost(Post $post): bool
    {
        $id = $post->id;
        $result = $this->repository->delete($post);
        if ($result) {
            $this->notifier->send("El post {$id} ha sido eliminado.");
        }
        return $result;
    }
}
