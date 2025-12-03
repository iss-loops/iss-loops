<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Obtener el idioma del primer segmento de la URL
        $locale = $request->segment(1);
        
        // 2. Verificar si es un idioma válido
        $availableLocales = array_keys(config('locales.available'));
        
        if (in_array($locale, $availableLocales)) {
            // 2a. Si es válido, establecerlo
            App::setLocale($locale);
            Session::put('locale', $locale);
            
            // 2b. Si el usuario está autenticado, guardar preferencia
            if (auth()->check()) {
                $user = auth()->user();
                if ($user->preferred_locale !== $locale) {
                    $user->update(['preferred_locale' => $locale]);
                }
            }
        } else {
            // 3. Si no hay idioma en URL, usar preferencias
            $locale = $this->getPreferredLocale();
            App::setLocale($locale);
            Session::put('locale', $locale); // ⬅️ NUEVO: Guardar en sesión también
        }

        return $next($request);
    }

    /**
     * Get user's preferred locale from multiple sources
     */
    protected function getPreferredLocale(): string
    {
        // Prioridad 1: Usuario autenticado
        if (auth()->check() && auth()->user()->preferred_locale) {
            return auth()->user()->preferred_locale;
        }

        // Prioridad 2: Sesión
        if (Session::has('locale')) {
            return Session::get('locale');
        }

        // Prioridad 3: Default
        return config('locales.default', 'es');
    }
}