<?php

namespace App\Repositories\User;

use App\Models\User;

readonly class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $user)
    {
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): User|null
    {
        return $this->user->where('email', $email)->first();
    }
}
