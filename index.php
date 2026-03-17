<?php

/**
 * ==========================================
 * S - Single Responsibility Principle (SRP)
 * ==========================================
 * Una clase debe tener una sola razón para cambiar, es decir, 
 * debe tener una sola responsabilidad.
 * 
 * Aquí, la clase `Post` solo se encarga de representar los datos de la entidad 
 * de publicación y su estado. No sabe cómo guardarse en la base de datos ni validarse.
 */
class Post {
    public string $id;
    public string $title;
    public string $content;

    public function __construct(string $id, string $title, string $content) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }
}

/**
 * Clase Validator separada para cumplir con el SRP.
 * Su única responsabilidad es validar los datos de un Post.
 */
class PostValidator {
    public function validate(Post $post): bool {
        if (empty(trim($post->title)) || empty(trim($post->content))) {
            throw new Exception("El título y el contenido son obligatorios.");
        }
        return true;
    }
}

/**
 * ==========================================
 * I - Interface Segregation Principle (ISP)
 * ==========================================
 * Los clientes no deben verse obligados a depender de interfaces que no utilizan.
 * En lugar de tener una gran interfaz `PostRepositoryInterface` con operaciones de 
 * lectura, escritura, estadísticas, etc., la dividimos en interfaces modulares.
 * 
 * Aquí creamos una interfaz para lectura y otra para escritura.
 */
interface PostReaderInterface {
    public function findById(string $id): ?Post;
    public function findAll(): array;
}

interface PostWriterInterface {
    public function save(Post $post): void;
    public function delete(string $id): void;
}

// Interfaz combinada solo para entidades que necesitan ambos (DIP también)
interface PostRepositoryInterface extends PostReaderInterface, PostWriterInterface {}

/**
 * ==========================================
 * L - Liskov Substitution Principle (LSP)
 * ==========================================
 * Las clases derivadas deben poder sustituir a sus clases base sin alterar el 
 * correcto funcionamiento del programa.
 * 
 * Al heredar/implementar `PostRepositoryInterface`, garantizamos que `MemoryPostRepository`, 
 * `DatabasePostRepository`, o cualquier otro repositorio funcione de la misma manera
 * para un cliente que espera un `PostRepositoryInterface`.
 */
class MemoryPostRepository implements PostRepositoryInterface {
    private array $posts = [];

    public function findById(string $id): ?Post {
        return $this->posts[$id] ?? null;
    }

    public function findAll(): array {
        return array_values($this->posts);
    }

    public function save(Post $post): void {
        $this->posts[$post->id] = $post;
    }

    public function delete(string $id): void {
        unset($this->posts[$id]);
    }
}

/**
 * ==========================================
 * O - Open/Closed Principle (OCP)
 * ==========================================
 * Las entidades de software deben estar abiertas para extensión, pero cerradas para modificación.
 * 
 * Si queremos agregar una nueva forma de notificar (ej. Slack, Push Notifications), 
 * no debemos modificar la clase PostService sino crear una nueva clase y extender 
 * la interfaz `NotificationServiceInterface`.
 */

interface NotificationServiceInterface {
    public function send(string $message): void;
}

class EmailNotificationService implements NotificationServiceInterface {
    public function send(string $message): void {
        echo "[✉️ Email enviado]: $message\n<br>";
    }
}

class SmsNotificationService implements NotificationServiceInterface {
    public function send(string $message): void {
        echo "[📱 SMS enviado]: $message\n<br>";
    }
}

/**
 * ==========================================
 * D - Dependency Inversion Principle (DIP)
 * ==========================================
 * Los módulos de alto nivel no deben depender de los módulos de bajo nivel. 
 * Ambos deben depender de abstracciones (interfaces).
 * 
 * `PostService` no depende de `MemoryPostRepository` o `EmailNotificationService` 
 * directamente. Depende de `PostRepositoryInterface` y `NotificationServiceInterface` 
 * (abstracciones), solicitándolas (inyectándolas) por el constructor.
 */
class PostService {
    private PostRepositoryInterface $repository;
    private PostValidator $validator;
    private NotificationServiceInterface $notifier;

    public function __construct(
        PostRepositoryInterface $repository, 
        PostValidator $validator,
        NotificationServiceInterface $notifier
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->notifier = $notifier;
    }

    /**
     * Coordina la creación delegando las responsabilidades al repositorio, validador y notificador.
     */
    public function createPost(string $id, string $title, string $content): Post {
        $post = new Post($id, $title, $content);
        
        $this->validator->validate($post);
        $this->repository->save($post);
        $this->notifier->send("Nuevo post creado: " . $title);

        return $post;
    }

    public function getPost(string $id): ?Post {
        return $this->repository->findById($id);
    }

    public function getAllPosts(): array {
        return $this->repository->findAll();
    }

    public function updatePost(string $id, string $title, string $content): Post {
        $post = $this->repository->findById($id);
        if (!$post) {
            throw new Exception("Post no encontrado para actualizar.");
        }

        $post->title = $title;
        $post->content = $content;

        $this->validator->validate($post);
        $this->repository->save($post);
        $this->notifier->send("Post actualizado: " . $title);

        return $post;
    }

    public function deletePost(string $id): void {
        $post = $this->repository->findById($id);
        if ($post) {
            $this->repository->delete($id);
            $this->notifier->send("Post eliminado: " . $post->title);
        }
    }
}

// ==========================================
// EJEMPLO DE USO (Cliente / Entrypoint)
// ==========================================
echo "<h2>Demostración CRUD con Principios SOLID</h2>";
echo "<pre>";

try {
    // 1. Configuramos las dependencias (Normalmente lo haría un Contenedor de Inyección de Dependencias)
    $repository = new MemoryPostRepository();   // LSP: Sustituible por DatabasePostRepository
    $validator  = new PostValidator();          // SRP: Solo valida
    $notifier   = new EmailNotificationService(); // OCP: Email, modificable por cualquier otra

    // 2. Inyección por constructor (DIP)
    $postService = new PostService($repository, $validator, $notifier);

    // 3. Ejecutando el CRUD
    echo "<b>--- CREAR (CREATE) ---</b>\n<br>";
    $postService->createPost("1", "Aprende SOLID", "El principio SRP dicta...");
    $postService->createPost("2", "Programación Orientada a Objetos", "Abstracción, Encapsulamiento...");

    echo "\n<b>--- LEER TODOS (READ) ---</b>\n<br>";
    $posts = $postService->getAllPosts();
    foreach ($posts as $p) {
        echo "- ID " . $p->id . ": " . $p->title . "\n<br>";
    }

    echo "\n<b>--- LEER UNO (READ) ---</b>\n<br>";
    $singlePost = $postService->getPost("1");
    echo "Detalle Leído -> Título: " . $singlePost->title . " | Contenido: " . $singlePost->content . "\n<br>";

    echo "\n<b>--- ACTUALIZAR (UPDATE) ---</b>\n<br>";
    $postService->updatePost("1", "Aprende SOLID en PHP 8", "El SRP es la 'S' de SOLID...");
    $updatedPost = $postService->getPost("1");
    echo "Actualizado -> Título: " . $updatedPost->title . "\n<br>";

    echo "\n<b>--- ELIMINAR (DELETE) ---</b>\n<br>";
    $postService->deletePost("2");

    echo "\n<b>--- RESULTADO DESPUÉS DE ELIMINAR ---</b>\n<br>";
    $postsAfterDelete = $postService->getAllPosts();
    foreach ($postsAfterDelete as $p) {
        echo "- ID " . $p->id . ": " . $p->title . "\n<br>";
    }

    // Demostrando el Open/Closed Principle
    echo "\n<b>--- EXTENSIÓN: CAMBIANDO A NOTIFICACIONES POR SMS SIN ALTARAR PostService ---</b>\n<br>";
    $smsNotifier = new SmsNotificationService();
    $postServiceWithSMS = new PostService($repository, $validator, $smsNotifier);
    $postServiceWithSMS->updatePost("1", "SOLID Masterclass", "Usando dependencia de SMS.");

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

echo "</pre>";

?>
