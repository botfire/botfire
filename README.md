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

<hr>

## Edit

Edit Message
```PHP
bot::id($chat->id)->editMessage('new text')->message_id($msg_id)->send();
```


Edit Caption
```
bot::id($chat->id)->editCaption('caption text')->message_id($msg_id)->send();
```

Edit Reply Markup
```
$k = bot::keyboard();
$k->btn('hello inline button','callback data')->row();

bot::id($chat->id)->editMessage('new text')->keyboard( $k )->send();
```

Delete Message
```
bot::id($chat->id)->deleteMessage()->message_id($msg_id)->send();
```
