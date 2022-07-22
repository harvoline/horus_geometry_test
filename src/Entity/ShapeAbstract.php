<?php

namespace App\Entity;

use App\Repository\ShapeAbstractRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShapeAbstractRepository::class)
 */
abstract class ShapeAbstract
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $circumference;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getSurface(): ?float
    // {
    //     return $this->surface;
    // }

    // public function setSurface(?float $surface): self
    // {
    //     $this->surface = $surface;

    //     return $this;
    // }

    abstract public function getSurface() : ?float;

    abstract public function setSurface() : self;

    // public function getCircumference(): ?float
    // {
    //     return $this->circumference;
    // }

    // public function setCircumference(?float $circumference): self
    // {
    //     $this->circumference = $circumference;

    //     return $this;
    // }

    abstract public function getCircumference() : ?float;

    abstract public function setCircumference() : self;

    // public function getType(): ?float
    // {
    //     return $this->type;
    // }

    abstract public function getType() : string;

    abstract public function setType() : self;
}
