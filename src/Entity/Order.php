<?php


namespace App\Entity;

/**
 * Class Order
 * @package App\Entity
 */
class Order
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var array
     */
    protected $items;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item): void
    {
        /** @var Item $i */
        foreach ($this->items as $i) {
            if ($i->getProduct()->getId() === $item->getProduct()->getId()) {
                $i->addQuantity($item->getQuantity());
                return;
            }
        }

        $this->items[] = clone $item;
    }

    /**
     * @return float
     */
    public function getSubTotalHt(): float
    {
        return array_reduce($this->items, static function($accumulator, Item $item) {
            return $accumulator + $item->getValue();
        });
    }

    /**
     * @return float
     */
    public function getTotalHt(): float
    {
        return $this->getSubTotalHt() + $this->getShippingCost() - $this->getPromotionsValue();
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return array_reduce($this->items, static function($accumulator, Item $item) {
            return $accumulator + $item->getVat();
        });
    }

    /**
     * @return float
     */
    public function getTotalTtc(): float
    {
        return $this->getTotalHt() + $this->getVat();
    }

    /**
     * @return float
     */
    public function getShippingCost(): float
    {
        $brands = [];
        $cost = 0;

        /** @var Item $item */
        foreach ($this->items as $item) {
            if (!in_array($item->getProduct()->getBrand(), $brands, true)) {
                $brands[] = $item->getProduct()->getBrand();
            }
        }

        foreach ($brands as $brand) {
            $cost += $brand->getShippingCost($this);
        }

        return $cost;
    }

    /**
     * @return float
     */
    public function getPromotionsValue(): float
    {
        return array_reduce($this->items, static function($accumulator, Item $item) {
            return $accumulator + $item->getPromotionValue();
        });
    }
}
