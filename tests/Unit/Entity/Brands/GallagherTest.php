<?php

namespace App\Tests\Unit\Entity\Brands;

use App\Entity\Brands\Gallagher;
use App\Entity\Country;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

/**
 * Class GallagherTest
 * @package App\Tests\Unit\Entity
 */
class GallagherTest extends TestCase
{
    public function testGetShippingCost()
    {
        $brand = new Gallagher(1, 'Gallagher', new Country('fr'));
        $product = new Product(1, 'Cuve à gasoil', 250000, $brand);
        $item = new Item($product);
        $order = new Order();
        $order->addItem($item);
        $this->assertEquals(15, $brand->getShippingCost($order));
    }
}
