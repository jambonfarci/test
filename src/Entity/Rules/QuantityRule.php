<?php


namespace App\Entity\Rules;


use App\Entity\Item;
use App\Entity\Rule;

/**
 * Class QuantityRule
 * @package App\Entity\Rules
 */
class QuantityRule extends Rule
{
    /**
     * @var int
     */
    protected $quantity;

    /**
     * QuantityRule constructor.
     * @param int $id
     * @param int $quantity
     */
    public function __construct(int $id, int $quantity)
    {
        parent::__construct($id);
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function isValid(Item $item): bool
    {
        return $item->getQuantity() >= $this->quantity;
    }
}