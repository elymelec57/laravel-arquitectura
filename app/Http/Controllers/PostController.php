<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

/**
 * ==========================================
 * S - Single Responsibility Principle (SRP)
 * ==========================================
 * Un controlador solo debería encargarse de RECIBIR peticiones HTTP 
 * y DEVOLVER respuestas HTTP (o vistas de renderizado como Inertia).
 * 
 * No contiene:
 *   - Lógica de negocio core (PostService la tiene).
 *   - Reglas de validación (PostRequest la tiene).
 *   - Lógica en SQL u ORM directo (el Repository la tiene).
 */
class PostController extends Controller
{
    private PostService $postService;

    // DIP: Inyectamos el componente de un nivel inferior al controlador
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        
        return Inertia::render('Posts/Index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(PostRequest $request)
    {
        $this->postService->createPost($request->validated());
        
        return redirect()->route('posts.index')
                         ->with('message', 'Post creado de acuerdo a SOLID e Inertia.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->postService->updatePost($post, $request->validated());
        
        return redirect()->route('posts.index')
                         ->with('message', 'Post actualizado exitosamente.');
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);
        
        return redirect()->route('posts.index')
                         ->with('message', 'Post eliminado cumpliendo SRP.');
    }
}
