<?php

namespace App\Services\Auth;

interface AuthServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return array
     */
    public function login(string $email, string $password): array;
}
