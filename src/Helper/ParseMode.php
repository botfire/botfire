<?php
namespace Botfire\Helper;


/**
 * ParseMode class to define different text formatting modes for Telegram messages.
 * 
 * This class provides constants for various parse modes that can be used when sending messages.
 * 
 * @package Botfire\Helper
 */
class ParseMode{

    /**
     * To use this mode, pass MarkdownV2 in the parse_mode field. 
     * @var string
     */
    public const MarkdownV2 = 'MarkdownV2';


    /**
     * To use this mode, pass HTML in the parse_mode field
     * @var string
     */
    public const HTML = 'HTML';


    /**
     * This is a legacy mode, retained for backward compatibility
     * @var string
     */
    public const Markdown = 'Markdown';


}