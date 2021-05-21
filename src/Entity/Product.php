<?php

namespace App\Entity;

/**
 * Class Product
 * @package App\Entity
 */
class Product
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var Brand
     */
    protected $brand;

    /**
     * @var Promotion|null
     */
    protected $promotion;

    /**
     * @param int $id
     * @param string $title
     * @param float $price
     * @param Brand $brand
     */
    public function __construct(int $id, string $title, float $price, Brand $brand)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->brand = $brand;
        $this->promotion = null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return Promotion|null
     */
    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    /**
     * @param Promotion|null $promotion
     */
    public function setPromotion(?Promotion $promotion): void
    {
        $this->promotion = $promotion;
    }
}
