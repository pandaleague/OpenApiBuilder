<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

use PandaLeague\OpenApiBuilder\SecuritySchemeObject;

class OpenIdConnectFlow extends SecuritySchemeObject
{
    protected $type = 'openIdConnect';
    protected $openIdConnectUrl;

    public function __construct(string $openIdConnectUrl)
    {
        $this->openIdConnectUrl = $openIdConnectUrl;
    }
}
