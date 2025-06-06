<?php
namespace Botfire;


class GetEvent
{
    private static ?array $body = null;
    private static $update_id = 0;

    private static bool $support_type = false;

    private static ?string $event_name = null;



    const TYPE_MESSAGE = 'message';
    const TYPE_EDITED_MESSAGE = 'edited_message';
    const TYPE_CHANNEL_POST = 'channel_post';
    const TYPE_EDITED_CHANNEL_POST = 'edited_channel_post';
    const TYPE_BUSINESS_CONNECTION = 'business_connection';
    const TYPE_BUSINESS_MESSAGE = 'business_message';
    const TYPE_EDITED_BUSINESS_MESSAGE = 'edited_business_message';
    const TYPE_DELETED_BUSINESS_MESSAGES = 'deleted_business_messages';
    const TYPE_MESSAGE_REACTION = 'message_reaction';
    const TYPE_MESSAGE_REACTION_COUNT = 'message_reaction_count';
    const TYPE_INLINE_QUERY = 'inline_query';
    const TYPE_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
    const TYPE_CALLBACK_QUERY = 'callback_query';
    const TYPE_SHIPPING_QUERY = 'shipping_query';
    const TYPE_PRE_CHECKOUT_QUERY = 'pre_checkout_query';
    const TYPE_PURCHASED_PAID_MEDIA = 'purchased_paid_media';
    const TYPE_POLL = 'poll';
    const TYPE_POLL_ANSWER = 'poll_answer';
    const TYPE_MY_CHAT_MEMBER = 'my_chat_member';
    const TYPE_CHAT_MEMBER = 'chat_member';
    const TYPE_CHAT_JOIN_REQUEST = 'chat_join_request';
    const TYPE_CHAT_BOOST = 'chat_boost';
    const TYPE_REMOVED_CHAT_BOOST = 'removed_chat_boost';



    private static function parse(): array|null
    {
        if (self::$body !== null) {
            return self::$body;
        }

        $input = Bot::getInput();

        if (isset($input[self::TYPE_MESSAGE])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_MESSAGE;
        } elseif (isset($input[self::TYPE_EDITED_MESSAGE])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_EDITED_MESSAGE;
        } elseif (isset($input[self::TYPE_CHANNEL_POST])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_CHANNEL_POST;
        } elseif (isset($input[self::TYPE_EDITED_CHANNEL_POST])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_EDITED_CHANNEL_POST;
        } elseif (isset($input[self::TYPE_CALLBACK_QUERY])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_CALLBACK_QUERY;
        } elseif (isset($input[self::TYPE_BUSINESS_MESSAGE])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_BUSINESS_MESSAGE;
        } elseif (isset($input[self::TYPE_EDITED_BUSINESS_MESSAGE])) {
            self::$support_type = true;
            self::$event_name = self::TYPE_EDITED_BUSINESS_MESSAGE;
        }

        if (self::$support_type) {
            self::$body = $input[self::$event_name];
        }

        self::$update_id = $input['update_id'] ?? 0;

        return self::$body;
    }

    public static function getInstance()
    {
        if (self::$body === null) {
            self::parse();
        }
        return new self();
    }


    public function name()
    {
        if (self::$support_type) {
            return self::$event_name;
        }
        return null;
    }

    /**
     * Get the type of the event.
     * Just support message types for now.
     * @return string|null
     */
    public function type()
    {
        $event_name = $this->name();
        
        $message_events = [
            'message',
            'edited_message',
            'channel_post',
            'edited_channel_post',
            'callback_query',
            'business_message',
            'edited_business_message'
        ];
        
        if (in_array($event_name, haystack: $message_events)) {
            return 'message';
        }
        return null;
    }
    /**
     * Get the body of the event.
     * If the event is a message, it returns an instance of GetMessage.
     * @return GetMessage|null
     */
    public function eventBodyClass(){
        if($this->type() === 'message') {
            return new GetMessage($this->body());
        }
    }


    /**
     * Get the body of the event.
     * This is the raw data of the event.
     * @return array|null
     */
    public function body(): ?array
    {
        return self::$body;
    }


    /**
     * Check if this event is a supported message type in this library.
     * @return bool
     */
    public function isSupportedMessageType(): bool
    {
        return self::$support_type;
    }


    /**
     * Get the update ID of the event.
     * This is useful for tracking updates and ensuring that you are processing the latest updates.
     * @return int
     */
    public function updateId(): int
    {
        return self::$update_id;
    }



}

