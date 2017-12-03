<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Restaurant as Restaurant;
use App\RestaurantManager as RestaurantManager;
use App\Schedule as Schedule;
use App\Calendar as Calendar;
use App\UserGroup as UserGroup;

class ScheduleController extends Controller { 

    public function get($id) {
        $schedule = Schedule::where('restaurant_id', $id)->orderby('weekday','asc')->get();
        $weekdays = [
            1 => ['name' => "Понедельник"],
            2 => ['name' => "Вторник"],
            3 => ['name' => "Среда"],
            4 => ['name' => "Четверг"],
            5 => ['name' => "Пятница"],
            6 => ['name' => "Суббота"],
            0 => ['name' => "Воскресенье"]
        ];
        foreach($schedule as $item) {
            $weekdays[$item->weekday]['fromTime'] = $item->fromTime;
            $weekdays[$item->weekday]['tillTime'] = $item->tillTime;
        }

        $calendar = Calendar::where('restaurant_id', $id)->orderby('month','asc')->orderby('day','asc')->get();
        $months = array(
            1 => "Январь",
            2 => "Февраль",
            3 => "Март",
            4 => "Апрель",
            5 => "Май",
            6 => "Июнь",
            7 => "Июль",
            8 => "Август",
            9 => "Сентябрь",
            10 => "Октябрь",
            11 => "Ноябрь",
            12 => "Декабрь"
        );
        $restaurant = Restaurant::find($id);
        return view('schedule', ['id' => $id, 'restaurant' => $restaurant, 'weekdays' => $weekdays, 'allRestaurants' => $this->getAllRestaurants(), 'months' => $months, 'calendar' => $calendar]);
    }

    public function getEdit($id, $weekday_id) {
        //$weekday = Schedule::where('restaurant_id', $id)->where('weekday', $weekday_id)->firstOrCreate();
        $weekday = Schedule::firstOrCreate(array('restaurant_id' => $id,'weekday' => $weekday_id));
        return view('editschedule', ['id' => $id, 'weekday' => $weekday, 'allRestaurants' => $this->getAllRestaurants()]);
    }

    public function postEdit($id, $weekday_id, Request $request) {
        $weekday = Schedule::firstOrCreate(array('restaurant_id' => $id,'weekday' => $weekday_id));
        $validator = Validator::make(
            $request->all(),
            array(
                'fromTimeH' => 'required|numeric|min:0|max:23',
                'fromTimeM' => 'required|numeric|min:0|max:59',
                'tillTimeH' => 'required|numeric|min:0|max:47',
                'tillTimeM' => 'required|numeric|min:0|max:59'
            )
        );
        if (!$validator->fails()) {
            $weekday->restaurant_id = $id;
            $weekday->weekday = $weekday_id;
            $weekday->fromTime = ($request->fromTimeH * 60) + $request->fromTimeM;
            $weekday->tillTime = ($request->tillTimeH * 60) + $request->tillTimeM;
            if ($weekday->tillTime <= $weekday->fromTime)
                $weekday->tillTime = $weekday->tillTime + 1440;
            $weekday->save();
        } else {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        return redirect('restaurant/'.$id.'/schedule');
    }
    
    public function getDelete($id, $weekday_id) {
        $day = Schedule::where('restaurant_id', $id)->where('weekday', $weekday_id);
        $day->delete();
        return redirect('restaurant/'.$id.'/schedule');
    }

    public function getAddHoliday($id) {
        return view('addholiday', ['id' => $id, 'allRestaurants' => $this->getAllRestaurants()]);
    }

    public function postAddHoliday($id, Request $request) {
        $holiday = new Calendar;
        $validator = Validator::make(
            $request->all(),
            array(
                'month' => 'required',
                'day' => 'required|numeric|min:1|max:31',
                'comment' => 'max:255',
                'fromTimeH' => 'required|numeric|min:0|max:23',
                'fromTimeM' => 'required|numeric|min:0|max:59',
                'tillTimeH' => 'required|numeric|min:0|max:47',
                'tillTimeM' => 'required|numeric|min:0|max:59'
            )
        );
        if (!$validator->fails()) {
            $holiday->restaurant_id = $id;
            $holiday->month = $request->month;
            $holiday->day = $request->day;
            $holiday->comment = $request->comment;
            $holiday->fromTime = ($request->fromTimeH * 60) + $request->fromTimeM;
            $holiday->tillTime = ($request->tillTimeH * 60) + $request->tillTimeM;
            $holiday->week = -1;
            $holiday->week_of_month = -1;
            $holiday->day_of_week = -1;
            $holiday->save();
        } else {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        return redirect('restaurant/'.$id.'/schedule');
        
    }
    
    public function getDeleteHoliday($id, $day_id) {
        Calendar::destroy($day_id);
        return redirect('restaurant/'.$id.'/schedule');
    }

    public function getCalendar($id) {
        
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