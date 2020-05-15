<?php

namespace botfire\botfire;


class bot
{

  private static $input,$json,$token='',$get=[];

  public static $server='https://api.telegram.org/bot';

  public static $text,$caption,$data,$message_id;

  public static $chat_id,$username,$first_name,$last_name,$full_name,$user_type,$title,$isCallback=false;


  public static function token($token=false)
  {
    if ($token) {
      self::$token=$token;
    }

    return self::$token;
  }


  public static function json($input=false)
  {
    if ($input) {
      self::$json=json_decode($input);
    }

    return self::$json;
  }


  public static function input(){

    if (self::$input==null) {
      self::$input=file_get_contents ( 'php://input' );
    }

    return self::$input;
  }

  public static function getMe()
  {
    $msg = new \botfire\botfire\message;
    return $msg->setMethod('getMe')->send();
  }

  public static function getUserProfilePhotos($user_id,$offset=null,$limit=null)
  {
    $msg = new \botfire\botfire\message;

    $msg->addParam('user_id',$user_id);

    if ($offset !=null){
      $msg->addParam('offset',$offset);

    }

    if ($limit !=null){
      $msg->addParam('limit',$limit);
    }
    
    return $msg->setMethod('getUserProfilePhotos')->send();
  }

  public static function getMessage()
  {
    if (self::json()->message ?? false) {
      return self::json()->message;
    }
    else if (self::getCallback()) {
      return self::getCallback()->message ?? false;
    }
    else if (self::getChannelPost()) {
      return self::getChannelPost();
    }
  }

  public static function getChannelPost()
  {
    return self::json()->channel_post ?? false;
  }

  public static function getCallback()
  {
    return self::json()->callback_query ?? false;
  }

  public static function data()
  {
    return self::getCallback()->data ?? false;
  }

  public function text()
  {
    return self::getMessage()->text ?? false ;
  }

  public function caption()
  {
    return self::getMessage()->caption ?? false ;
  }

  public function message_id()
  {
    return self::getMessage()->message_id ?? false ;
  }

  public static function chat()
  {
    return self::getMessage()->chat ?? false;
  }

  public static function from()
  {
    return self::getMessage()->from ?? false;
  }

  public static function this()
  {
    $msg = new \botfire\botfire\message;
    $msg->id(self::chat()->id);
    return $msg;
  }

  public static function id($id)
  {
    $msg = new \botfire\botfire\message;
    $msg->id($id);
    return $msg;
  }

  public static function isGroup($only_supergroup=true)
  {
    $type = self::chat()->type;

    if ($only_supergroup && $type=='supergroup') {
      return true;
    }
    else if (! $only_supergroup && ($type=='supergroup' || $type=='group') ) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function isUser()
  {
    if ( self::chat()->type == 'private' ) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function isChannel()
  {
    if ( self::chat()->type == 'channel' ) {
      return true;
    }
    else {
      return false;
    }
  }

  public static function keyboard()
  {
    return new \botfire\botfire\keyboard;
  }

  public static function message()
  {
    return new \botfire\botfire\message;
  }

  public static function webhook()
  {
    return new \botfire\botfire\webhook;
  }

  public static function loadFile($path)
  {
    return curl_file_create($path);
  }

  public static function autoInput()
  {
    self::json(self::input());

    if (self::getMessage()) {
      self::$isCallback=false;
    }
    else if(self::getCallback()) {
      self::$isCallback=true;
    }

  }

}
