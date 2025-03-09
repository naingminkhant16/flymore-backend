<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    public function report(Throwable $e): void
    {
        Log::error($e->getMessage());
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            throw new ResourceNotFoundException(
                str_replace('App\\Models\\', '', $e->getModel()),
                $e->getIds()[0]
            );
        }

        return parent::render($request, $e);
    }
}
