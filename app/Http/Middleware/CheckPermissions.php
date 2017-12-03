<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\RestaurantManager as RestaurantManager;
use App\UserGroup as UserGroup;

class CheckPermissions {

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if(UserGroup::isAdmin($user->user_group)) {
            return $next($request);
        }

        $perms = RestaurantManager::where('restaurant_id', $request->route('id'))
            ->where('manager_id', $user->id)
            ->get();
        
        if($perms->isEmpty()) {
            return response(view('errors.403'), 403);
        }
            
        return $next($request);
    }
}