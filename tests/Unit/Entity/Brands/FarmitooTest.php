<?php

namespace App\Tests\Unit\Entity\Brands;

use App\Entity\Brands\Farmitoo;
use App\Entity\Brands\Gallagher;
use App\Entity\Country;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class FarmitooTest
 * @package App\Tests\Unit\Entity\Brands
 */
class FarmitooTest extends TestCase
{
    public function testGetShippingCost()
    {
        $order = new Order();
        $country = new Country('fr');
        $brand1 = new Farmitoo(1, 'Farmitoo', $country);
        $brand2 = new Gallagher(2, 'Gallagher', $country);

        $product1 = new Product(1, 'Cuve à gasoil', 250000, $brand1);
        $item1 = new Item($product1);
        $order->addItem($item1);
        $this->assertEquals(20, $brand1->getShippingCost($order));

        $product2 = new Product(2, 'Nettoyant pour cuve', 5000, $brand1);
        $item2 = new Item($product2);
        $item2->addQuantity(2);
        $order->addItem($item2);
        $this->assertEquals(40, $brand1->getShippingCost($order));

        $product3 = new Product(3, 'Piquet de clôture', 1000, $brand2);
        $item3 = new Item($product3);
        $item3->addQuantity(1);
        $order->addItem($item3);
        $this->assertEquals(40, $brand1->getShippingCost($order));
    }
}
