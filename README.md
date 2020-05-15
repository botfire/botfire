# Telegram Robot Library   ![PHP Composer](https://github.com/botfire/botfire/workflows/PHP%20Composer/badge.svg?branch=master)

Install

```
composer require botfire/botfire
```

use
```PHP
use botfire\botfire\bot;
```

Set Token
```PHP
bot::token('your-bot-token');
bot::autoInput();
```
<br>

## Webhook

Set Webhook
```PHP
$result = bot::webhook()->url( $url )->set();
```


Get Webhook
```PHP
$get = bot::webhook()->getInfo();

echo $get;
```
<br>


## Message

Send Message
```PHP
bot::id($chat_id)->message('...')->send();

// auto set chat_id
bot::this()->message('...')->send();
```

Send Photo
```PHP
bot::id($chat->id)->photo($file_id)->send();
```

Send Audio
```PHP
bot::id($chat->id)->audio($file_id)->send();
```


Send Voice
```PHP
bot::id($chat->id)->voice($file_id)->send();
```

Send Video Note
```PHP
bot::id($chat->id)->videoNote($file_id)->send();
```


Send Video
```PHP
bot::id($chat->id)->video($file_id)->send();
```

Send Animation
```PHP
bot::id($chat->id)->animation($file_id)->send();
```

Send Document
```PHP
bot::id($chat->id)->document($file_id)->send();
```

<br>

## Edit

Edit message
```PHP
bot::id($chat->id)->editMessage('new text')->message_id($msg_id)->send();
```


Edit caption
```
bot::id($chat->id)->editCaption('caption text')->message_id($msg_id)->send();
```

Edit reply markup
```
$k = bot::keyboard();
$k->btn('hello inline button','callback data')->row();

bot::id($chat->id)->editMessage('new text')->keyboard( $k )->send();
```

Delete message
```
bot::id($chat->id)->deleteMessage()->message_id($msg_id)->send();
```

<br>

## Receive user messages via webhook

Get message text
```php
$text = bot::text();
```

get message caption
```php
$caption = bot::caption();
```

Get callback data
```
$data = bot::data();
```

Get message id
```
$msg_id = bot::message_id();
```

Get all message Object
```php
$msg = bot::getMessage();
```

Get All receive Object
```php
$get = bot::json(); // object

$get = bot::input(); // text
```

<br>

## User Type

```
if( bot::isUser() ){
  // Receive private messages
}
else if( bot::isGroup() ){
  // Receive from super group
}
else if( ! bot::isGroup() && bot::isGroup(true)  ){
  // Receive from normal group
}
else if( bot::isChannel() ){
  // Receive channel post
}
```

<br>

## Request Type

```
if( bot::getCallback() ){
  // When I click on the inline button
  
  $data = bot::data();
  
  //...
}
else {
  // When I send normal text
  // ...
}

```

<br>


## Sender

Get chat info
```php
$chat = bot::chat();
```

Get From
```php
$from = bot::from();
```

<br>

## Keyboard

inline keyboard

```
$k = bot::keyboard();

$k
->btn('btn name 1','data callback 1')
->btn('btn name 2','data callback 2')
->row()
->btnUrl('btn name 3','https://github.com')
->row();

bot::id(bot::chat()->id)->message('...')->keyboard($k)->send();
```

markup keyboard
``
markup($resize_keyboard,$one_time_keyboard,$selective)
``
example
```
$k = bot::keyboard();

$k->markup(true)->btn('button name')->row();

bot::id(bot::chat()->id)->message('...')->keyboard($k)->send();

```

<br>

## Bot Info
```
$info = bot::getMe();

bot::id($chat_id)->message($info)->send();
```

<br>


## User Profile
``
method : getUserProfilePhotos($user_id,$offset=null,$limit=null)
``
sample
```
$profile = bot::getUserProfilePhotos(bot::chat()->id);
```
