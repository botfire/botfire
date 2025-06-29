<?php

include_once __DIR__ . '/../vendor/autoload.php';
use Botfire\Bot;
use Botfire\Keyboard;
use Botfire\Message;
use Botfire\TelegramApi;


Bot::setToken('1222737593:AAFFyUyPDJ6E7LP6s8rVkWuf-ofR7ZKfmug');


$result = Bot::setWebhook('https://demobot.broo.ir/tests/run.php');

echo json_encode($result);


