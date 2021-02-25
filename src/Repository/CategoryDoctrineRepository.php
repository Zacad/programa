<?php


namespace App\Repository;


use App\Domain\Category;
use App\Domain\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryDoctrineRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function save(Category $category): void
    {
        // TODO: Implement save() method.
        $entityManager = $this->getEntityManager();
        $entityManager->persist($category);
        $entityManager->flush();
    }

    public function countAvailableProducts(): int
    {
        $query = $this->getEntityManager()->createQuery('
            select count(q.id)
            from App\Domain\ShopProduct q
            where q.availability = true');

        return $query->getSingleScalarResult();
    }

    public function countProductsIn(Category $category): int
    {
        $query = $this->getEntityManager()->createQuery('
            select count(p.id)
            from App\Domain\ShopProduct p
            join p.categories c
            with c.id = :category_id')
        ->setParameter(':category_id', $category->getId());

        return $query->getSingleScalarResult();
    }

    public function productsFrom(Category $category): iterable
    {
        $query = $this->getEntityManager()->createQuery('
            select p
            from App\Domain\ShopProduct p
            join p.categories c
            with c.id = :category_id')
            ->setParameter(':category_id', $category->getId());

        return $query->getResult();
    }
}