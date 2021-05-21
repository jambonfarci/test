<?php


namespace App\Entity;

/**
 * Class Rule
 * @package App\Entity
 */
abstract class Rule
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Rule constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    abstract public function isValid(Item $item): bool;
}