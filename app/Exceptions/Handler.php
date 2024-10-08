<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException; // 追加

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // セッションタイムアウト時はログインページにリダイレクトさせる
	public function render($request, Throwable $exception) {
		if ($exception instanceof TokenMismatchException) {
			return redirect()->route('showLogin');
		}

		return parent::render($request, $exception);
	}

    //　別パターン
    // public function render($request, \Throwable $e)
    // {
    //     if ($e instanceof TokenMismatchException) {
    //         return redirect()
    //                 ->back();
    //     }
    //     return parent::render($request, $e);
    // }
}
