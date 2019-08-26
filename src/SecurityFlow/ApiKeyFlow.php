<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

use PandaLeague\OpenApiBuilder\SecuritySchemeObject;

class ApiKeyFlow extends SecuritySchemeObject
{
    protected $type = 'apiKey';
    protected $name;
    protected $in;

    public function __construct(string $name, string $in)
    {
        if (! in_array($in, ['query', 'header', 'cookie'])) {
            throw new \LogicException("You must specify one of 'query', 'header', 'cookie' for 'in'");
        }

        $this->name = $name;
        $this->in   = $in;
    }
}
