<?php

namespace PandaLeague\OpenApiBuilder;

class Component
{
    protected $schema;
    protected $response;
    protected $parameter;
    protected $example;
    protected $requestBody;
    protected $header;
    protected $securityScheme;
    protected $link;
    protected $callback;
    protected $name;

    public function __construct(string $name)
    {
        if (!preg_match('^[a-zA-Z0-9\.\-_]+$', $name)) {
            throw new \InvalidArgumentException('{$name} should have the pattern ^[a-zA-Z0-9\.\-_]+$');
        }

        $this->name = $name;
    }

    public function schema(Schema $schema) : Component
    {
        $this->schema = $schema;
        return $this;
    }

    public function response(Response $response) : Component
    {
        $this->response = $response;
        return $this;
    }

    public function parameter(Parameter $parameter) : Component
    {
        $this->parameter = $parameter;
        return $this;
    }

    public function example(Example $example) : Component
    {
        $this->example = $example;
        return $this;
    }

    public function requestBody(RequestBody $requestBody) : Component
    {
        $this->requestBody = $requestBody;
        return $this;
    }

    public function header(Header $header) : Component
    {
        $this->header = $header;
        return $this;
    }

    public function securityScheme(SecurityScheme $scheme) : Component
    {
        $this->securityScheme = $scheme;
        return $this;
    }

    public function link(Link $link) : Component
    {
        $this->link = $link;
        return $this;
    }

    public function callback(Callback $callback) : Component
    {
        $this->callback = $callback;
    }
}
