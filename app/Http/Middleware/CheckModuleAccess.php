<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccess
{
    public function handle(Request $request, Closure $next, string $moduleName): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $role = $user->role;

        if ($role?->name === 'admin') {
            return $next($request);
        }

        $hasAccess = $role?->programModules()
            ->where('name', $moduleName)
            ->wherePivot('can_view', true)
            ->exists();

        if (! $hasAccess) {
            abort(403, 'Unauthorized access to this module.');
        }

        return $next($request);
    }
}
