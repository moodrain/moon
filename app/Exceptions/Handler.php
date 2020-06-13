<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        NotFoundHttpException::class,
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(\Throwable $exception)
    {
        parent::report($exception);
    }


    public function render($request, \Throwable $exception)
    {
        $code = 1;
        $msg = '';
        $class = get_class($exception);
        switch($class) {
            case AuthorizationException::class:
                $code = 401;
                $msg = __('user.unauthorized');
                break;
            case ModelNotFoundException::class:
                // no break;
            case NotFoundHttpException::class:
                $code = 404;
                $msg = __('msg.notfound');
                break;
            case ValidationException::class:
                $code = 400;
                $msg = head(head($exception->errors()));
                break;
        }
        if($code === 1) {
            $code = $exception instanceof HttpException ? $exception->getStatusCode() : $exception->getCode();
            $code === 0 && $code = 500;
            $msg = $exception->getMessage();
        }
        if($request->isXmlHttpRequest()) {
            return response()->json([
                'code' => $code,
                'msg' => $msg,
            ]);
        }
        return view('error.index')->with('msg', $msg);
    }

}
