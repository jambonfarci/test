<?php


namespace App\Entity;


/**
 * Class Promotion
 * @package App\Entity
 */
class Promotion
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $reduction;

    /**
     * @var array
     */
    protected $rules;

    /**
     * @param int $id
     * @param int $reduction
     */
    public function __construct(int $id, int $reduction)
    {
        $this->id = $id;
        $this->reduction = $reduction;
        $this->rules = [];
    }

    /**
     * @return int
     */
    public function getReduction(): int
    {
        return $this->reduction;
    }

    /**
     * @param int $reduction
     */
    public function setReduction(int $reduction): void
    {
        $this->reduction = $reduction;
    }

    /**
     * @param Rule $rule
     */
    public function addRule(Rule $rule): void
    {
        $this->rules[] = $rule;
    }

    /**
     * @param Item $item
     * @return bool
     */
    public function checkRules(Item $item): bool
    {
        return array_reduce($this->rules, function($accumulator, Rule $rule) use ($item) {
            return $accumulator && $rule->isValid($item);
        }, true);
    }

    public function apply(Item $item): float
    {
        return $item->getValue() * ($this->reduction / 100);
    }
}
