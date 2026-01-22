<?php

namespace Models;

<<<<<<< HEAD
/*
 * Classe représentant un personnage
 */
=======
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
class Personnage
{
    private ?int $id = null;
    private string $name = '';
    private int $rarity = 0;
    private ?string $image = null;

    private ?int $originId = null;
    private ?int $unitClassId = null;

    /** @var Element[] */
    private array $elements = [];

<<<<<<< HEAD
    /* getters */
=======
    // ===== GETTERS =====
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getRarity(): int { return $this->rarity; }

    public function getImage(): ?string { return $this->image; }

<<<<<<< HEAD

=======
    // compat si ta vue utilise getUrlImg() pour l’image du perso
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function getUrlImg(): ?string { return $this->image; }

    public function getOriginId(): ?int { return $this->originId; }

<<<<<<< HEAD

=======
    // ⚠️ Une seule méthode (PHP ignore la casse)
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function getUnitClassId(): ?int { return $this->unitClassId; }

    /** @return Element[] */
    public function getElements(): array { return $this->elements; }

<<<<<<< HEAD
    /* setters */
=======
    // ===== SETTERS =====
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function setId(int|string|null $id): void
    {
        $this->id = ($id === null || $id === '') ? null : (int)$id;
    }

    public function setName(string $name): void { $this->name = $name; }
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    public function setImage(?string $image): void { $this->image = $image; }
    public function setUrlImg(?string $urlImg): void { $this->image = $urlImg; }

    public function setOriginId(?int $originId): void { $this->originId = $originId; }

<<<<<<< HEAD
    // Une seule méthode
=======
    // ⚠️ Une seule méthode
>>>>>>> d069e895e7b001512b0a65d51dca5cc0fa835f95
    public function setUnitClassId(?int $unitClassId): void { $this->unitClassId = $unitClassId; }

    /** @param Element[] $elements */
    public function setElements(array $elements): void { $this->elements = $elements; }

    public function addElement(Element $element): void { $this->elements[] = $element; }
}
