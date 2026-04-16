<?php

namespace Src\admin\user\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\admin\user\infrastructure\repositories\userRepository;
use Src\admin\user\app\GetAllUserUseCase;

class GetAllUserController extends Controller
{

    public function __invoke()
    {
        try {
            $userRepository = new userRepository();
            $getAllUserUseCase = new GetAllUserUseCase($userRepository);
            $users = $getAllUserUseCase->execute();
            return inertia('admin/user/index', ['users' => $users]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
