<?php

namespace App\Exceptions;

use App\Http\Responses\Api\V1\Status;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Str;
use LaravelRocket\Foundation\Services\SlackServiceInterface;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @throws \Throwable
     */
    public function report(\Throwable $e): void
    {
        if ($this->shouldReport($e)) {
            if (in_array(app()->environment(), config('slack.targetEnvironment', []))) {
                if (! $e instanceof TokenMismatchException) {
                    // notify to slack
                    try {
                        $slackService = \App::make(SlackServiceInterface::class);
                        $slackService->exception($e);
                    } catch (\Throwable $t) {
                    }
                }
            }
        }

        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @throws \Throwable
     */
    public function render($request, \Throwable $e): \Symfony\Component\HttpFoundation\Response
    {
        if (Str::start($request->path(), 'api/v1')) {
            return Status::error('unknown', $e->getMessage())->withStatus(500)->response();
        }

        return parent::render($request, $e);
    }
}
