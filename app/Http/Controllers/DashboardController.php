<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\RestaurantManager;
use App\UserGroup as UserGroup;

class DashboardController extends Controller {
    
    public function index() {
        $user = Auth::user();
        $restaurants = [];

        if(UserGroup::isAdmin($user->user_group)) {
            $restaurants = Restaurant::all();
        } else {
            $ids = RestaurantManager::where('manager_id', Auth::id())->get();  
            
            if(!$ids->isEmpty()) {
                foreach($ids as $id) {
                    $restaurants[] = Restaurant::where('id',$id->restaurant_id)->first();
                }
            }
        }
        return view('index', ['restaurants' => $restaurants]);
    }
}