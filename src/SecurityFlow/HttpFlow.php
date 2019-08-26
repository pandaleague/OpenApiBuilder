<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

use PandaLeague\OpenApiBuilder\SecuritySchemeObject;

class HttpFlow extends SecuritySchemeObject
{
    protected $type = 'http';
    protected $scheme;
    protected $bearerFormat;

    public function __construct(string $scheme)
    {
        if (! in_array($scheme, ['basic', 'bearer', 'digest', 'hoba', 'mutual', 'negotiate', 'oauth', 'scram-sha-1', 'scram-sha-256', 'vapid'])) {
            throw new \LogicException("You must specify a valid scheme, see https://www.iana.org/assignments/http-authschemes/http-authschemes.xhtml");
        }

        $this->scheme       = $scheme;
    }

    public function bearerFormat(string $format): self
    {
        $this->bearerFormat = $format;
    }
}
