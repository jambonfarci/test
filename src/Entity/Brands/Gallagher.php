<?php


namespace App\Entity\Brands;


use App\Entity\Brand;
use App\Entity\Order;
use App\Service\ShippingStrategyInterface;

/**
 * Class Gallagher
 * @package App\Entity\Brands
 */
class Gallagher extends Brand implements ShippingStrategyInterface
{
    public function getShippingCost(Order $order): float
    {
        return 15;
    }
}