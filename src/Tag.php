<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class Tag implements Arrayable
{
    use ToArray;

    protected $name;
    protected $description;
    protected $externalDocs;

    /**
     * Tag constructor.
     * @param string $name The name of the tag.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * A short description for the tag. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return Tag
     */
    public function description(string $description) : Tag
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Additional external documentation for this tag.
     *
     * @param ExternalDocumentation $externalDocumentation
     * @return Tag
     */
    public function externalDocs(ExternalDocumentation $externalDocumentation) : Tag
    {
        $this->externalDocs = $externalDocumentation;
        return $this;
    }
}