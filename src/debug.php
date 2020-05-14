<?php

namespace botfire\botfire;

use botfire\botfire\bot;

class debug
{
  public static $ids=[];

  public static function setIds($array)
  {
    self::$ids=$array;
  }

  public static function run($func)
  {
    try
    {
      $func();
    }
    catch (\Throwable $e)
    {
      self::make_text($e);
    }
    catch (\Exception $e)
    {
      self::make_text($e);
    }
  }

  public static function make_text($e)
  {
    self::send(
      "🛑 Error 🛑  \n\n".
      $e->getMessage().
      "\n\n File : ".$e->getFile().
      "\n\n line : ".$e->getLine()
    );
  }

  public static function send($text)
  {
    foreach (self::$ids as $key => $id) {
      bot::id($id)->message($text)->send();
    }
  }
}
