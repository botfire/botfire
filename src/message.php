<?php

namespace botfire\botfire;

use botfire\botfire\api;
use botfire\botfire\bot;
use botfire\botfire\restrictChatMember;

class message
{

  public $chat_id,$method,$params=[];

  public function addParam($name,$value)
  {
    $this->params[$name]=$value;
    return $this;
  }

  public function setMethod($name)
  {
    $this->method=$name;
    return $this;
  }

  public function id($id)
  {
    $this->chat_id=$id;
    $this->params['chat_id']=$id;
    return $this;
  }

  public function text($text=false)
  {
    if ($text) {
      $this->params['text']=$text;
      return $this;
    }
    else {
      return bot::text();
    }
  }


  public function message($text)
  {
    $this->text($text);
    $this->method='sendMessage';
    return $this;
  }

  public function photo($file=false)
  {
    return self::set_file('sendPhoto','photo',$file);
  }

  public function audio($file=false)
  {
    return self::set_file('sendAudio','audio',$file);
  }

  public function voice($file=false)
  {
    return self::set_file('sendVoice','voice',$file);
  }

  public function video($file=false)
  {
    return self::set_file('sendVideo','video',$file);
  }

  public function videoNote($file=false)
  {
    return self::set_file('sendVideoNote','video_note',$file);
  }

  public function animation($file=false)
  {
    return self::set_file('sendAnimation','animation',$file);
  }

  public function document($file=false)
  {
    return self::set_file('sendDocument','document',$file);
  }

  public function sticker($file=false)
  {
    return self::set_file('sendSticker','sticker',$file);
  }

  public function mediaGroup()
  {
    $this->method='sendMediaGroup';
    $class=new \botfire\botfire\mediaGroup($this);
    return $class;
  }

  private function set_file($method,$name,$value)
  {
    if ($value) {
      $this->method=$method;
      $this->params[$name]=$value;

      return $this;
    }
    else {
      return bot::getMessage()->$name ?? false;
    }
  }

  public function editReplyMarkup()
  {
    $this->message_id(bot::message_id());
    $this->method='editMessageReplyMarkup';

    return $this;
  }

  public function editMessage($text)
  {
    $this->params['text']=$text;
    $this->message_id(bot::message_id());
    $this->method='editMessageText';

    return $this;
  }

  public function editCaption($caption)
  {
    $this->params['caption']=$caption;
    $this->message_id(bot::message_id());
    $this->method='editMessageCaption';
    return $this;
  }

  public function deleteMessage(){
    $this->message_id(bot::message_id());
    $this->method='deleteMessage';
    return $this;
  }

  public function caption($text)
  {
    $this->params['caption']=$text;
    return $this;
  }


  public function message_id($message_id)
  {
    $this->params['message_id']=$message_id;
    return $this;
  }

  public function inline_message_id($inline_message_id)
  {
    $this->params['inline_message_id']=$inline_message_id;
    return $this;
  }

  public function callback_query_id($callback_query_id)
  {
    $this->params['callback_query_id']=$callback_query_id;
    return $this;
  }

  public function answerCallback($show_alert=false)
  {
    $this->callback_query_id(bot::getCallback()->id);
    $this->params['show_alert']=$show_alert;
    $this->method='answerCallbackQuery';
    return $this;
  }


  public function contact($phone_number=false,$first_name=false,$last_name=false)
  {

    if ( ! $phone_number && ! $first_name) {
      return bot::getMessage()->contact ?? false;
    }
    else {

      $this->params['phone_number']=$phone_number;
      $this->params['first_name']=$first_name;

      if ( $last_name != false ) {
        $this->params['last_name']=$last_name;
      }

      $this->method='sendContact';
      return $this;
    }
  }

  /**
  * Use this method to kick a user from a group
  *
  * @param $user_id [Integer] Unique identifier of the target user
  * @param $until_date [Integer] Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever
  */
  public function kickChatMember($user_id,$until_date=null)
  {
    $this->params['user_id']=$user_id;

    if ($until_date!=null) {
      $this->params['until_date']=$until_date;
    }
    $this->method='kickChatMember';

    return $this;
  }


  /**
  * Use this method to unban a previously kicked user in a supergroup or channel.
  *
  * @param $user_id [Integer]
  */
  public function unbanChatMember($user_id)
  {
    $this->params['user_id']=$user_id;
    $this->method='unbanChatMember';

    return $this->send();
  }

  public function restrictChatMember($user_id,$until_date=null)
  {
    $this->params['user_id']=$user_id;

    if ($until_date!=null) {
      $this->params['until_date']=$until_date;
    }

    $this->method='restrictChatMember';

    return new restrictChatMember($this);
  }


  public function promoteChatMember($user_id,$can_change_info,$can_post_messages,$can_edit_messages,$can_delete_messages,$can_invite_users,$can_restrict_members,$can_pin_messages,$can_promote_members)
  {

    $this->params['user_id']=$user_id;

    $this->params['can_change_info']=$can_change_info;

    $this->params['can_post_messages']=$can_post_messages;

    $this->params['can_edit_messages']=$can_edit_messages;

    $this->params['can_delete_messages']=$can_delete_messages;

    $this->params['can_invite_users']=$can_invite_users;

    $this->params['can_restrict_members']=$can_restrict_members;

    $this->params['can_pin_messages']=$can_pin_messages;

    $this->params['can_promote_members']=$can_promote_members;

    $this->method='promoteChatMember';

    return $this->send();
  }



  /**
  * Use this method when you need to tell the user that something is happening on the bot's side
  * @param $action String ['typing','upload_photo','record_video','upload_video','record_audio','upload_audio','upload_document','find_location','record_video_note','upload_video_note']
  */
  public function chatAction($action)
  {
    $this->params['action']=$action;
    $this->method='sendChatAction';

    return $this;
  }



  /**
  * Use this method to send point on the map. On success, the sent Message is returned.
  * @param  [Float number] $latitude  Latitude of the location
  * @param  [Float number] $longitude Longitude of the location
  */
  public function location($latitude,$longitude)
  {
    $this->params['latitude']=$latitude;
    $this->params['longitude']=$longitude;

    $this->method='sendLocation';

    return $this;
  }

  public function editMessageLiveLocation($latitude,$longitude)
  {
    $this->params['latitude']=$latitude;
    $this->params['longitude']=$longitude;

    $this->method='editMessageLiveLocation';

    return $this;
  }

  public function stopMessageLiveLocation()
  {
    $this->method='stopMessageLiveLocation';
    return $this;
  }

  public function venue()
  {
    $this->method='sendVenue';
    return $this;
  }

  /**
  * Send Markdown or HTML
  */
  public function parse_mode($mode='HTML')
  {
    $this->params['parse_mode']=$mode;

    return $this;
  }

  public function vcard($vcard)
  {
    $this->params['vcard']=$vcard;

    return $this;
  }


  /**
  * Send Markdown or HTML
  */
  public function disable_web_page_preview($disable=true)
  {
    $this->params['disable_web_page_preview']=$disable;
    return $this;
  }

  /**
  * Disables link previews for links in this message
  */
  public function disable_notification($active=true)
  {
    $this->params['disable_notification']=$active;
    return $this;
  }

  /**
  * Period in seconds for which the location will be updated (see Live Locations, should be between 60 and 86400.
  * @param  [Integer] $live_period
  */
  public function live_period($live_period)
  {
    $this->params['live_period']=$live_period;
    return $this;
  }

  /**
  * If the message is a reply, ID of the original message
  * @param $message_id Integer
  **/
  public function reply_to($message_id)
  {
    $this->params['reply_to_message_id']=$message_id;
    return $this;
  }

  public function duration($duration)
  {
    $this->params['duration']=$duration;
    return $this;
  }

  public function performer($performer)
  {
    $this->params['performer']=$performer;
    return $this;
  }

  public function title($title)
  {
    $this->params['title']=$title;
    return $this;
  }

  public function width($width)
  {
    $this->params['width']=$width;
    return $this;
  }

  public function height($height)
  {
    $this->params['height']=$width;
    return $this;
  }

  public function supports_streaming($supports_streaming)
  {
    $this->params['supports_streaming']=$supports_streaming;
    return $this;
  }

  public function thumb($thumb)
  {
    $this->params['thumb']=$thumb;
    return $this;
  }

  public function length($length)
  {
    $this->params['length']=$length;
    return $this;
  }

  public function latitude($latitude)
  {
    $this->params['latitude']=$latitude;
    return $this;
  }

  public function longitude($longitude)
  {
    $this->params['longitude']=$longitude;
    return $this;
  }

  public function foursquare_id($foursquare_id)
  {
    $this->params['foursquare_id']=$foursquare_id;
    return $this;
  }

  public function foursquare_type($foursquare_type)
  {
    $this->params['foursquare_type']=$foursquare_type;
    return $this;
  }

  public function getFile($file_id)
  {
    $this->params['file_id']=$file_id;
    $this->method='getFile';

    return $this->send();
  }

  public function downloadFile($file_id,$save_path=false,$name=false)
  {
    set_time_limit(0);
    $token=bot::token();
    bot::this()->message("https://api.telegram.org/file/bot$token/$file_id")->send();

    $file = file_get_contents("https://api.telegram.org/file/bot$token/$file_id");
    file_put_contents($name, $file);
    return "$save_path/$name";
  }

  public function download($file_id,$save_path)
  {
    $file = bot::this()->getFile($file_id);
    $file=json_decode($file);

    if($file->ok){

      $file_id=$file->result->file_id;
      $name=\basename($file->result->file_path);

      bot::this()->downloadFile($file_id,$save_path,$name);
    }

    return $file;
  }


  /**
  * Additional interface options. A JSON-serialized
  * object for an inline keyboard,custom reply keyboard,
  * instructions to remove reply keyboard or to force a reply from the user.
  */
  public function reply_markup($ob)
  {
    $this->params['reply_markup']=$ob;
    return $this;
  }



  public function keyboard($k)
  {
    $this->params['reply_markup']=json_encode($k->get());
    return $this;
  }

  public function removeKeyboard($selective=null)
  {
    $arr=['remove_keyboard'=>true];
    if($selective!=null){$arr['selective']=$selective;}
    $this->params['reply_markup']=json_encode($arr);
    return $this;
  }


  public function getChat()
  {
    return $this->setMethod('getChat')->send();
  }

  public function getChatAdministrators()
  {
    return $this->setMethod('getChatAdministrators')->send();
  }

  public static function getChatMembersCount()
  {
    return $this->setMethod('getChatMembersCount')->send();
  }

  public static function getChatMember($user_id)
  {
    $this->params['user_id']=$user_id;
    return $this->setMethod('getChatMember')->send();
  }


  public function send()
  {
    if (isset($this->params['permissions'])) {
      $this->params['permissions']=json_encode($this->params['permissions']);
    }

    return api::send($this->method,$this->params);
  }

}
