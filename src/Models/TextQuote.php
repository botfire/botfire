<?php
namespace Botfire\Models;

class TextQuote {
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * Text of the quoted part of a message that is replied to by the given message.
     * @return string|null
     */
    public function getText(): ?string {
        return $this->data['text'] ?? null;
    }

    /**
     * Optional. Special entities that appear in the quote.
     * Currently, only bold, italic, underline, strikethrough, spoiler, and custom_emoji entities are kept in quotes.
     * @return array|null
     */
    public function getEntities(): ?array {
        return $this->data['entities'] ?? null;
    }

    /**
     * Approximate quote position in the original message in UTF-16 code units as specified by the sender.
     * @return int|null
     */
    public function getPosition(): ?int {
        return $this->data['position'] ?? null;
    }

    /**
     * Optional. True, if the quote was chosen manually by the message sender.
     * Otherwise, the quote was added automatically by the server.
     * @return bool
     */
    public function isManual(): bool {
        return $this->data['is_manual'] ?? false;
    }

    /**
     * Returns the quote data as an array.
     * @return array
     */
    public function asArray(): array {
        return $this->data;
    }
}