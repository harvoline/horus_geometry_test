<?php

namespace App\Entity;

use App\Repository\CircleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircleRepository::class)
 */
class Circle extends ShapeAbstract
{

    const PI = 3.142;
    const TYPE = 'circle';

    /**
     * @ORM\Column(type="float")
     */
    private $radius;

    public function __construct(float $radius = 0) {
        $this->type = self::TYPE;
        $this->setRadius($radius);
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): self
    {
        $this->radius = $radius;
        $this->setSurface();
        $this->setCircumference();

        return $this;
    }

    public function setSurface(): self
    {
        $surface = Circle::PI * pow($this->radius, 2);
        $this->surface = round($surface, 2, PHP_ROUND_HALF_DOWN);

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setCircumference(): self
    {
        $circumference = 2 * Circle::PI * $this->radius;
        $this->circumference = round($circumference, 2, PHP_ROUND_HALF_DOWN);

        return $this;
    }

    public function getCircumference(): ?float
    {
        return $this->circumference;
    }

    public function setType(): self
    {
        $this->type = self::TYPE;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCircleData(): array
    {
        return [
            'type' => $this->getType(),
            'radius' => $this->getRadius(),
            'surface' => $this->getSurface(),
            'circumference' => $this->getCircumference(),
        ];
    }
}
