<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class Example implements Arrayable
{
    use ToArray;

    protected $summary;
    protected $description;
    protected $value;
    protected $externalValue;

    /**
     * Short description for the example.
     *
     * @param string $summary
     * @return Example
     */
    public function summary(string $summary) : Example
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Long description for the example. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return Example
     */
    public function description(string $description) : Example
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Embedded literal example. The value field and externalValue field are mutually exclusive. To represent examples
     * of media types that cannot naturally represented in JSON or YAML, use a string value to contain the example,
     * escaping where necessary.
     *
     * @param $value
     * @return Example
     */
    public function value($value) : Example
    {
        $this->value = $value;
        return $this;
    }

    /**
     * A URL that points to the literal example. This provides the capability to reference examples that cannot easily
     * be included in JSON or YAML documents. The value field and externalValue field are mutually exclusive.
     *
     * @param string $value
     * @return Example
     */
    public function externalValue(string $value) : Example
    {
        $this->externalValue = $value;
        return $this;
    }
}