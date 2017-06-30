<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfApplicationIsActive
{
    /**
     * Check if application is active for
     * incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(appIsActive(settings()->active, $request->user())) {
            return $next($request);
        }

        auth()->logout();

        return redirect('/')
            ->with(['status' => 'Applicatie is niet actief, contacteer de beheerder', 'class' => 'is-danger']);
    }
}
