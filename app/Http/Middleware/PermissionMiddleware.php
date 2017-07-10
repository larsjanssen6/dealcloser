<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class PermissionMiddleware
{
    /**
     * Check if incoming request has the
     * right permission.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param $permission
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            return redirect('/');
        }

        if (! $request->user()->hasPermissionTo($permission)) {
            if ($request->ajax() || $request->isJson()) {
                return response()->json(['status' => 'Niet geautoriseerd!'], 401);
            }

            return back()
                ->with(['status' => 'Niet geautoriseerd!', 'class' => 'is-danger']);
        }

        return $next($request);
    }
}
