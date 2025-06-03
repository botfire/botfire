# Botfire Library Documentation

<br>

### ⚠️ The new version (2) is under development and is not yet available for use.

<br>

## Installation

Install the Botfire library using Composer:

```bash
composer require botfire/botfire:@dev
```

Import the library in your PHP code:

```php
use Botfire\Bot;
```

## Configuration

Befor doing anything, the bot token must be set first

Set your bot token:

```php
Bot::setToken('your-bot-token');
```

## Webhook

Set the webhook URL for your bot:

```php
$result = Bot::setWebhook($url);
```

## Messaging

### Send a Text Message

Send a message with auto-detected `chat_id`:

```php
Bot::new()->text('Your message here')->send();
```

Send a message to a specific `chat_id`:

```php
Bot::new()->text('Your message here')->send($chat_id);

```

### Send a Photo

Send a photo using its file ID:

```php
Bot::new()->photo($file_id)->send();
```

## Keyboards

### Inline Keyboard

Create an inline keyboard with buttons:

```php
use Botfire\Bot;
use Botfire\Models\Message;
use Botfire\Keyboard\InlineKeyboard;
use Botfire\Keyboard\InlineButton;


$btn = InlineButton::btn('Test', 'test');
$url = InlineButton::btnUrl('Test URL', 'https://example.com');

$keyboard = new InlineKeyboard();
$keyboard->row([$btn, $url]);

$msg = new Message('This is a test message with inline buttons.');
$msg->replyMarkup($keyboard);

Bot::sendMessage($msg);
```
