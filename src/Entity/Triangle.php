<?php

namespace App\Entity;

use App\Repository\TriangleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TriangleRepository::class)
 */
class Triangle extends ShapeAbstract
{

    const TYPE = 'triangle';

    /**
     * @ORM\Column(type="float")
     */
    private $side_a;

    /**
     * @ORM\Column(type="float")
     */
    private $side_b;

    /**
     * @ORM\Column(type="float")
     */
    private $side_c;

    /**
     * @ORM\Column(type="float")
     */
    public $surface;

    /**
     * @ORM\Column(type="float")
     */
    public $circumference;

    /**
     * @ORM\Column(type="string")
     */
    public $type;

    public function __construct(float $side_a = 0, float $side_b = 0, float $side_c = 0) {
        $this->side_a = $side_a;
        $this->side_b = $side_b;
        $this->side_c = $side_c;
        $this->type = self::TYPE;
        $this->setSurface();
        $this->setCircumference();
    }

    public function getSideA(): ?float
    {
        return $this->side_a;
    }

    public function setSideA(?float $side_a): self
    {
        $this->side_a = $side_a;

        return $this;
    }

    public function getSideB(): ?float
    {
        return $this->side_b;
    }

    public function setSideB(float $side_b): self
    {
        $this->side_b = $side_b;

        return $this;
    }

    public function getSideC(): ?float
    {
        return $this->side_c;
    }

    public function setSideC(float $side_c): self
    {
        $this->side_c = $side_c;

        return $this;
    }

    public function setSurface(): self
    {
        $s = ( $this->side_a + $this->side_b + $this->side_c ) / 2;
        $surface = sqrt($s * ($s - $this->side_a) * ($s - $this->side_b) * ($s - $this->side_c));

        $this->surface = round($surface, 2, PHP_ROUND_HALF_DOWN);

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setCircumference(): self
    {
        $circumference = $this->side_a + $this->side_b + $this->side_c;

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

    public function getTriangleData(): array
    {
        return [
            'type' => $this->getType(),
            'a' => $this->getSideA(),
            'b' => $this->getSideB(),
            'c' => $this->getSideC(),
            'surface' => $this->getSurface(),
            'circumference' => $this->getCircumference(),
        ];
    }
}
