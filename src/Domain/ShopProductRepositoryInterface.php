<?php

namespace App\Domain;

use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Iterable_;

interface ShopProductRepositoryInterface
{
    public function save(ShopProduct $shopProduct): void;

    public function countAvailableProducts(): int;

    public function findUnavailableProducts(): iterable;

    public function findProductsWithNameLike(string $phrase): iterable;
}
