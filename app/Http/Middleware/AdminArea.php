<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserGroup as UserGroup;

class AdminArea {

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if(!UserGroup::isAdmin($user->user_group)) {
            return response(view('errors.403'), 403);
        }

        return $next($request);
    }
}