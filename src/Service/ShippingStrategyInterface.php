<?php


namespace App\Service;

use App\Entity\Order;

/**
 * Interface ShippingStrategyInterface
 * @package App\Service
 */
interface ShippingStrategyInterface
{
    public function getShippingCost(Order $order): float;
}