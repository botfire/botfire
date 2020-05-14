<?php

namespace botfire\botfire;

use botfire\botfire\api;


class webhook
{
  private  $url,$params=[];

  public function set()
  {
    return api::send('setWebhook',$this->params);
  }

  public  function getInfo()
  {
    return api::send('getWebhookInfo');
  }


  public function url($url)
  {
    $this->params['url']=$url;
    return $this;
  }

  public function certificate($file)
  {
    $this->params['certificate']=$file;
    return $this;
  }

  public function max_connections($value=40)
  {
    $this->params['max_connections']=$value;
    return $this;
  }

  public function allowed_updates($array)
  {
    $this->params['allowed_updates']=$array;
    return $this;
  }

}
