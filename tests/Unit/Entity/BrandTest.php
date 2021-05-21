<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Brands\Gallagher;
use App\Entity\Country;
use PHPUnit\Framework\TestCase;

/**
 * Class BrandTest
 * @package App\Tests\Unit\Entity
 */
class BrandTest extends TestCase
{
    public function testSetCountry()
    {
        $brand = new Gallagher(1, 'Gallagher', new Country('fr'));
        $brand->setCountry(new Country('es'));
        $this->assertEquals(21, $brand->getCountry()->getVatRate());
    }
}
