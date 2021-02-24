<?php


namespace App\Domain;


interface ShopProductRepositoryInterface
{
    public function save(ShopProduct $shopProduct): void;
}