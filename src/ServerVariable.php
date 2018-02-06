<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * An object representing a Server Variable for server URL template substitution.
 *
 * Class ServerVariable
 * @package PandaLeague\OpenApiBuilder
 */
class ServerVariable implements Arrayable
{
    use ToArray;

    protected $default;
    protected $enum = [];
    protected $description;

    /**
     * The default value to use for substitution, and to send, if an alternate value is not supplied.
     * Unlike the Schema Object's default, this value MUST be provided by the consumer.
     *
     * ServerVariable constructor.
     * @param string $default
     */
    public function __construct(string $default)
    {
        $this->default = $default;
    }

    /**
     * An enumeration of string values to be used if the substitution options are from a limited set.
     *
     * @param string $value
     * @return ServerVariable
     */
    public function enum(string $value) : ServerVariable
    {
        $this->enum[] = $value;

        return $this;
    }

    /**
     * An array enumeration of string values to be used if the substitution options are from a limited set.
     *
     * @param string[] $enum
     * @return ServerVariable
     */
    public function enums(array $enum) : ServerVariable
    {
        $this->enum = $enum;

        return $this;
    }

    /**
     * An optional description for the server variable. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return ServerVariable
     */
    public function description(string $description) : ServerVariable
    {
        $this->description = $description;

        return $this;
    }
}
