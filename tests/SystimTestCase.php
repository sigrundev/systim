<?php

namespace Systim\Tests;

use PHPUnit\Framework\TestCase;

class SystimTestCase extends TestCase
{

    /**
     * @var string|null
     */
    protected $company;

    /**
     * @var string|null
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $password;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->company = getenv('SYSTIM_TEST_COMPANY') ?: null;
        $this->username = getenv('SYSTIM_TEST_USERNAME') ?: null;
        $this->password = getenv('SYSTIM_TEST_PASSWORD') ?: null;
    }
}