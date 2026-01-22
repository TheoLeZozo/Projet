<?php

namespace Models;

class Origin
{
    private ?int $id = null;
    private string $name;
    private string $urlImg;

    /* getters */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    /* setters */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }

    /* hydratation 
    * permet d'initialiser un objet avec un tableau de données
    * @param array $data
    * @return void
    */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
