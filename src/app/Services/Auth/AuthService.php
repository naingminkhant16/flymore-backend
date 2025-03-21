<?php

namespace App\Services\Auth;

use App\Exceptions\LoginFailException;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

readonly class AuthService implements AuthServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws LoginFailException
     */
    public function login(string $email, string $password): array
    {
        $user = $this->userRepository->getByEmail($email);
        if (!$user || !Hash::check($password, $user->password)) {
            throw new LoginFailException();
        }

        $token = $user->createToken(uuid_create())->plainTextToken;
        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
