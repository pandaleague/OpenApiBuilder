<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class Schema implements Arrayable
{
    use ToArray;

    protected $schema;

    public function __construct(array $schema)
    {
        $this->schema = $schema;
    }

    public function schema()
    {
        return $this->schema;
    }
}