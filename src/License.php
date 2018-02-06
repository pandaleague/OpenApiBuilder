<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * License information for the exposed API.
 *
 * Class License
 * @package PandaLeague\OpenApiBuilder
 */
class License implements Arrayable
{

    use ToArray;

    protected $name;
    protected $url;

    /**
     * License constructor.
     * @param string $name The license name used for the API.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * A URL to the license used for the API. MUST be in the format of a URL.
     *
     * @param string $url
     * @return License
     */
    public function url(string $url) : License
    {
        $this->url = $url;

        return $this;
    }
}
