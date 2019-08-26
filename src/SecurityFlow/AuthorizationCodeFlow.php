<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

class AuthorizationCodeFlow extends ImplicitFlow
{
    protected $type = 'authorizationCode';
    protected $tokenUrl;

    public function __construct(string $authUrl, string $tokenUrl)
    {
        $this->tokenUrl = $tokenUrl;
        parent::__construct($authUrl);
    }
}
