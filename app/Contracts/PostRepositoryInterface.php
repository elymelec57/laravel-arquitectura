<?php

namespace App\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

/**
 * ==========================================
 * I - Interface Segregation Principle (ISP)
 * ==========================================
 * Definimos métodos concretos en nuestra interfaz. 
 * Para ir un paso más allá, podríamos dividir en 
 * PostReaderInterface y PostWriterInterface,
 * pero dentro del paradigma Eloquent esto suele estar unido bajo un Repository.
 */
interface PostRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Post;
    public function create(array $data): Post;
    public function update(Post $post, array $data): bool;
    public function delete(Post $post): bool;
}
