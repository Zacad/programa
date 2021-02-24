<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\ShopProductRepositoryInterface;

/**
 * Class ShopProduct
 * @package App\Domain
 * @ORM\Entity(repositoryClass="ShopProductRepositoryInterface::class")
 */
class ShopProduct
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\Embedded(class="Price")
     */
    private Price $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $availability;

    public function __construct(
        string $name,
        string $description,
        Price $price,
        bool $availability
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->availability = $availability;
    }
}
