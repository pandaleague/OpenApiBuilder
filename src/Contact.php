<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Contact information for the exposed API.
 *
 * Class Contact
 * @package PandaLeague\OpenApiBuilder
 */
class Contact implements Arrayable
{
    use ToArray;

    protected $name;
    protected $url;
    protected $email;

    /**
     * The identifying name of the contact person/organization.
     *
     * @param string $name
     * @return Contact
     */
    public function name(string $name) : Contact
    {
        $this->name = $name;

        return $this;
    }

    /**
     * The URL pointing to the contact information. MUST be in the format of a URL.
     *
     * @param string $url
     * @return Contact
     */
    public function url(string $url) :  Contact
    {
        $this->url = $url;

        return $this;
    }

    /**
     * The email address of the contact person/organization. MUST be in the format of an email address.
     *
     * @param string $email
     * @return Contact
     */
    public function email(string $email) : Contact
    {
        $this->email = $email;

        return $this;
    }

}
