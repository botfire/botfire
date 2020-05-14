<?php
namespace botfire\botfire;

class mediaGroup
{
  public $arr=[];
  public $sendOB;

  function __construct($sendOB)
  {
    $this->sendOB=$sendOB;
  }

  public function photo($input,$caption='')
  {
    $this->arr[]=[
      'type'=>'photo',
      'media'=>$input,
      'caption'=>$caption,
    ];
    return $this;
  }

  public function video($input,$caption='')
  {
    $this->arr[]=[
      'type'=>'video',
      'media'=>$input,
      'caption'=>$caption,
    ];
    return $this;
  }

  public function animation($input,$caption='')
  {
    $this->arr[]=[
      'type'=>'animation',
      'media'=>$input,
      'caption'=>$caption,
    ];
    return $this;
  }

  public function audio($input,$caption='')
  {
    $this->arr[]=[
      'type'=>'audio',
      'media'=>$input,
      'caption'=>$caption,
    ];
    return $this;
  }


  public function document($input,$caption='')
  {
    $this->arr[]=[
      'type'=>'document',
      'media'=>$input,
      'caption'=>$caption,
    ];
    return $this;
  }


  public function caption($caption)
  {
    return $this->addProp('caption',$caption);
  }

  public function parse_mode($value)
  {
    return $this->addProp('parse_mode',$value);
  }

  public function width($value)
  {
    return $this->addProp('width',$value);
  }

  public function height($value)
  {
    return $this->addProp('height',$value);
  }

  public function duration($value)
  {
    return $this->addProp('duration',$value);
  }

  public function supports_streaming($value)
  {
    return $this->addProp('supports_streaming',$value);
  }

  public function performer($value)
  {
    return $this->addProp('performer',$value);
  }
  public function title($value)
  {
    return $this->addProp('title',$value);
  }

  public function thumb($value)
  {
    return $this->addProp('thumb',$value);
  }



  public function addProp($name,$value)
  {
    $params=end($this->arr);
    $params[$name]=$value;
    $this->arr[count($this->arr)-1]= $params ;
    return $this;
  }

  public function send()
  {
    $this->sendOB->params['media']=json_encode($this->arr);
    return $this->sendOB->send();
  }

  public function sendAndGetJson()
  {
    return json_decode($this->send()) ;
  }

}
