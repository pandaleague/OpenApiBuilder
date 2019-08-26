<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class SecurityScheme implements Arrayable
{
    use ToArray;

    protected $description = '';
    protected $securitySchemeObject;

    public function __construct(SecuritySchemeObject $securitySchemeObject)
    {
        $this->securitySchemeObject = $securitySchemeObject;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function toArray()
    {
        $data = [];

        if ($this->description !== '') {
            $data['description'] = $this->description;
        }

        return array_merge($data, $this->securitySchemeObject->toArray());
    }
}