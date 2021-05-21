<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Country;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

/**
 * Class CountryTest
 * @package App\Tests\Unit\Entity
 */
class CountryTest extends TestCase
{
    public function testNewCountryOk()
    {
        $country = new Country('fr');
        $this->assertEquals(20, $country->getVatRate());
    }

    public function testNewCountryKo()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage(Country::EXCEPTION_MESSAGE);
        new Country('de');
    }
}
