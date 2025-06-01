<?php
namespace Botfire;

/**
 * Represents the criteria used to request a suitable chat in Telegram.
 * Based on Telegram Bot API documentation.
 */
class KeyboardButtonRequestChat {
    protected int $request_id;
    protected bool $chat_is_channel;
    protected ?bool $chat_is_forum = null;
    protected ?bool $chat_has_username = null;
    protected ?bool $chat_is_created = null;
    protected ?array $user_administrator_rights = null; // JSON-serialized object
    protected ?array $bot_administrator_rights = null;  // JSON-serialized object
    protected ?bool $bot_is_member = null;
    protected ?bool $request_title = null;
    protected ?bool $request_username = null;
    protected ?bool $request_photo = null;

    /**
     * Constructor for KeyboardButtonRequestChat.
     *
     * @param int $request_id Unique identifier for the request.
     * @param bool $chat_is_channel True for channel chat, False for group/supergroup chat.
     * @param bool|null $chat_is_forum Optional. True for forum supergroup, False for non-forum chat.
     * @param bool|null $chat_has_username Optional. True for chats with username, False otherwise.
     * @param bool|null $chat_is_created Optional. True for chats owned by the user.
     * @param array|null $user_administrator_rights Optional. Required admin rights for the user.
     * @param array|null $bot_administrator_rights Optional. Required admin rights for the bot.
     * @param bool|null $bot_is_member Optional. True if the bot must be a member of the chat.
     * @param bool|null $request_title Optional. True to request the chat's title.
     * @param bool|null $request_username Optional. True to request the chat's username.
     * @param bool|null $request_photo Optional. True to request the chat's photo.
     */
    public function __construct(
        int $request_id,
        bool $chat_is_channel,
        ?bool $chat_is_forum = null,
        ?bool $chat_has_username = null,
        ?bool $chat_is_created = null,
        ?array $user_administrator_rights = null,
        ?array $bot_administrator_rights = null,
        ?bool $bot_is_member = null,
        ?bool $request_title = null,
        ?bool $request_username = null,
        ?bool $request_photo = null
    ) {
        $this->request_id = $request_id;
        $this->chat_is_channel = $chat_is_channel;
        $this->chat_is_forum = $chat_is_forum;
        $this->chat_has_username = $chat_has_username;
        $this->chat_is_created = $chat_is_created;
        $this->user_administrator_rights = $user_administrator_rights;
        $this->bot_administrator_rights = $bot_administrator_rights;
        $this->bot_is_member = $bot_is_member;
        $this->request_title = $request_title;
        $this->request_username = $request_username;
        $this->request_photo = $request_photo;
    }

    // Getters and setters for all properties
    public function getRequestId(): int {
        return $this->request_id;
    }

    public function setRequestId(int $request_id): void {
        $this->request_id = $request_id;
    }

    public function isChatChannel(): bool {
        return $this->chat_is_channel;
    }

    public function setChatChannel(bool $chat_is_channel): void {
        $this->chat_is_channel = $chat_is_channel;
    }

    public function isChatForum(): ?bool {
        return $this->chat_is_forum;
    }

    public function setChatForum(?bool $chat_is_forum): void {
        $this->chat_is_forum = $chat_is_forum;
    }

    public function hasChatUsername(): ?bool {
        return $this->chat_has_username;
    }

    public function setChatUsername(?bool $chat_has_username): void {
        $this->chat_has_username = $chat_has_username;
    }

    public function isChatCreated(): ?bool {
        return $this->chat_is_created;
    }

    public function setChatCreated(?bool $chat_is_created): void {
        $this->chat_is_created = $chat_is_created;
    }

    public function getUserAdministratorRights(): ?array {
        return $this->user_administrator_rights;
    }

    public function setUserAdministratorRights(?array $user_administrator_rights): void {
        $this->user_administrator_rights = $user_administrator_rights;
    }

    public function getBotAdministratorRights(): ?array {
        return $this->bot_administrator_rights;
    }

    public function setBotAdministratorRights(?array $bot_administrator_rights): void {
        $this->bot_administrator_rights = $bot_administrator_rights;
    }

    public function isBotMember(): ?bool {
        return $this->bot_is_member;
    }

    public function setBotMember(?bool $bot_is_member): void {
        $this->bot_is_member = $bot_is_member;
    }

    public function isRequestTitle(): ?bool {
        return $this->request_title;
    }

    public function setRequestTitle(?bool $request_title): void {
        $this->request_title = $request_title;
    }

    public function isRequestUsername(): ?bool {
        return $this->request_username;
    }

    public function setRequestUsername(?bool $request_username): void {
        $this->request_username = $request_username;
    }

    public function isRequestPhoto(): ?bool {
        return $this->request_photo;
    }

    public function setRequestPhoto(?bool $request_photo): void {
        $this->request_photo = $request_photo;
    }


    public function toArray(): array {
        $data = [
            'request_id' => $this->request_id,
            'chat_is_channel' => $this->chat_is_channel,
        ];

        if ($this->chat_is_forum !== null) {
            $data['chat_is_forum'] = $this->chat_is_forum;
        }
        if ($this->chat_has_username !== null) {
            $data['chat_has_username'] = $this->chat_has_username;
        }
        if ($this->chat_is_created !== null) {
            $data['chat_is_created'] = $this->chat_is_created;
        }
        if ($this->user_administrator_rights !== null) {
            $data['user_administrator_rights'] = $this->user_administrator_rights;
        }
        if ($this->bot_administrator_rights !== null) {
            $data['bot_administrator_rights'] = $this->bot_administrator_rights;
        }
        if ($this->bot_is_member !== null) {
            $data['bot_is_member'] = $this->bot_is_member;
        }
        if ($this->request_title !== null) {
            $data['request_title'] = $this->request_title;
        }
        if ($this->request_username !== null) {
            $data['request_username'] = $this->request_username;
        }
        if ($this->request_photo !== null) {
            $data['request_photo'] = $this->request_photo;
        }

        return $data;
    }
}