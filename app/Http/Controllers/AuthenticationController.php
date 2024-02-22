<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Authenticate\AuthenticationRepositoryInterface;
use App\Http\Requests\Authenticate\ChangePasswordRequest;
use App\Http\Requests\Authenticate\ForgetRequest;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Http\Requests\Authenticate\RegisterRequest;
use App\Http\Requests\Authenticate\ResetRequest;
use App\Http\Requests\Authenticate\SetPasswordRequest;
use Celysium\Responser\Responser;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    public function __construct(protected AuthenticationRepositoryInterface $authenticationRepository)
    {
    }

    public function profile(): JsonResponse
    {
        return Responser::info(new UserResource(auth()->user()));
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authenticationRepository->login($request->validated());

        return Responser::success(new AuthResource($result));
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authenticationRepository->register($request->validated());

        return Responser::success(new AuthResource($result));
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $this->authenticationRepository->changePassword($request->validated());

        return Responser::success();

    }

    public function forget(ForgetRequest $request): JsonResponse
    {
        $this->authenticationRepository->forget($request->validated());

        return Responser::success();
    }

    public function reset(ResetRequest $request): JsonResponse
    {
        $result = $this->authenticationRepository->reset($request->validated());

        return Responser::success($result);
    }

    public function setPassword(SetPasswordRequest $request): JsonResponse
    {
        $result = $this->authenticationRepository->setPassword($request->validated());

        return Responser::success(new AuthResource($result));
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->currentAccessToken()->delete();

        return Responser::success();
    }
}
