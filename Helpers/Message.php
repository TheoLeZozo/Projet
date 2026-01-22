<?php
namespace Helpers;

/**
 * Classe Message
 *
 * Représente un message avec un titre, un contenu et une couleur
 */
class Message
{
    public const COLOR_INFO = 'info';
    public const COLOR_SUCCESS = 'success';
    public const COLOR_ERROR = 'error';

    public function __construct(
        public string $message,
        public string $color = self::COLOR_INFO,
        public string $title = 'Message'
    ) {}
}
