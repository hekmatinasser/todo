<?php

namespace App\Repositories\Authenticate;

use Illuminate\Http\Request;

interface AuthenticationRepositoryInterface
{
    public function register(array $parameters): array;

    public function login(array $parameters): array;

    public function forget(array $parameters): void;

    public function reset(array $parameters): array;

    public function changePassword(array $parameters);

    public function setPassword(array $parameters);
}
