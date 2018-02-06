<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Allows referencing an external resource for extended documentation.
 *
 * Class ExternalDocumentation
 * @package PandaLeague\OpenApiBuilder
 */
class ExternalDocumentation implements Arrayable
{
    use ToArray;

    protected $description;
    protected $url;

    /**
     * ExternalDocumentation constructor.
     * @param string $url The URL for the target documentation. Value MUST be in the format of a URL.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * A short description of the target documentation. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return ExternalDocumentation
     */
    public function description(string $description) : ExternalDocumentation
    {
        $this->description = $description;
        return $this;
    }
}