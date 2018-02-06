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
    protected $example;
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
     * Example of the media type. The example object SHOULD be in the correct format as specified by the media type.
     * The example field is mutually exclusive of the examples field. Furthermore, if referencing a schema which
     * contains an example, the example value SHALL override the example provided by the schema.
     *
     * @param $example
     * @return MediaType
     */
    public function examples($example) : MediaType
    {
        $this->example = $example;
        return $this;
    }

    /**
     * Examples of the media type. Each example object SHOULD match the media type and specified schema if present. The
     * examples field is mutually exclusive of the example field. Furthermore, if referencing a schema which contains
     * an example, the examples value SHALL override the example provided by the schema.
     *
     * @param string $mediaType
     * @param Example $example
     * @return MediaType
     */
    public function example(string $mediaType, Example $example) : MediaType
    {
        $this->example[$mediaType] = $example;
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