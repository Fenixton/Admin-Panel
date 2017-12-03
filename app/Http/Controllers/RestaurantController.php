<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Restaurant as Restaurant;
use App\RestaurantManager as RestaurantManager;
use App\City as City;
use App\UserGroup as UserGroup;

class RestaurantController extends Controller { 

    public function get($id) {
        $restaurant = \App\Restaurant::find($id);
        $cityName = \App\City::find($restaurant->city_id)->name;
        return view('restaurant', ['restaurant' => $restaurant, 'cityName' => $cityName, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    private function getAllRestaurants() {
        $user = \Auth::user();
        $restaurants = [];

        if(UserGroup::isAdmin($user->user_group)) {
            $restaurants = Restaurant::all();
        } else {
            $ids = RestaurantManager::where('manager_id', $user->id)->get();  

            if(!$ids->isEmpty()) {
                foreach($ids as $id) {
                    $restaurants[] = Restaurant::where('id', $id->restaurant_id)->first();
                }
            }
        }

        return $restaurants;
    }
    
    public function getEdit($id) {
        $restaurant = \App\Restaurant::find($id);
        return view('editrestaurant', ['id' => $id, 'restaurant' => $restaurant, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function postEdit($id, Request $request) {
        $restaurant = \App\Restaurant::find($id);
        
        $validator = Validator::make(
            $request->all(),
            array (
                'average_bill' => 'required|max:255'
            )
        );
        
        if (!$validator->fails()) {
            $restaurant->average_bill = $request->average_bill;
            $restaurant->save();
        } else {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        return redirect('restaurant/'.$id.'');
    }
}