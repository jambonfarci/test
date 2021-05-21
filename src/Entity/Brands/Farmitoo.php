<?php


namespace App\Entity\Brands;


use App\Entity\Brand;
use App\Entity\Item;
use App\Entity\Order;
use App\Service\ShippingStrategyInterface;

/**
 * Class Farmitoo
 * @package App\Entity\Brands
 */
class Farmitoo extends Brand implements ShippingStrategyInterface
{
    public function getShippingCost(Order $order): float
    {
        $items = array_filter($order->getItems(), static function (Item $item) {
           return get_class($item->getProduct()->getBrand()) === self::class;
        });

        return ceil(array_reduce($items, static function($accumulator, Item $item) {
            return $accumulator + $item->getQuantity();
        }) / 3) * 20;
    }
}