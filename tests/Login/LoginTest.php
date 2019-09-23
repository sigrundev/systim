<?php

namespace Systim\Tests\Login;

use Systim\Systim;
use Systim\Tests\SystimTestCase;

class LoginTest extends SystimTestCase
{
    public function testLoginStatic()
    {
        /**
         * Expected behavior:
         * 1. Static method login should return SystimClient
         */
        $result = Systim::login($this->company, $this->username, $this->password);

        $this->assertInstanceOf(Systim::class, $result);
        $this->assertEquals(38, strlen($result->getToken()));
    }

    public function testLogin()
    {
        $systim = new Systim($this->company);
        $result = $systim->doLogin($this->username, $this->password);

        $this->assertInstanceOf(Systim::class, $result);
        $this->assertEquals(38, strlen($result->getToken()));

    }
}