<?php

namespace Models;

<<<<<<< HEAD
/**
 * Class Message
 *
 * simple modele pour les messages
 */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class Message
{
    private string $title;
    private string $message;
    private string $color;

    public function __construct(string $title, string $message, string $color = 'success')
    {
        $this->title = $title;
        $this->message = $message;
        $this->color = $color;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}
