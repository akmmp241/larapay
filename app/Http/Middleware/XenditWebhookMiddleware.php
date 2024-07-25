<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class XenditWebhookMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! ($request->hasHeader('X-Callback-Token')
            && $request->header('X-Callback-Token') === env('XENDIT_WEBHOOK_KEY'))) {
            throw new UnauthorizedException("Invalid X-Callback-Token");
        }

        return $next($request);
    }
}
