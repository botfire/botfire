# Telegram Robot Library

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
```
<hr>

Set Webhook
```PHP
$result = bot::webhook()->url( $url )->set();
```

Get Webhook
```PHP
$get = bot::webhook()->getInfo();

echo $get;
```
<hr>

Send Message
```PHP
bot::id($chat_id)->message('...')->send();

// auto set chat_id
bot::this()->message('...')->send();
```


```PHP

$chat = bot::chat();
$text = bot::text();


bot::id($chat->id)->message("Receive : $text ")->send();
```
