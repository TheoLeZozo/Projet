<?php

namespace Helpers;

/**
 * Classe Flash
 *
 * une aide pour gérer les messages flash dans la session
 */
class Flash
{
    private const KEY = '_flash_message';

    public static function set(Message $message): void
    {
        $_SESSION[self::KEY] = [
            'title' => $message->title,
            'message' => $message->message,
            'color' => $message->color,
        ];
    }

    public static function setFromString(string $text, string $color = Message::COLOR_INFO, string $title = 'Message'): void
    {
        self::set(new Message($text, $color, $title));
    }


    public static function get(): ?Message
    {
        if (!isset($_SESSION[self::KEY])) {
            return null;
        }
        $data = $_SESSION[self::KEY];
        unset($_SESSION[self::KEY]);

        return new Message(
            (string)($data['message'] ?? ''),
            (string)($data['color'] ?? Message::COLOR_INFO),
            (string)($data['title'] ?? 'Message')
        );
    }
}
