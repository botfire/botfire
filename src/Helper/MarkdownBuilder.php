<?php
namespace Botfire\Helper;
use InvalidArgumentException;


/**
 * MarkdownBuilder class to generate Telegram-compatible Markdown text.
 * Supports various formatting options like bold, italic, code, and blockquotes.
 */
class MarkdownBuilder
{
    /** @var string The accumulated Markdown text */
    private string $markdown = '';

    /**
     * Append plain text to the Markdown output.
     *
     * @param string $text The text to append
     * @return self
     */
    public function text(string $text): self
    {
        $this->markdown .= $this->escape($text);
        return $this;
    }

    /**
     * Append bold text.
     *
     * @param string $text The text to format as bold
     * @return self
     */
    public function bold(string $text): self
    {
        $this->markdown .= '*' . $this->escape($text) . '*';
        return $this;
    }

    /**
     * Append italic text.
     *
     * @param string $text The text to format as italic
     * @return self
     */
    public function italic(string $text): self
    {
        $this->markdown .= '_' . $this->escape($text) . '_';
        return $this;
    }

    /**
     * Append underlined text.
     *
     * @param string $text The text to format as underlined
     * @return self
     */
    public function underline(string $text): self
    {
        $this->markdown .= '__' . $this->escape($text) . '__';
        return $this;
    }

    /**
     * Append strikethrough text.
     *
     * @param string $text The text to format as strikethrough
     * @return self
     */
    public function strikethrough(string $text): self
    {
        $this->markdown .= '~' . $this->escape($text) . '~';
        return $this;
    }

    /**
     * Append spoiler text.
     *
     * @param string $text The text to format as spoiler
     * @return self
     */
    public function spoiler(string $text): self
    {
        $this->markdown .= '||' . $this->escape($text) . '||';
        return $this;
    }

    /**
     * Append inline fixed-width code.
     *
     * @param string $code The code to format as inline code
     * @return self
     */
    public function inlineCode(string $code): self
    {
        $this->markdown .= '`' . $this->escape($code) . '`';
        return $this;
    }

    /**
     * Append pre-formatted code block with optional language.
     *
     * @param string $code The code to format
     * @param string $language Optional programming language (e.g., 'python')
     * @return self
     */
    public function code(string $code, string $language = ''): self
    {
        $language = $this->escape($language);
        $this->markdown .= "```$language\n" . $this->escape($code) . "\n```";
        return $this;
    }

    /**
     * Append a block quotation.
     *
     * @param string $text The text to format as a block quote
     * @return self
     */
    public function quote(string $text): self
    {
        $lines = explode("\n", $this->escape($text));
        foreach ($lines as $line) {
            $this->markdown .= '> ' . $line . "\n";
        }
        return $this;
    }

    /**
     * Append an expandable block quotation.
     *
     * @param string $visibleText The visible part of the expandable quote
     * @param string $hiddenText The hidden part of the expandable quote
     * @return self
     */
    public function expandableQuote(string $visibleText, string $hiddenText = ''): self
    {
        $this->markdown .= "**>\n";
        $lines = explode("\n", $this->escape($visibleText));
        foreach ($lines as $line) {
            $this->markdown .= '> ' . $line . "\n";
        }
        if (!empty($hiddenText)) {
            $this->markdown .= ">||\n";
            $hiddenLines = explode("\n", $this->escape($hiddenText));
            foreach ($hiddenLines as $line) {
                $this->markdown .= '> ' . $line . "\n";
            }
            $this->markdown .= ">||\n";
        }
        return $this;
    }

    /**
     * Append an inline URL.
     *
     * @param string $text The display text for the URL
     * @param string $url The URL
     * @return self
     * @throws InvalidArgumentException If URL is invalid
     */
    public function url(string $text, string $url): self
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL provided');
        }
        $this->markdown .= '[' . $this->escape($text) . '](' . $url . ')';
        return $this;
    }

    /**
     * Append an inline user mention.
     *
     * @param string $text The display text for the mention
     * @param int $userId The Telegram user ID
     * @return self
     */
    public function mention(string $text, int $userId): self
    {
        $this->markdown .= '[' . $this->escape($text) . '](tg://user?id=' . $userId . ')';
        return $this;
    }

    /**
     * Append an emoji by its Telegram ID.
     *
     * @param string $emoji The emoji character
     * @param string $emojiId The Telegram emoji ID
     * @return self
     */
    public function emoji(string $emoji, string $emojiId): self
    {
        $this->markdown .= '[' . $emoji . '](tg://emoji?id=' . $emojiId . ')';
        return $this;
    }

    /**
     * Append a new line.
     *
     * @return self
     */
    public function newLine(int $repeat=1): self
    {
        $this->markdown .= str_repeat("\n", $repeat);
        return $this;
    }

    /**
     * Append a tab character.
     * @return self
     */
    public function tab(): self
    {
        $this->markdown .= "    ";
        return $this;
    }

    /**
     * Append a space character.
     *
     * @return self
     */
    public function sp(): self
    {
        $this->markdown .= ' ';
        return $this;
    }


    public

    /**
     * Escape special Markdown characters to prevent formatting issues.
     *
     * @param string $text The text to escape
     * @return string
     */
    private function escape(string $text): string
    {
        $specialChars = ['*', '_', '~', '`', '|', '[', ']', '(', ')', '#', '+', '-', '.', '!'];
        return str_replace($specialChars, array_map(fn($char) => '\\' . $char, $specialChars), $text);
    }

    /**
     * Get the final Markdown string.
     *
     * @return string
     */
    public function build(): string
    {
        return $this->markdown;
    }

    /**
     * Convert the builder to a string (alias for build).
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->build();
    }
}