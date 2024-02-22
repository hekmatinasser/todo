<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authenticate\CheckTwoFactorSecretRequest;
use App\Http\Requests\Authenticate\ResetTwoFactorSecretRequest;
use App\Http\Requests\Authenticate\SetPhotoRequest;
use App\Http\Requests\Authenticate\SetTwoFactorSecretRequest;
use App\Http\Requests\Authenticate\UpdateRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\Authenticate\AuthenticationRepositoryInterface;
use App\Http\Requests\Authenticate\ChangePasswordRequest;
use App\Http\Requests\Authenticate\ForgetRequest;
use App\Http\Requests\Authenticate\LoginRequest;
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
    public function setTwoFactorSecret(SetTwoFactorSecretRequest $request): JsonResponse
    {
        $this->authenticationRepository->setTwoFactorSecret($request->validated());

        return Responser::success();

    }

    public function checkTwoStepFactorSecret(CheckTwoFactorSecretRequest $request): JsonResponse
    {
        $this->authenticationRepository->checkTwoStepFactorSecret($request->validated());

        return Responser::success();
    }

    public function forgetTwoStepFactorSecret(): JsonResponse
    {
        $this->authenticationRepository->forgetTwoStepFactorSecret();

        return Responser::success();
    }

    public function resetTwoStepFactorSecret(ResetTwoFactorSecretRequest $request): JsonResponse
    {
        $this->authenticationRepository->resetTwoStepFactorSecret($request->validated());

        return Responser::success();
    }

    public function setPhoto(SetPhotoRequest $request): JsonResponse
    {
        $this->authenticationRepository->setPhoto($request);

        return Responser::success();
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $this->authenticationRepository->update($request->validated());

        return Responser::info(new UserResource(auth()->user()));
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user->currentAccessToken()->delete();

        return Responser::success();
    }
}
