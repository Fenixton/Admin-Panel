<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Manager as Manager;
use App\Restaurant as Restaurant;
use App\RestaurantManager as RestaurantManager;
use App\UserGroup as UserGroup;

class ManagerController extends Controller {
    public function getManagers() {
        $managers = Manager::all();
        return view('managers', ['managers' => $managers]);
    }
    
    public function getAddManager() {
        return view('addmanager');
    }
    
    public function postAddManager(Request $request) {
        $manager = new Manager;
        $validator = Validator::make(
            $request->all(),
            array (
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|max:255'
            )
        );
        if (!$validator->fails()) {
            $manager->name = $request->name;
            $manager->email = $request->email;
            $manager->password = bcrypt($request->password);
            $manager->user_group = 0;
            $manager->save();
            return redirect('managers');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getEditManager($item_id) {
        $manager = Manager::find($item_id);
        return view('editmanager', ['manager' => $manager]);
    }
    
    public function postEditManager($item_id, Request $request) {
        $manager = Manager::find($item_id);
        $validator = Validator::make(
            $request->all(),
            array (
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|max:255'
            )
        );
        if (!$validator->fails()) {
            $manager->name = $request->name;
            $manager->email = $request->email;
            $manager->password = bcrypt($request->password);
            $manager->user_group = 0;
            $manager->save();
            return redirect('managers');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator->errors());
        }
    }
    
    public function getDeleteManager($item_id) {
        Manager::destroy($item_id);
        return redirect('managers');
    }
}