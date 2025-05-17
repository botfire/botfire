# Botfire Library Documentation

<br>

### ⚠️ The new version (2) is under development and is not yet available for use.

<br>

## Installation

Install the Botfire library using Composer:

```bash
composer require botfire/botfire
```

Import the library in your PHP code:

```php
use Botfire\Bot;
```

## Configuration

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
Bot::new()->message('Your message here')->send();
```

Send a message to a specific `chat_id`:

```php
Bot::new()->message('Your message here')->send($chat_id);
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
$keyboard = new Keyboard();

$keyboard
    ->btn('Button 1', 'Callback Data 1')
    ->btn('Button 2', 'Callback Data 2')
    ->row()
    ->btnUrl('Button 3', 'https://github.com')
    ->row();

Bot::id(Bot::chat()->id)
    ->message('Your message here')
    ->replyMarkup($keyboard)
    ->send();
```
