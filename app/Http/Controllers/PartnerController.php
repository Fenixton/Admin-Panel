<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Manager as Manager;
use App\Restaurant as Restaurant;
use App\RestaurantManager as RestaurantManager;
use App\Partner as Partner;
use App\UserGroup as UserGroup;
use App\City as City;
use App\PartnerCategories as PartnerCategories;
use App\MenuCategories as MenuCategories;

class PartnerController extends Controller {
    public function getPartners() {
        $partners = Partner::all();
        return view('partners',['partners' => $partners, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function getPartner($item_id) {
        $partner = Partner::find($item_id);
        return view('partner', ['partner' => $partner, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function getPartnerRestaurants($item_id) {
        $restaurants = Restaurant::where('partner_id', $item_id)->get();
        return view('partner-restaurants', ['partnerid' => $item_id, 'restaurants' => $restaurants, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function getAddPartner() {
        return view('addpartner', ['allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function postAddPartner(Request $request) {
        $partner = new Partner;
        $validator = Validator::make(
            $request->all(),
            array (
                'name' => 'required|max:255',
                'description' => 'max:10000',
                'logo' => 'image',
                'poster' => 'image',
                'marker' => 'image'
            )
        );
        if (!$validator->fails()) {
            $partner->name = $request->name;
            $partner->description = $request->description;
            
            if ($request->logo != "") {
                $logo = $request->file('logo');
                $logoName = time().md5($request->name).'.'.$logo->getClientOriginalExtension();
                $logo->move(base_path().'/images/partners/logo', $logoName);
                $partner->logo_url = '/images/partners/logo/'.$logoName;
            }
            if ($request->poster != "") {
                $poster = $request->file('poster');
                $posterName = time().md5($request->name).'.'.$poster->getClientOriginalExtension();
                $poster->move(base_path().'/images/partners/poster', $posterName);
                $partner->poster_url = '/images/partners/poster/'.$posterName;
            }
            if ($request->marker != "") {
                $marker = $request->file('marker');
                $markerName = time().md5($request->name).'.'.$marker->getClientOriginalExtension();
                $marker->move(base_path().'/images/partners/marker', $markerName);
                $partner->marker_url = '/images/partners/marker/'.$markerName;
            }
            $partner->save();
            return redirect('partners');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getEditPartner($item_id) {
        $partner = Partner::find($item_id);
        return view('editpartner', ['partner' => $partner, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function postEditPartner($item_id, Request $request) {
        $partner = Partner::find($item_id);
        $validator = Validator::make(
            $request->all(),
            array (
                'name' => 'required|max:255',
                'description' => 'max:10000',
                'logo' => 'image',
                'poster' => 'image',
                'marker' => 'image'
            )
        );
        if (!$validator->fails()) {
            $partner->name = $request->name;
            $partner->description = $request->description;
            
            if ($request->logo != "") {
                $logo = $request->file('logo');
                $logoName = time().md5($request->name).'.'.$logo->getClientOriginalExtension();
                $logo->move(base_path().'/images/partners/logo', $logoName);
                $partner->logo_url = '/images/partners/logo/'.$logoName;
            }
            if ($request->poster != "") {
                $poster = $request->file('poster');
                $posterName = time().md5($request->name).'.'.$poster->getClientOriginalExtension();
                $poster->move(base_path().'/images/partners/poster', $posterName);
                $partner->poster_url = '/images/partners/poster/'.$posterName;
            }
            if ($request->marker != "") {
                $marker = $request->file('marker');
                $markerName = time().md5($request->name).'.'.$marker->getClientOriginalExtension();
                $marker->move(base_path().'/images/partners/marker', $markerName);
                $partner->marker_url = '/images/partners/marker/'.$markerName;
            }
            $partner->save();
            return redirect('partners');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getDeletePartner($item_id) {
        Partner::destroy($item_id);
        return redirect('partners');
    }
    
    public function getAddRestaurant($item_id) {
        $cities = City::all();
        $managers = Manager::all();
        return view('addrestaurant', ['cities' => $cities, 'partner_id' => $item_id, 'managers' => $managers]);
    }
    
    public function postAddRestaurant($item_id, Request $request) {
        $restaurant = new Restaurant;
        $restaurant_manager = new RestaurantManager;
        $validator = Validator::make(
            $request->all(),
            array (
                'address' => 'required|max:10000',
                'average_bill' => 'required|max:255',
                'city_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'manager_id' => 'required'
            )
        );
        if (!$validator->fails()) {
            $restaurant->partner_id = $item_id;
            $restaurant->address = $request->address;
            $restaurant->average_bill = $request->average_bill;
            $restaurant->city_id = $request->city_id;
            $restaurant->latitude = $request->latitude;
            $restaurant->longitude = $request->longitude;
            if (isset($request->is_available)) {
                $restaurant->status = "AVAILABLE";
            }
            else {
                $restaurant->status = "UNAVAILABLE";
            }
            $unique_key = str_random(8);
            $restaurant->telegram_token = $unique_key;
            $restaurant->save();
            $restaurant_manager->manager_id = $request->manager_id;
            $restaurant_manager->restaurant_id = $restaurant->id;
            $restaurant_manager->save();
            return redirect('partners/info/'.$item_id.'/restaurants');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getEditRestaurant($item_id, $restaurant_id) {
        $restaurant = Restaurant::find($restaurant_id);
        $cities = City::all();
        $managers = Manager::all();
        $manager_id = RestaurantManager::where('restaurant_id', $restaurant->id)->first()->manager_id;
        return view('editrestaurantaspartner', ['cities' => $cities, 'partner_id' => $item_id, 'restaurant' => $restaurant, 'managers' => $managers, 'manager_id' => $manager_id]);
    }
    
    public function postEditRestaurant($item_id, $restaurant_id, Request $request) {
        $restaurant = Restaurant::find($restaurant_id);
        $restaurant_manager = RestaurantManager::where('restaurant_id', $restaurant_id)->first();
        $validator = Validator::make(
            $request->all(),
            array (
                'address' => 'required|max:10000',
                'average_bill' => 'required|max:255',
                'city_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'manager_id' => 'required'
            )
        );
        if (!$validator->fails()) {
            $restaurant->partner_id = $item_id;
            $restaurant->address = $request->address;
            $restaurant->average_bill = $request->average_bill;
            $restaurant->city_id = $request->city_id;
            $restaurant->latitude = $request->latitude;
            $restaurant->longitude = $request->longitude;
            if (isset($request->is_available)) {
                $restaurant->status = "AVAILABLE";
            }
            else {
                $restaurant->status = "NOT_AVAILABLE";
            }
            $restaurant->save();
            $restaurant_manager->manager_id = $request->manager_id;
            $restaurant_manager->restaurant_id = $restaurant->id;
            $restaurant_manager->save();
            return redirect('partners/info/'.$item_id.'/restaurants');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getDeleteRestaurant($item_id, $restaurant_id) {
        Restaurant::destroy($restaurant_id);
        $manager_id = RestaurantManager::where('restaurant_id', $restaurant_id)->first()->id;
        RestaurantManager::destroy($manager_id);
        return redirect('partners/info/'.$item_id.'/restaurants');
    }
    
    public function getPartnerCategories($item_id) {
        $partnerCategories = PartnerCategories::where('partner_id', $item_id)->get();
        $categories = [];
        foreach($partnerCategories as $pc)
            $categories[] = MenuCategories::find($pc->category_id);
        return view('menucategories', ['categories' => $categories, 'partner_id' => $item_id]);
    }
    
    public function getAddPartnerCategories($item_id) {
        return view('addcategory', ['partner_id' =>$item_id]);
    }
    
    public function postAddPartnerCategories($item_id, Request $request) {
        $menuCategory = new MenuCategories;
        $partnerCategory = new PartnerCategories;
        $validator = Validator::make(
            $request->all(),
            array (
                'name' => 'required|max:255'
            )
        );
        if (!$validator->fails()) {
            $menuCategory->name = $request->name;
            $menuCategory->save();
            $partnerCategory->partner_id = $item_id;
            $partnerCategory->category_id = $menuCategory->id;
            $partnerCategory->save();
            return redirect('partners/info/'.$item_id.'/menu_categories');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getEditPartnerCategories($item_id, $category_id) {
        $category = MenuCategories::find($category_id);
        return view('editcategory', ['partner_id' =>$item_id, 'category' => $category]);
    }
    
    public function postEditPartnerCategories($item_id, $category_id, Request $request) {
        $category = MenuCategories::find($category_id);
        $validator = Validator::make(
            $request->all(),
            array (
                'name' => 'required|max:255'
            )
        );
        if (!$validator->fails()) {
            $category->name = $request->name;
            $category->save();
            return redirect('partners/info/'.$item_id.'/menu_categories');
         } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }   
    }
    
    public function getDeletePartnerCategories($item_id, $category_id) {
        $partnerCategoryId = PartnerCategories::where('category_id', $category_id)->first()->id;
        PartnerCategories::destroy($partnerCategoryId);
        MenuCategories::destroy($category_id);
        return redirect('partners/info/'.$item_id.'/menu_categories');
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
    
    
}