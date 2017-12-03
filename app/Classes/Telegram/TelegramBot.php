<?php

namespace App\Classes\Telegram;

class TelegramBot { 
    
    private $_access_token;

    public function  __construct($access_token = "") {
        $this->_access_token = $access_token;
    }

    public function sendMessage($chatId, $message) {
        $ch = curl_init('https://api.telegram.org/bot'.$this->_access_token.'/sendMessage?chat_id='.$chatId.'&text='.$message.'&parse_mode=HTML');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $body = curl_exec($ch);
        curl_close($ch);
    }
}