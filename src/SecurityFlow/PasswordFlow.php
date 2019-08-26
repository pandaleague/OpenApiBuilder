<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

class PasswordFlow extends OAuthFlowObject
{
    protected $type = 'password';
    protected $tokenUrl;

    public function __construct(string $tokenUrl)
    {
        $this->tokenUrl = $tokenUrl;
    }
}