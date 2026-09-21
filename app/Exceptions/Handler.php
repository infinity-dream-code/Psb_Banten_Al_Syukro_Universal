<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (TokenMismatchException $e, $request) {
            if ($request->hasSession()) {
                $request->session()->regenerateToken();
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Sesi formulir kedaluwarsa. Silakan coba lagi.'], 419);
            }

            $target = $request->headers->get('referer');
            if (!$target || $target === $request->fullUrl()) {
                $target = $request->user() ? $request->user()->homePath() : '/ServiceLogin';
            }

            return redirect()->to($target)
                ->withInput($request->except('_token', 'password', 'password_confirmation'));
        });

        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof AuthenticationException
                || $e instanceof ValidationException
                || $e instanceof HttpExceptionInterface
            ) {
                return null;
            }

            $isTransient = $e instanceof TokenMismatchException
                || $e instanceof ConnectionException
                || $e instanceof RequestException
                || $e instanceof QueryException
                || $e instanceof ModelNotFoundException
                || $e instanceof \GuzzleHttp\Exception\GuzzleException
                || $e instanceof \ErrorException
                || ($e instanceof \Error && str_contains($e->getMessage(), 'null'));

            if (!$isTransient || $request->expectsJson()) {
                return null;
            }

            report($e);

            $user = $request->user();
            $previous = url()->previous();
            $target = ($previous && $previous !== $request->fullUrl())
                ? $previous
                : ($user ? $user->homePath() : $request->fullUrl());

            if ($user || $request->hasSession()) {
                return redirect()->to($target);
            }

            return null;
        });
    }
}
