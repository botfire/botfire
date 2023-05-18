<?php
namespace botfire\botfire;

use botfire\botfire\bot;
use Webrium\Route as IRoute;

class Route {

  public static $find = false;

  public static function text($path, $controllerString){
    if (!bot::getCallback() && $path == bot::text()) {
      self::$find = true;
      self::run($controllerString);
    }
  }


  public static function call($path, $controllerString){
    $data = self::findVar(bot::data(),$path);

    if (bot::getCallback() && $data['is']) {
      self::$find = true;
      self::run($controllerString);
    }
  }


  public static function run($controllerString){
    IRoute::call($controllerString);
    die();
  }

  public static function notFound($file=false)
  {
    if (!self::$find) {

      if ( $file) {
        self::run($file);
      }

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
