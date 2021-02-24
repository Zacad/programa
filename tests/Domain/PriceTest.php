<?php


namespace App\Tests\Domain;


use App\Domain\Price;
use Brick\Math\BigDecimal;

class PriceTest extends \PHPUnit\Framework\TestCase
{
    public function testItComparesSame()
    {
        $price = new Price(BigDecimal::of(1.05), 'pln');
        $price2 = new Price(BigDecimal::of(1.05), 'pln');

        $this->assertTrue($price->isEqual($price2));
    }
}