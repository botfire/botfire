<?php
namespace botfire\botfire;

class restrictChatMember
{

  function __construct($msg){
    $this->msg=$msg;
  }

  public $msg;

  public $params=[
    'can_send_messages'=>true,
    'can_send_media_messages'=>true,
    'can_send_polls'=>true,
    'can_send_other_messages'=>true,
    'can_add_web_page_previews'=>true,
    'can_change_info'=>false,
    'can_invite_users'=>false,
    'can_pin_messages'=>false,
  ];

  public function can_send_messages($value)
  {
    $this->params['can_send_messages']=$value;
    return $this;
  }

  public function can_send_media_messages($value)
  {
    $this->params['can_send_media_messages']=$value;
    return $this;
  }

  public function can_send_polls($value)
  {
    $this->params['can_send_polls']=$value;
    return $this;
  }

  public function can_send_other_messages($value)
  {
    $this->params['can_send_other_messages']=$value;
    return $this;
  }

  public function can_add_web_page_previews($value)
  {
    $this->params['can_add_web_page_previews']=$value;
    return $this;
  }

  public function can_change_info($value)
  {
    $this->params['can_change_info']=$value;
    return $this;
  }

  public function can_invite_users($value)
  {
    $this->params['can_invite_users']=$value;
    return $this;
  }

  public function can_pin_messages($value)
  {
    $this->params['can_invite_users']=$value;
    return $this;
  }

  public function send()
  {
    $this->msg->params['permissions']=$this->params;
    return $this->msg->send();
  }

  public function sendAndGetJson()
  {
    return json_decode($this->send()) ;
  }

}
