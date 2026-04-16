<?php

namespace Src\admin\user\app;
use Src\admin\user\domain\contracts\UserRepositoryInterface;
class GetAllUserUseCase
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        return $this->userRepository->findAll();
    }
}