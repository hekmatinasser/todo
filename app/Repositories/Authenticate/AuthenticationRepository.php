<?php

namespace App\Repositories\Authenticate;

use App\Models\User;
use App\Repositories\Temporary\TemporaryRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationRepository implements AuthenticationRepositoryInterface
{
    public function __construct(protected TemporaryRepositoryInterface $temporaryRepository)
    {
    }

    /**
     * @param array $parameters
     * @return array
     * @throws ValidationException
     */
    public function register(array $parameters): array
    {
        /** @var User $user */
        $user = User::query()
            ->where('email', $parameters['email'])
            ->first();

        if ($user) {
            throw ValidationException::withMessages(['email' => __('validation.invalid',
                ['attribute' => __('validation.attributes.email')]
            )]);
        }

        /** @var User $user */
        $user = User::query()
            ->create([
                'email'    => $parameters['email'],
                'password' => $parameters['password'],
            ]);


        $token = $user->createToken('app');

        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
        ];
    }

    /**
     * @param array $parameters
     * @return array
     * @throws ValidationException
     */
    public function login(array $parameters): array
    {
        /** @var User $user */
        $user = User::query()
            ->where('email', $parameters['email'])
            ->first();

        if (!$user) {
            throw ValidationException::withMessages(['email' => __('validation.invalid',
                ['attribute' => __('validation.attributes.email')]
            )]);
        }

        if (!Hash::check($parameters['password'], $user->password)) {
            throw ValidationException::withMessages(['password' => __('validation.invalid',
                ['attribute' => __('validation.attributes.password')]
            )]);
        }

        $token = $user->createToken('app');

        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
        ];
    }

    /**
     * @param array $parameters
     */
    public function forget(array $parameters): void
    {
        $this->temporaryRepository->send($parameters['email']);
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function reset(array $parameters): array
    {
        $this->temporaryRepository->check($parameters['email'], $parameters['code']);

        return ['code' => encrypt($parameters['email'])];
    }

    public function setPassword(array $parameters): array
    {
        $username = decrypt($parameters['code']);

        /** @var User $user */
        $user = User::query()
            ->where('email', $username)
            ->firstOrFail();

        $token = $user->createToken('admin');

        return [
            'user'  => $user,
            'token' => $token->plainTextToken,
        ];
    }


    /**
     * @param array $parameters
     * @return bool
     */
    public function changePassword(array $parameters): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->update(['password' => Hash::make($parameters['password'])]);
    }
}
