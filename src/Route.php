<?php
namespace Botfire;

use Botfire\Bot;
use Webrium\Route as IRoute;

class Route
{

    private static $routeParams = [];

    public static $find = false;



    public static function text($path, $controllerString)
    {

        if (Bot::getEvent()->isCallbackQuery() == false && Bot::getMessage()->getContentType() == GetMessage::TYPE_TEXT && $path == Bot::getMessage()->getText()) {
            self::$find = true;
            self::run($controllerString);
        }
    }


    public static function callback($path, $controllerString)
    {
        if (Bot::getEvent()->isCallbackQuery()) {

            $callback_data = Bot::getCallback()->getData();

            $data = self::findVar($callback_data, $path);

            if ($data['is']) {
                self::$find = true;
                self::run($controllerString);
            }
        }
    }


    public static function run($controllerString)
    {
        IRoute::executeControllerMethod($controllerString, self::getRouteParams());
        die();
    }

    public static function notFound($file = false)
    {
        if (!self::$find) {

            if ($file) {
                self::run($file);
            }

        }
    }

    public static function findVar($string, $path)
    {
        $arr = explode('/', $string);
        $parr = explode('/', $path);
        $params = [];

        foreach ($parr as $key => $str) {

            if (strpos($str, '{') === 0) {
                $newStr = str_replace('{', '', $str);
                $newStr = str_replace('}', '', $newStr);

                if (isset($arr[$key])) {
                    $params[$newStr] = $arr[$key];

                    $path = str_replace('{' . $newStr . '}', $arr[$key], $path);
                }

            }
        }
        $is = false;
        if ($string === $path) {
            $is = true;
        }

        self::setRouteParams($params);

        return ['params' => $params, 'is' => $is];
    }



    private static function setRouteParams(array $params) {
        self::$routeParams = $params;
    }
    

    private static function getRouteParams() {
        return self::$routeParams;
    }


    public static function getParam($name)
    {
        $params = self::getRouteParams();
        if (isset($params[$name])) {
            return $params[$name];
        }
        return null;
    }

}