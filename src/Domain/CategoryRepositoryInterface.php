<?php


namespace App\Domain;


interface CategoryRepositoryInterface
{
    public function countProductsIn(Category $category): int;

    public function productsFrom(Category $category): iterable;

    public function save(Category $category): void;
}