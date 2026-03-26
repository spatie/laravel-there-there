<?php

namespace Spatie\ThereThere\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsValidThereThereRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $secret = config('there-there.secret');

        if (! $secret) {
            abort(403, 'There There secret is not configured.');
        }

        $signature = $request->header('X-There-There-Signature');

        if (! $signature) {
            abort(403, 'Missing signature.');
        }

        $computedSignature = hash_hmac('sha256', $request->getContent(), $secret);

        if (! hash_equals($computedSignature, $signature)) {
            abort(403, 'Invalid signature.');
        }

        return $next($request);
    }
}
