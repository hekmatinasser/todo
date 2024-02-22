<?php

namespace App\Repositories\Temporary;

interface TemporaryRepositoryInterface
{
    public function send(string $username): void;
    public function check(string $username, string $code);
}
