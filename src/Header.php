<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class Header implements Arrayable
{
    use ToArray;

    protected $schema;
    protected $description;

    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    public function description(string $description) : Header
    {
        $this->description = $description;
        return $this;
    }

}