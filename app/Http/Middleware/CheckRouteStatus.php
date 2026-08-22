<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RouteToggle;
use Illuminate\Support\Facades\Cache;

class CheckRouteStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();

        if ($routeName) {
            $baseRouteName = explode('.', $routeName)[0];

            $isEnabled = Cache::rememberForever("route_toggle_{$baseRouteName}", function () use ($baseRouteName) {
                $toggle = RouteToggle::where('route_name', $baseRouteName)->first();
                return $toggle ? $toggle->is_enabled : true;
            });
        }

        if (!$isEnabled) {
            abort(404, 'This route is currently disabled.');
        }

        return $next($request);
    }
}
