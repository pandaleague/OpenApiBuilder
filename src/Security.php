<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * An object representing a Server.
 *
 * Class Server
 * @package PandaLeague\OpenApiBuilder
 */
class Security implements Arrayable
{

    protected $security = [];

    /**
     * The OAuth scope for the resource
     *
     * Security constructor.
     * @param string $name The name of the SecuritySchema
     * @param string[] $scopes Array of scopes when the security schema is oauth2
     */
    public function __construct(string $name, array $scopes = [])
    {
        foreach ($scopes as $scope) {
            if (!is_string($scope)) {
                throw new \InvalidArgumentException('Scope must be an array of strings');
            }
        }
        $this->security[$name] = $scopes;
    }

    public function toArray()
    {
        return $this->security;
    }

}
