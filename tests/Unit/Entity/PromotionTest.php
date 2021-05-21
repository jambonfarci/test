<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Brands\Farmitoo;
use App\Entity\Country;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Promotion;
use App\Entity\Rules\QuantityRule;
use PHPUnit\Framework\TestCase;

/**
 * Class PromotionTest
 * @package App\Tests\Unit\Entity
 */
class PromotionTest extends TestCase
{
    public function testApplyKo()
    {
        $order = new Order();
        $brand = new Farmitoo(1, 'Farmitoo', new Country('fr'));

        $product = new Product(1, 'Nettoyant pour cuve', 5000, $brand);
        $item = new Item($product);
        $item->addQuantity(1);
        $order->addItem($item);

        $promotion = new Promotion(1, 8);
        $promotion->addRule(new QuantityRule(1, 3));
        // Exemple : $promotion->addRule(new DateRule(new DateTime(), (new DateTime())->add(new DateInterval('P1M'))));
        $product->setPromotion($promotion);

        $this->assertFalse($promotion->checkRules($item));
    }

    public function testApplyOk()
    {
        $order = new Order();
        $brand = new Farmitoo(1, 'Farmitoo', new Country('fr'));

        $product = new Product(1, 'Nettoyant pour cuve', 5000, $brand);
        $item = new Item($product);
        $item->addQuantity(2);
        $order->addItem($item);

        $promotion = new Promotion(1, 8);
        $promotion->addRule(new QuantityRule(1, 3));
        $product->setPromotion($promotion);

        $this->assertTrue($promotion->checkRules($item));
        $this->assertEquals(1200, $promotion->apply($item));
    }
}
