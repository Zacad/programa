<?php

declare(strict_types=1);

namespace App\Domain;

use Brick\Math\BigDecimal;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Price
 * @package App\Domain
 * @ORM\Embeddable()
 */
class Price
{
    /**
     * @ORM\Column(type="float")
     */
    private BigDecimal $price;
    /**
     * @ORM\Column(type="string", length=3)
     */
    private string $currency;

    public function __construct(BigDecimal $price, string $currency)
    {
        $this->price = $price;
        $this->setCurrency($currency);
    }

    public function isEqual(Price $anotherPrice): bool
    {
        return ($this->value()->isEqualTo($anotherPrice->value()) && ($this->currency() === $anotherPrice->currency()));
    }

    public function value(): BigDecimal
    {
        return $this->price;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    private function setCurrency(string $currency)
    {
        if (strlen($currency) > 3) {
            throw  new IllegalArgumentException('currency code to long');
        }
        $this->currency = $currency;
    }
}
