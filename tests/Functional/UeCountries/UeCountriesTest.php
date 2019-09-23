<?php

namespace Systim\Tests\Functional\UeCountries;

use Systim\Tests\FunctionalSystimTestCase;

class UeCountriesTest extends FunctionalSystimTestCase
{
    public function testUeCountriesList()
    {
        $ueCountries = $this->systim->ueCountries()->list();

        $this->assertIsArray($ueCountries);
        $this->assertContains('PLN', $ueCountries);
    }
}