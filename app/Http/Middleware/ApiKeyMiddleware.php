<?php

namespace App\Http\Middleware;

use App\Exceptions\GeneralJsonException;
use App\Exceptions\UnauthorizedApiCall;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws GeneralJsonException
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('API-KEY') ||  $request->header('API-KEY') !== config('app.api_key')) {
            throw new UnauthorizedApiCall();
        }

        return $next($request);
    }
}
