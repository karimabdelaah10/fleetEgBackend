<?php

namespace App\Http\Middleware;

use App\Modules\Users\Enums\UserEnum;
use Closure;

class IsCustomer
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
        if ($user = auth()->user()) {
            if ($user->type  == UserEnum::CUSTOMER ) {
                return $next($request);
            }
        }
        abort(403, 'Unauthorized action.');
    }
}
