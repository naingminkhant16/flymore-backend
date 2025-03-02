<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $user)
    {
    }

    public function getByEmail(string $email): User|null
    {
        return $this->user->where('email', $email)->first();
    }
}
