<?php


namespace App\Entity;

use UnexpectedValueException;

/**
 * Class Country
 * @package App\Entity
 */
class Country
{
    public const COUNTRIES = ['fr' => 20, 'es' => 21];
    public const EXCEPTION_MESSAGE = "Ce code pays n'existe pas.";

    /**
     * @var string
     */
    protected $code;

    /** @var float */
    protected $vatRate;

    /**
     * Country constructor.
     * @param string $code
     */
    public function __construct(string $code)
    {
        if (!array_key_exists($code, self::COUNTRIES)) {
            throw new UnexpectedValueException(self::EXCEPTION_MESSAGE);
        }

        $this->code = $code;
        $this->vatRate = self::COUNTRIES[$code];
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return float
     */
    public function getVatRate(): float
    {
        return $this->vatRate;
    }
}