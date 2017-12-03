<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Classes\Telegram\TelegramBot as TelegramBot;

class TelegramController extends Controller { 

    public function sendMessage($token) {
        $restaurant = Restaurant::where('telegram_token', $token)->first();

        if($restaurant == null || $restaurant->telegram_chat_id == "") {
            return response()->json(['success' => false]);
        }

        $bot = new TelegramBot(env('TELEGRAM_TOKEN'));
        $bot->sendMessage($restaurant->telegram_chat_id, 'Тестовое сообщение.');

        return response()->json(['success' => true]);
    }

    public function unbind($token) {
        $restaurant = Restaurant::where('telegram_token', $token)->first();

        if($restaurant == null || $restaurant->telegram_chat_id == "") {
            return response()->json(['success' => false]);
        }

        $restaurant->telegram_chat_id = "";
        $restaurant->save();
        
        return response()->json(['success' => true]);
    }
}