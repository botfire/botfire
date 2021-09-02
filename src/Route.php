<?php
namespace botfire\botfire;

use botfire\botfire\bot;
use webrium\core\Route as IRoute;

class Route {

  public static function text($path, $controllerString){
    if (!bot::getCallback() && $path == bot::text()) {
      IRoute::call($controllerString);
    }
  }


  public static function call($path, $controllerString){
    $data = self::findVar(bot::data(),$path);

    if (bot::getCallback() && $data['is']) {
      IRoute::call($controllerString);
    }
  }

  public static function findVar($string,$path){
    $arr    = explode('/',$string);
    $parr   = explode('/',$path);
    $params = [];

    foreach ($parr as $key => $str) {

      if (strpos($str,'{')===0) {
        $newStr = str_replace('{','',$str);
        $newStr = str_replace('}','',$newStr);

        if (isset($arr[$key])) {
          $params[$newStr] = $arr[$key];

          $path = str_replace('{'.$newStr.'}',$arr[$key],$path);
        }

      }
    }
    $is = false;
    if ($string===$path) {
      $is = true;
    }

    bot::$params = $params;

    return ['params'=>$params,'is'=>$is];
  }

}
