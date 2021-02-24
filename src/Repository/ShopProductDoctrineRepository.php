<?php

namespace App\Repository;

use App\Domain\ShopProduct;
use App\Domain\ShopProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ShopProductDoctrineRepository extends ServiceEntityRepository implements ShopProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopProduct::class);
    }

    public function save(ShopProduct $shopProduct): void
    {
        // TODO: Implement save() method.
        $entityManager = $this->getEntityManager();
        $entityManager->persist($shopProduct);
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

    public function findUnavailableProducts(): iterable
    {
        $query = $this->getEntityManager()->createQuery('
            select q
            from App\Domain\ShopProduct q
            where q.availability = false');

        return $query->getResult();
    }

    public function findProductsWithNameLike(string $phrase): iterable
    {

        $query = $this->getEntityManager()->createQuery('
            select q
            from App\Domain\ShopProduct q
            where q.name like :phrase')
            ->setParameter('phrase', \sprintf('%%%s%%',$phrase));

        return $query->getResult();
    }
}
