<?php

namespace Systim\Result;

use Exception;
use function Stringy\create as s;

class SystimResult
{
    /**
     * Raw API call result
     *
     * @var string
     */
    protected $raw;

    /**
     * Decoded API call result
     *
     * @var mixed
     */
    protected $decoded;

    /**
     * SystimResult constructor.
     *
     * @param string $raw
     * @throws Exception
     */
    public function __construct(string $raw)
    {
        try {
            $this->raw = $raw;
            $this->decoded = json_decode($raw);

            $this->hasErrors();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Check whether result contains error message.
     *
     * @throws Exception
     */
    protected function hasErrors()
    {
        if($this->decoded->error->code !== 0) {
            throw new Exception($this->decoded->error->code . ': ' .$this->decoded->error->message);
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if(0 !== strpos($name, 'get')) {
            return $this->$name($arguments);
        }

        $fieldName = substr($name, 3);
        $fieldName = s($fieldName)->camelize();

        return $this->getField($fieldName);

    }

    /**
     * Get value for the given field.
     *
     * @param string $field
     * @return mixed
     */
    protected function getField(string $field)
    {
        return $this->decoded->result->$field ?: null;
    }
}