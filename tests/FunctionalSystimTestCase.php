<?php

namespace Systim\Tests;

use Systim\Systim;

class FunctionalSystimTestCase extends SystimTestCase
{

    /**
     * @var Systim
     */
    protected $systim;

    /**
     * FunctionalSystimTestCase constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->systim = Systim::login($this->company, $this->username, $this->password);
    }
}