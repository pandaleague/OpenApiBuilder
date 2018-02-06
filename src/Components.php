<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class Components implements Arrayable
{
    use ToArray;

    protected $schemas         = [];
    protected $responses       = [];
    protected $parameters      = [];
    protected $examples        = [];
    protected $requestBodies   = [];
    protected $headers         = [];
    protected $securitySchemes = [];
    protected $links           = [];
    protected $callbacks       = [];

    public function schema(string $name, Schema $value) : Components
    {
        return $this->add($name, $value, $this->schemas);
    }

    public function response(string $name, Response $value) : Components
    {
        return $this->add($name, $value, $this->responses);
    }

    public function parameter(string $name, Parameter $value) : Components
    {
        return $this->add($name, $value, $this->parameters);
    }

    public function example(string $name, Example $value) : Components
    {
        return $this->add($name, $value, $this->examples);
    }

    public function requestBody(string $name, RequestBody $value) : Components
    {
        return $this->add($name, $value, $this->requestBodies);
    }

    public function headers(string $name, Header $value) : Components
    {
        return $this->add($name, $value, $this->headers);
    }

    public function securityScheme(string $name, SecurityScheme $value) : Components
    {
        return $this->add($name, $value, $this->securitySchemes);
    }

    public function link(string $name, Link $value) : Components
    {
        return $this->add($name, $value, $this->links);
    }

    public function callback(string $name, Callback $value) : Components
    {
        return $this->add($name, $value, $this->callbacks);
    }


    protected function add(string $name, $value, &$container) : Components
    {
        $this->validateName($name);
        $container[$name] = $value;

        return $this;
    }

    protected function validateName($name)
    {
        if (!preg_match('/^[a-zA-Z0-9.-_]+$/', $name)) {
            throw new \InvalidArgumentException($name.' should have the pattern ^[a-zA-Z0-9.-_]+$');
        }
    }
}
