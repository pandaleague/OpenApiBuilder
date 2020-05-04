<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Logo for the exposed API.
 *
 * Class Logo
 * @package PandaLeague\OpenApiBuilder
 */
class Logo implements Arrayable
{
    use ToArray;

    protected $url;
    protected $backgroundColor;
    protected $altText;

    /**
     * The URL pointing to the logo. MUST be in the format of a URL.
     *
     * @param string $url
     * @return Logo
     */
    public function url(string $url) :  Logo
    {
        $this->url = $url;

        return $this;
    }

    /**
     * The background color. MUST be in hex format.
     *
     * @param string $backgroundColor
     * @return Logo
     */
    public function backgroundColor(string $backgroundColor) :  Logo
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * The alt text.
     *
     * @param string $altText
     * @return Logo
     */
    public function altText(string $altText) :  Logo
    {
        $this->altText = $altText;

        return $this;
    }
}
