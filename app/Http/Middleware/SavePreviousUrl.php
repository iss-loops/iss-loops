<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SavePreviousUrl
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Guardar URL actual en sesión (útil para cambio de idioma)
        if ($request->isMethod('GET') && !$request->ajax()) {
            session(['previous_url' => $request->fullUrl()]);
        }

        return $next($request);
    }
}
