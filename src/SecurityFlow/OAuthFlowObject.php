<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

use Illuminate\Contracts\Support\Arrayable;
use PandaLeague\OpenApiBuilder\SecuritySchemeObject;
use PandaLeague\OpenApiBuilder\ToArray;

class OAuthFlowObject extends SecuritySchemeObject implements Arrayable
{
    use ToArray;

    protected $type;
    protected $refreshUrl;
    protected $scopes = [];

    public function addScope(string $name, string $description): self
    {
        $this->scopes[$name] = $description;

        return $this;
    }

    public function refreshUrl(string $url): self
    {
        $this->refreshUrl = $url;

        return $this;
    }

    public function type(): string
    {
        return $this->type;
    }
}