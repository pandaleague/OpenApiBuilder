<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

class ImplicitFlow extends OAuthFlowObject
{
    protected $type = 'implicit';
    protected $authorizationUrl;
    protected $refreshUrl;

    public function __construct(string $authUrl)
    {
        $this->authorizationUrl = $authUrl;
    }
}
