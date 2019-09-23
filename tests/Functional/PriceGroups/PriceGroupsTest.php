<?php

namespace Sigrun\Tests\Functional\PriceGroups;

use Systim\Tests\FunctionalSystimTestCase;

class PriceGroupsTest extends FunctionalSystimTestCase
{
    public function testPriceGroups()
    {
        $priceGroups = $this->systim->priceGroups()->list();

        $this->assertIsArray($priceGroups);
        $this->assertContains('PLN', $priceGroups);
    }
}