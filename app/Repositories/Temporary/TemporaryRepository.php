<?php

namespace App\Repositories\Temporary;

use App\Jobs\SendEmailJob;
use App\Models\Temporary;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class TemporaryRepository implements TemporaryRepositoryInterface
{
    public function send(string $username): void
    {
        /** @var Temporary $temporary */
        $temporary = Temporary::query()->where('email', $username)->first();

        if ($temporary) {
            if (now()->lte($temporary->send_at->addSeconds(env('VERIFICATION_CODE_TRY_TIME_LIMIT')))) {
                $temporary->query()->increment('retries');
                throw new TooManyRequestsHttpException();
            }

            if (now()->gt($temporary->send_at->addSeconds(env('VERIFICATION_CODE_LIFETIME')))) {
                $temporary->code = rand(1111, 9999);
            }

        } else {
            $temporary = new Temporary();
            $temporary->code = rand(1111, 9999);
        }
        $temporary->email = $username;
        $temporary->send_at = now();
        $temporary->retries++;
        $temporary->save();

        dispatch(new SendEmailJob($username, $temporary->code));
    }

    /**
     * @param string $username
     * @param string $code
     * @return void
     * @throws ValidationException
     */
    public function check(string $username, string $code): void
    {
        /** @var Temporary $temporary */
        $temporary = Temporary::query()
            ->where('email', $username)
            ->first();
        if (!$temporary || $temporary->code != $code) {
            throw ValidationException::withMessages(['code' => __('validation.exists', ['attribute' => __('validation.attributes.password')])]);
        }
        $temporary->delete();
    }
}
