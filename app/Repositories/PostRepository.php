<?php

namespace App\Repositories;

use App\Contracts\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

/**
 * ==========================================
 * L - Liskov Substitution Principle (LSP)
 * ==========================================
 * Implementamos el contrato al pie de la letra. Cualquier otra 
 * clase (ej. RedisPostRepository) que firme PostRepositoryInterface
 * podrá sustituir a esta sin romper el sistema, porque las firmas
 * de los métodos coinciden.
 */
class PostRepository implements PostRepositoryInterface
{
    public function all(): Collection
    {
        return Post::all();
    }

    public function find(int $id): ?Post
    {
        return Post::findOrFail($id);
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(Post $post, array $data): bool
    {
        return $post->update($data);
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}
