<?php

namespace Models;

class Origin
{
    private ?int $id = null;
    private string $name;
    private string $urlImg;

<<<<<<< HEAD
    /* getters */
=======
    // ---------- GETTERS ----------
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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

<<<<<<< HEAD
    /* setters */
=======
    // ---------- SETTERS ----------
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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

<<<<<<< HEAD
    /* hydratation 
    * permet d'initialiser un objet avec un tableau de données
    * @param array $data
    * @return void
    */
=======
    // ---------- HYDRATATION ----------
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
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
