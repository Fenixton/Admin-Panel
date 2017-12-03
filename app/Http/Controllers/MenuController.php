<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Menu as Menu;
use App\MenuCategories as MenuCategories;
use App\RestaurantManager as RestaurantManager;
use App\Restaurant as Restaurant;
use App\UserGroup as UserGroup;
use App\Toping as Toping;
use App\PartnerCategories as PartnerCategories;

class MenuController extends Controller { 

    public function get($id) {
        $menu = Menu::where('restaurant_id', $id)->get();
        $categories = MenuCategories::all();
        $restaurant = Restaurant::find($id);
        $topings = Toping::where('restaurant_id', $id)->get();
        return view('menu', ['id' => $id, 'menu' => $menu, 'restaurant' => $restaurant, 'categories' => $categories, 'allRestaurants' => $this->getAllRestaurants(), 'topings' => $topings]);
    }

    public function getAdd($id) {
        $partnerId = Restaurant::find($id)->partner_id;
        $partnercategories = PartnerCategories::where('partner_id', $partnerId)->get();
        $categories = [];
        foreach($partnercategories as $pc)
            $categories[] = MenuCategories::find($pc->category_id);
        $topings = Toping::where('restaurant_id', $id)->get();
        return view('addform', ['id' => $id, 'categories' => $categories, 'allRestaurants' => $this->getAllRestaurants(), 'topings' => $topings]);
    }

    public function postAdd($id, Request $request) {
        $item = new Menu;
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required|max:255',
                'price' => 'numeric|min:0',
                'category_id' => 'required|numeric',
                'image' => 'image'
            )
        );
        if (!$validator->fails()) {
            $item->restaurant_id = $id;
            $item->category_id = $request->category_id;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->is_available = isset($request->is_available);
            
            if ($request->image != "") {
                $image = $request->file('image');
                $imageName = time().md5($request->name).'.'.$image->getClientOriginalExtension();
                $image->move(base_path().'/images/menu', $imageName);
                $item->image_url = '/images/menu/'.$imageName;
            }
            $options = [];
            for ($i = 0; $i < 6; $i++) {
                if ($request->input('options_volume_'.$i) != "" && 
                    $request->input('options_volume_'.$i) > 0 && 
                    $request->input('options_price_'.$i) != "" && 
                    $request->input('options_price_'.$i) > 0)
                    $options[] = [
                        'volume' => $request->input('options_volume_'.$i),
                        'price' => $request->input('options_price_'.$i),
                        'is_available' => null != $request->input('options_available_'.$i)
                                 ];
            }
            $item->options = json_encode($options);
            $topings = [];
            for ($i = 0; $i < count($request->input('topings')); $i++) {
                $topings[] = intval($request->input('topings')[$i]);
            }
            $item->toppings = json_encode($topings);
            $item->save();
            return redirect('restaurant/'.$id.'/menu');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }

    public function getEdit($id, $item_id) {
        $item = Menu::find($item_id);
        $partnerId = Restaurant::find($id)->partner_id;
        $partnercategories = PartnerCategories::where('partner_id', $partnerId)->get();
        $categories = [];
        foreach($partnercategories as $pc)
            $categories[] = MenuCategories::find($pc->category_id);
        $options = json_decode($item->options, true);
        $topings = Toping::where('restaurant_id', $id)->get();
        $currtopings = json_decode($item->toppings, true);
        return view('editform', ['id' => $id, 'item' => $item, 'categories' => $categories, 'options' => $options, 'allRestaurants' => $this->getAllRestaurants(), 'topings' => $topings, 'currtopings' => $currtopings]);
    }

    public function postEdit($id, $item_id, Request $request) {
        $item = Menu::find($item_id);
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required|max:255',
                'price' => 'numeric|min:0',
                'category_id' => 'required|numeric',
                'image' => 'image'
            )
        );
        if (!$validator->fails()) {
            $item->category_id = $request->category_id;
            $item->name = $request->name;
            $item->description = $request->description;
            $item->price = $request->price;
            $item->is_available = isset($request->is_available);
            
            if ($request->image != "") {
                $image = $request->file('image');
                $imageName = time().md5($request->name).'.'.$image->getClientOriginalExtension();
                $image->move(base_path().'/images/menu', $imageName);
                $item->image_url = '/images/menu/'.$imageName;
            }
            $options = [];
            for ($i = 0; $i < 6; $i++) {
                if ($request->input('options_volume_'.$i) != "" && 
                    $request->input('options_volume_'.$i) > 0 && 
                    $request->input('options_price_'.$i) != "" && 
                    $request->input('options_price_'.$i) > 0)
                    $options[] = [
                        'volume' => $request->input('options_volume_'.$i),
                        'price' => $request->input('options_price_'.$i),
                        'is_available' => null != $request->input('options_available_'.$i)
                                 ];
            }
            $item->options = json_encode($options);
            $topings = [];
            for ($i = 0; $i < count($request->input('topings')); $i++) {
                $topings[] = intval($request->input('topings')[$i]);
            }
            $item->toppings = json_encode($topings);
            $item->save();
        }
        else {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        return redirect('restaurant/'.$id.'/menu');
    }

    public function getDelete($id, $item_id) {
        Menu::destroy($item_id);
        return redirect('restaurant/'.$id.'/menu');
    }
    
    public function getAddToping($id) {
        return view('addtoping', ['id' => $id, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function postAddToping($id, Request $request) {
        $toping = new Toping;
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required|max:255',
                'price' => 'required|numeric|min:0'
            )
        );
        if (!$validator->fails()) {
            $toping->restaurant_id = $id;
            $toping->name = $request->name;
            $toping->price = $request->price;
            $toping->is_available = isset($request->is_available);
            $toping->save();
            return redirect('restaurant/'.$id.'/menu');
        } else {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
    }
    
    public function getEditToping($id, $item_id) {
        $toping = Toping::find($item_id);
        return view('edittoping', ['id' => $id, 'toping' => $toping, 'allRestaurants' => $this->getAllRestaurants()]);
    }
    
    public function postEditToping ($id, $item_id, Request $request) {
        $toping = Toping::find($item_id);
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required|max:255',
                'price' => 'required|numeric|min:0'
            )
        );
        if (!$validator->fails()) {
            $toping->restaurant_id = $id;
            $toping->name = $request->name;
            $toping->price = $request->price;
            $toping->is_available = isset($request->is_available);
            $toping->save();
            return redirect('restaurant/'.$id.'/menu');
        } else {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
    }
    
    public function getDeleteToping($id, $item_id) {
        Toping::destroy($item_id);
        return redirect('restaurant/'.$id.'/menu');
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