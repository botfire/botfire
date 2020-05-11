<?php

namespace parsgit\botpackage;


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
    $msg = new \parsgit\botpackage\message;
    return $msg->setMethod('getMe')->send();
  }

  public static function getMessage()
  {
    if (self::$isCallback || self::getCallback()) {
      return self::json()->callback_query->message ?? false;
    }
    else {
      return self::json()->message ?? false;
    }
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
    $msg = new \parsgit\botpackage\message;
    $msg->id(self::chat()->id);
    return $msg;
  }

  public static function id($id)
  {
    $msg = new \parsgit\botpackage\message;
    $msg->id($id);
    return $msg;
  }

  public static function keyboard()
  {
    return new \parsgit\botpackage\keyboard;
  }

  public static function message()
  {
    return new \parsgit\botpackage\message;
  }

  public static function webhook()
  {
    return new \parsgit\botpackage\webhook;
  }

  public static function loadFile($path)
  {
    return curl_file_create($path);
  }

  //
  public static function autoInput()
  {
    self::json(self::input());

    if (self::getMessage()) {
      self::$isCallback=false;
    }
    else if(self::getCallback()) {
      self::$isCallback=true;
    }

    // if (self::getMessage()) {
    //
    //   self::$isCallback=false;
    //
    //   self::$text       = self::getMessage()->text ?? false;
    //   self::$caption    = self::getMessage()->caption ?? false;
    //   self::$message_id = self::getMessage()->message_id ?? false;
    //
    //   // if (isset(self::getMessage()->chat)) {
    //   //
    //   // }
    //
    // }
  }

  // //
  // public static function initClientInfo()
  // {
  //   if (isset(self::$json->message)) {
  //
  //     self::$isCallback=false;
  //
  //     $message=self::$json->message;
  //
  //     self::$get['text']=self::checkIsset('text',$message);
  //     self::$get['caption']=self::checkIsset('caption',$message);
  //     self::$get['message_id']=$message->message_id;
  //
  //     if (isset($message->chat)) {
  //       $chat=$message->chat;
  //       self::initChatUserInfo($chat);
  //     }
  //
  //     if ($message->from) {
  //       self::$get['user']=$message->from;
  //     }
  //   }
  //   else if( isset(self::$json->callback_query) ) {
  //     self::$isCallback=true;
  //     $query=self::$json->callback_query;
  //
  //     self::$get['text']=self::checkIsset('text',$query->message);
  //     self::$get['caption']=self::checkIsset('caption',$query->message);
  //     self::$get['data']=$query->data;
  //     self::$get['callback_id']=$query->id;
  //     self::$get['message_id']=$query->message->message_id;
  //
  //     if (isset($query->message->chat)) {
  //       $chat=$query->message->chat;
  //       self::initChatUserInfo($chat);
  //     }
  //     if ($query->from) {
  //       self::$get['user']=$query->from;
  //     }
  //   }
  // }
  //
  // private static function initChatUserInfo($ob)
  // {
  //   self::$chat_id=self::checkIsset('id',$ob);
  //
  //   self::$username=self::checkIsset('username',$ob);
  //   self::$user_type=self::checkIsset('type',$ob);
  //   self::$first_name=self::checkIsset('first_name',$ob);
  //   self::$last_name=self::checkIsset('last_name',$ob);
  //   self::$full_name=self::$first_name.' '.self::$last_name;
  //
  //   self::$title=self::checkIsset('title',$ob);
  //
  // }
  //
  // public static function getMessageType(){
  //   if (isset(self::$json->message->text)) {
  //     return ['type'=>'text','data'=>self::$json->message->text];
  //   }
  //   elseif (isset(self::$json->message->photo)) {
  //     return ['type'=>'photo','data'=>self::$json->message->photo];
  //   }
  //   elseif (isset(self::$json->message->video)) {
  //     return ['type'=>'video','data'=>self::$json->message->video];
  //   }
  //   elseif (isset(self::$json->message->video_note)) {
  //     return ['type'=>'video_note','data'=>self::$json->message->video_note];
  //   }
  //   elseif (isset(self::$json->message->voice)) {
  //     return ['type'=>'voice','data'=>self::$json->message->voice];
  //   }
  //   elseif (isset(self::$json->message->audio)) {
  //     return ['type'=>'audio','data'=>self::$json->message->audio];
  //   }
  //   elseif (isset(self::$json->message->animation)) {
  //     return ['type'=>'animation','data'=>self::$json->message->animation];
  //   }
  //   elseif (isset(self::$json->message->document)) {
  //     return ['type'=>'document','data'=>self::$json->message->document];
  //   }
  //   elseif (isset(self::$json->message->contact)) {
  //     return ['type'=>'contact','data'=>self::$json->message->contact];
  //   }
  //   elseif (isset(self::$json->message->location)) {
  //     return ['type'=>'location','data'=>self::$json->message->location];
  //   }
  //   else {
  //     return ['type'=>false,'data'=>self::$json];
  //   }
  // }

}
