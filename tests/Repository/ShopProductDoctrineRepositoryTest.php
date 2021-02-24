<?php

namespace App\Tests\Repository;

use App\Domain\Price;
use App\Domain\ShopProduct;
use App\Domain\ShopProductRepositoryInterface;
use App\Repository\ShopProductDoctrineRepository;
use Brick\Math\BigDecimal;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Component\HttpKernel\KernelInterface;

class ShopProductDoctrineRepositoryTest extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    private $entityManager;
    private KernelInterface $testKernel;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->testKernel = self::bootKernel([
            'environment' => 'test'
        ]);
        $this->entityManager = $this->testKernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->truncateEntities();
    }

    public function testItSaveProduct()
    {
        /**
         * @var $repository ShopProductDoctrineRepository
         */
        $repository = $this->entityManager->getRepository(ShopProduct::class);

        $price = new Price(BigDecimal::of(1.05), 'pln');
        $product = new ShopProduct('buty', 'opis', $price, true);

        $repository->save($product);

        $newProduct = $repository->find($product->getId());

        $this->assertInstanceOf(ShopProductDoctrineRepository::class, $repository);
        $this->assertSame($product->getName(), $newProduct->getName());
        $this->assertSame($product->getId(), $newProduct->getId());
    }

    public function testItCountsAvailableProducts()
    {
        /**
         * @var $repository ShopProductDoctrineRepository
         */
        $repository = $this->entityManager->getRepository(ShopProduct::class);

        $price = new Price(BigDecimal::of(1.05), 'pln');
        $product = new ShopProduct('buty', 'opis', $price, true);
        $repository->save($product);

        $product = new ShopProduct('buty2', 'opis', $price, false);
        $repository->save($product);

        $product = new ShopProduct('buty3', 'opis', $price, true);
        $repository->save($product);

        $availableProductsCount = $repository->countAvailableProducts();

        $this->assertEquals(2, $availableProductsCount);
    }

    public function testItFindsUnavailableProducts()
    {
        /**
         * @var $repository ShopProductDoctrineRepository
         */
        $repository = $this->entityManager->getRepository(ShopProduct::class);

        $price = new Price(BigDecimal::of(1.05), 'pln');
        $product = new ShopProduct('buty', 'opis', $price, true);
        $repository->save($product);

        $product = new ShopProduct('buty2', 'opis', $price, false);
        $repository->save($product);

        $product = new ShopProduct('buty3', 'opis', $price, true);
        $repository->save($product);

        $unavailableProducts = $repository->findUnavailableProducts();

        $this->assertEquals(1, count($unavailableProducts));
        $this->assertEquals('buty2', $unavailableProducts[0]->getName());
    }

    public function testItFindsProductsByPartOfName()
    {
        /**
         * @var $repository ShopProductDoctrineRepository
         */
        $repository = $this->entityManager->getRepository(ShopProduct::class);

        $price = new Price(BigDecimal::of(1.05), 'pln');
        $product = new ShopProduct('buty sportowe', 'opis', $price, true);
        $repository->save($product);

        $product = new ShopProduct('buty2 trekingowe', 'opis', $price, false);
        $repository->save($product);

        $product = new ShopProduct('buty3 sportowe', 'opis', $price, true);
        $repository->save($product);

        $unavailableProducts = $repository->findProductsWithNameLike('sportowe');

        $this->assertEquals(2, count($unavailableProducts));
    }

    public function tearDown(): void
    {
        parent::tearDown(); // TODO: Change the autogenerated stub
        $this->entityManager->close();
        $this->entityManager = null;
    }

    private function truncateEntities()
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->purge();
    }
}