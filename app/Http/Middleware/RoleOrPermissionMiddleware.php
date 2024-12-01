<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleOrPermissionMiddleware
{
    public function handle($request, Closure $next, ...$rolesOrPermissions)
    {
        // Logika pemeriksaan peran atau izin
        return $next($request);
    }
}
