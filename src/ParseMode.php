<?php
namespace Botfire;

class ParseMode{

    /**
     * To use this mode, pass MarkdownV2 in the parse_mode field. 
     * @var string
     */
    public const FormattingMarkdownV2 = 'MarkdownV2';


    /**
     * To use this mode, pass HTML in the parse_mode field
     * @var string
     */
    public const FormattingHTML = 'HTML';


    /**
     * This is a legacy mode, retained for backward compatibility
     * @var string
     */
    public const FormattingMarkdown = 'Markdown';


}