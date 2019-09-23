<?php

namespace Systim\Tests\Currencies;

use Systim\Tests\FunctionalSystimTestCase;

class CurrenciesTest extends FunctionalSystimTestCase
{
    public function testListCurrencies()
    {
        $currencies = $this->systim->currencies()->list();

        $this->assertIsArray($currencies);
        $this->assertContains('PLN', $currencies);
    }
}