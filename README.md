# Telegram Robot Library

Install

```
composer require botfire/botfire
```

use
```php
use botfire\botfire\bot;
```

Set Token
```php
bot::token('your-bot-token');
```

Set Webhook
```php
$result = bot::webhook()->url( $url )->set();
```

Send Message
```php
bot::id($chat_id)->message('...')->send();

// auto set chat_id
bot::this()->message('...')->send();
```

