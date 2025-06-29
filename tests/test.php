<?php

include_once __DIR__ . '/../vendor/autoload.php';
use Botfire\Bot;
use Botfire\GetCallback;
use Botfire\Helper\MarkdownBuilder;
use Botfire\InlineKeyboard;
use Botfire\InlineKeyboardButton;
use Botfire\KeyboardButton;
use Botfire\MarkupKeyboard;
use Botfire\Models\Message;
use Botfire\Models\Photo;

// Bot::setToken('1222737593:AAFFyUyPDJ6E7LP6s8rVkWuf-ofR7ZKfmug');

$bi = new MarkdownBuilder;
$bi->text('Hello')->bold('World')->newLine()->italic('This is italic text')->newLine()->underline('This is underlined text')->newLine()->code('This is inline code')->newLine();

$photo = new Photo('fsdfs');
$photo->caption('dfs');
// $msg = Message::create($bi);
// $msg->chatId('123456789');

// Bot::sendMessage($b);

echo json_encode($photo->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
