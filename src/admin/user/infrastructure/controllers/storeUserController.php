<?php

namespace Src\admin\user\infrastructure\controllers;

use Src\admin\user\app\CreateUserUseCase;
use Src\admin\user\infrastructure\repositories\userRepository;
use Src\admin\user\infrastructure\validators\storeUserRequest;
use App\Http\Controllers\Controller;

final class storeUserController extends Controller
{
    public function __invoke(storeUserRequest $request)
    {
        try {
            $userRepository = new userRepository();
            $createUser = new CreateUserUseCase($userRepository);
            $createUser->execute(
                $request->id,
                $request->name,
                $request->email,
                $request->password
            );
            return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
