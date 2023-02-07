<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Support\Str;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth($request)) {
            return $next($request);
        } else {
            return response()->json([
                'status' => 'error',
                'code' => 403,
                'message' => 'Invalid token',
            ], 403);
        }
    }

    protected function auth($request)
    {
        $header = $request->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7) == config('api.token');
        }
    }
}
