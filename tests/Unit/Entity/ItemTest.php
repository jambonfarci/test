<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Brands\Farmitoo;
use App\Entity\Country;
use App\Entity\Item;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

/**
 * Class ItemTest
 * @package App\Tests\Unit\Entity
 */
class ItemTest extends TestCase
{
    public function testGetQuantity()
    {
        $brand = new Farmitoo(1, 'Farmitoo', new Country('fr'));
        $product = new Product(1, 'Cuve à gasoil', 250000, $brand);
        $item = new Item($product);
        $this->assertEquals(1, $item->getQuantity());
    }

    public function testAddQuantityOk()
    {
        $brand = new Farmitoo(1, 'Farmitoo', new Country('fr'));
        $product = new Product(1, 'Cuve à gasoil', 250000, $brand);
        $item = new Item($product);
        $item->addQuantity(3);
        $this->assertEquals(4, $item->getQuantity());
    }

    public function testAddQuantityKo()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage(Item::EXCEPTION_MESSAGE);
        $brand = new Farmitoo(1, 'Farmitoo', new Country('fr'));
        $product = new Product(1, 'Cuve à gasoil', 250000, $brand);
        $item = new Item($product);
        $item->addQuantity(-1);
    }
}
