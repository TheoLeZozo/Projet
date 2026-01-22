<?php

namespace Models;

<<<<<<< HEAD
/**
 * Class Element
 * représente un élément 
 */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class Element
{
    private ?int $id = null;
    private string $name;
    private string $url_img;

    public function getId(): ?int
    {
        return $this->id;
    }
<<<<<<< HEAD
=======

>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }
}
