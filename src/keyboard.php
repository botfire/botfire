<?php
namespace botfire\botfire;


class keyboard
{

  private $params=[];
  private $btns=[],$type='inline_keyboard',$resize_keyboard,$one_time_keyboard;

  public function inline()
  {
    $this->type='inline_keyboard';
    return $this;
  }

  public function markup($resize_keyboard=false,$one_time_keyboard=false,$selective=null)
  {
    $this->type='keyboard';
    $this->resize_keyboard=$resize_keyboard;
    $this->one_time_keyboard=$one_time_keyboard;
    $this->selective=$selective;

    return $this;
  }



  public function row($func=null)
  {
    if ($func!=null) {
      $func($this);
    }

    $this->params[]=$this->btns;
    $this->btns=[];

    return $this;
  }

  public function btnUrl($name,$url)
  {
    $this->btns[]=['text'=>$name,'url'=>$url];
    return $this;
  }

  public function btn($name,$callback_data=null)
  {
    if ($callback_data!=null) {
      $this->btns[]=['text'=>$name,'callback_data'=>$callback_data];
    }
    else {
      $this->btns[]=['text'=>$name];
    }

    return $this;
  }

  public function contact($name)
  {
    $this->btns[]=['text'=>$name,'request_contact'=>true];
    return $this;
  }

  public function location($name)
  {
    $this->btns[]=['text'=>$name,'request_location'=>true];
    return $this;
  }

  public function get()
  {
    if ($this->getType()=='inline_keyboard') {
      $params=[
        $this->getType()=>$this->params
      ];
    }
    else {
      $params=[
        $this->getType()=>$this->params,
        'resize_keyboard'=>$this->resize_keyboard,
        'one_time_keyboard'=>$this->one_time_keyboard
      ];
      if ($this->selective!=null) {
        $params['selective']=$this->selective;
      }
    }

    return $params;
  }

  public function getType()
  {
    return $this->type;
  }


}
