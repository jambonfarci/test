<?php


namespace App\Entity;

/**
 * Class Brand
 * @package App\Entity
 */
abstract class Brand
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Country
     */
    protected $country;

    /**
     * Brand constructor.
     * @param int $id
     * @param string $name
     * @param Country $country
     */
    public function __construct(int $id, string $name, Country $country)
    {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }
}