<?php
namespace Botfire;

class TelegramApi {
    public static function request($token, $method, $params = []) {
        $url = "https://api.telegram.org/bot$token/$method";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public static function requestFile($token, $file_path) {
        return file_get_contents("https://api.telegram.org/file/bot$token/$file_path");
    }
}