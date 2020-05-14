<?php

namespace botfire\botfire;

use botfire\botfire\bot;

class api
{

  public static function send($method,$params=[])
  {
    return api::post(bot::$server.bot::token()."/$method",$params);
  }

  /**
  *
  * @param string $url
  * @param array $params
  * @return string request text
  */
  public static function post($url,$params=[]){

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST,1);
    // curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false); // required as of PHP 5.6.0
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result=curl_exec($ch);
    curl_close($ch);
    return $result;

  }
}
