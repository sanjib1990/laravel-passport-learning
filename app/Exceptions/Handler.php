<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler
 *
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * @param  \Exception $exception
     *
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        $code = 500;

        if ($request->isJson()) {
            switch (class_basename($exception)) {
                case 'ValidationException':
                    $errors = $exception->errors();
                    $code = $exception->status;
                    break;
                case 'ModelNotFoundException':
                    $errors = ["error"  => "Not Found"];
                    $code = 404;
                    break;
                default:
                    $errors = [
                        'error' => $exception->getMessage(),
                        'stack' => $exception->getTrace()
                    ];

                    $code = $exception->getCode() === 0 ? $code : $exception->getCode();
            }

            return response()->json($errors, $code);
        }

        return parent::render($request, $exception);
    }
}
