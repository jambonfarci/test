<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Brands\Farmitoo;
use App\Entity\Brands\Gallagher;
use App\Entity\Country;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\Rules\QuantityRule;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderTest
 * @package App\Tests\Unit\Entity
 */
class OrderTest extends TestCase
{
    public function testAddItem()
    {
        $order = new Order();
        $brand = new Farmitoo(1, 'Farmitoo', new Country('fr'));

        $product1 = new Product(1, 'Cuve à gasoil', 2500, $brand);
        $item1 = new Item($product1);
        $this->assertEmpty($order->getItems());
        $order->addItem($item1);
        $this->assertCount(1, $order->getItems());
        $this->assertEquals(1, $order->getItems()[0]->getQuantity());
        $item1->addQuantity(1);
        $order->addItem($item1);
        $this->assertCount(1, $order->getItems());
        $this->assertEquals(3, $order->getItems()[0]->getQuantity());

        $product2 = new Product(2, 'Nettoyant pour cuve', 50, $brand);
        $item2 = new Item($product2);
        $item2->addQuantity(5);
        $order->addItem($item2);
        $this->assertCount(2, $order->getItems());
        $this->assertEquals(6, $order->getItems()[1]->getQuantity());
    }

    public function testGetSubTotalHt()
    {
        $order = new Order();
        $country = new Country('fr');
        $brand1 = new Farmitoo(1, 'Farmitoo', $country);
        $brand2 = new Gallagher(2, 'Gallagher', $country);

        $product1 = new Product(1, 'Cuve à gasoil', 2500, $brand1);
        $item1 = new Item($product1);
        $order->addItem($item1);

        $product2 = new Product(2, 'Nettoyant pour cuve', 50, $brand1);
        $item2 = new Item($product2);
        $item2->addQuantity(2);
        $order->addItem($item2);

        $product3 = new Product(3, 'Piquet de clôture', 10, $brand2);
        $item3 = new Item($product3);
        $item3->addQuantity(1);
        $order->addItem($item3);

        $this->assertEquals(2670, $order->getSubTotalHt());
    }

    public function testGetShippingCostWithZeroItem()
    {
        $order = new Order();
        $this->assertEquals(0, $order->getShippingCost());
    }

    public function testGetShippingCost()
    {
        $order = new Order();
        $country = new Country('fr');
        $brand1 = new Farmitoo(1, 'Farmitoo', $country);
        $brand2 = new Gallagher(2, 'Gallagher', $country);

        $product1 = new Product(1, 'Cuve à gasoil', 2500, $brand1);
        $item1 = new Item($product1);
        $order->addItem($item1);

        $product2 = new Product(2, 'Nettoyant pour cuve', 50, $brand1);
        $item2 = new Item($product2);
        $item2->addQuantity(2);
        $order->addItem($item2);

        $product3 = new Product(3, 'Piquet de clôture', 10, $brand2);
        $item3 = new Item($product3);
        $item3->addQuantity(1);
        $order->addItem($item3);

        $this->assertEquals(55, $order->getShippingCost());
    }

    public function testGetPromotionsValue()
    {
        $order = new Order();
        $country = new Country('fr');
        $brand1 = new Farmitoo(1, 'Farmitoo', $country);
        $brand2 = new Gallagher(2, 'Gallagher', $country);

        $product1 = new Product(1, 'Cuve à gasoil', 2500, $brand1);
        $item1 = new Item($product1);
        $order->addItem($item1);

        $product2 = new Product(2, 'Nettoyant pour cuve', 50, $brand1);
        $promotion1 = new Promotion(1, 8);
        $promotion1->addRule(new QuantityRule(1, 3));
        $product2->setPromotion($promotion1);
        $item2 = new Item($product2);
        $item2->addQuantity(2);
        $order->addItem($item2);

        $product3 = new Product(3, 'Piquet de clôture', 10, $brand2);
        $promotion2 = new Promotion(2, 25);
        $promotion2->addRule(new QuantityRule(2, 5));
        $product3->setPromotion($promotion2);
        $item3 = new Item($product3);
        $item3->addQuantity(4);
        $order->addItem($item3);

        $this->assertEquals(24.5, $order->getPromotionsValue());
    }

    public function testOrderComplete()
    {
        $order = new Order();
        $country = new Country('fr');
        $brand1 = new Farmitoo(1, 'Farmitoo', $country);
        $brand2 = new Gallagher(2, 'Gallagher', $country);

        $product1 = new Product(1, 'Cuve à gasoil', 2500, $brand1);
        $item1 = new Item($product1);
        $order->addItem($item1);

        $product2 = new Product(2, 'Nettoyant pour cuve', 50, $brand1);
        $promotion1 = new Promotion(1, 8);
        $promotion1->addRule(new QuantityRule(1, 3));
        $product2->setPromotion($promotion1);
        $item2 = new Item($product2);
        $item2->addQuantity(2);
        $order->addItem($item2);

        $product3 = new Product(3, 'Piquet de clôture', 10, $brand2);
        $promotion2 = new Promotion(2, 25);
        $promotion2->addRule(new QuantityRule(2, 5));
        $product3->setPromotion($promotion2);
        $item3 = new Item($product3);
        $item3->addQuantity(4);
        $order->addItem($item3);

        $this->assertEquals(2700, $order->getSubTotalHt());
        $this->assertEquals(2730.5, $order->getTotalHt());
        $this->assertEquals(535.1, $order->getVat());
        $this->assertEquals(3265.6, $order->getTotalTtc());
    }
}
