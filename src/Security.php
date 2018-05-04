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
    use ToArray;

    protected $scope;

    /**
     * The OAuth scope for the resource
     *
     * Security constructor.
     * @param string $scope
     */
    public function __construct(string $scope)
    {
        $this->scope = $scope;
    }

}
