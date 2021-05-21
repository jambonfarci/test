<?php


namespace App\Entity;

use UnexpectedValueException;

/**
 * Class Item
 * @package App\Entity
 */
class Item
{
    public const EXCEPTION_MESSAGE = "Impossible d'ajouter une quantité négative.";

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * Item constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->quantity = 1;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->getProduct()->getPrice() * $this->getQuantity();
    }

    /**
     * @return float
     */
    public function getPromotionValue(): float
    {
        $promotion = $this->getProduct()->getPromotion();

        if ($promotion !== null && $promotion->checkRules($this)) {
            return $promotion->apply($this);
        }

        return 0;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return ($this->getValue() - $this->getPromotionValue()) * ($this->getProduct()->getBrand()->getCountry()->getVatRate() / 100);
    }

    /**
     * @param int $quantity
     */
    public function addQuantity(int $quantity): void
    {
        if ($quantity < 0) {
            throw new UnexpectedValueException(self::EXCEPTION_MESSAGE);
        }

        $this->quantity += $quantity;
    }
}
