<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Each Media Type Object provides schema and examples for the media type identified by its key.
 *
 * Class MediaType
 * @package PandaLeague\OpenApiBuilder
 */
class MediaType implements Arrayable
{
    use ToArray;

    protected $schema;
    protected $examples = [];
    protected $encoding = [];

    /**
     * The schema defining the type used for the request body.
     *
     * @param Schema $schema
     * @return MediaType
     */
    public function schema(Schema $schema) : MediaType
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * Examples of the media type. Each example object SHOULD match the media type and specified schema if present. The
     * examples field is mutually exclusive of the example field. Furthermore, if referencing a schema which contains
     * an example, the examples value SHALL override the example provided by the schema.
     *
     * @param string $name
     * @param Example $example
     * @return MediaType
     */
    public function example(string $name, Example $example) : MediaType
    {
        $this->examples[$name] = $example;
        return $this;
    }

    /**
     * A map between a property name and its encoding information. The key, being the property name, MUST exist in the
     * schema as a property. The encoding object SHALL only apply to requestBody objects when the media type is
     * multipart or application/x-www-form-urlencoded.
     *
     * @param string $key
     * @param Encoding $encoding
     * @return MediaType
     */
    public function encoding(string $key, Encoding $encoding) : MediaType
    {
        $this->encoding[$key] = $encoding;
        return $this;
    }
}