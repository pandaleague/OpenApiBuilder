<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * The object provides metadata about the API. The metadata MAY be used by the clients if needed, and MAY be
 * presented in editing or documentation generation tools for convenience.
 *
 * Class Info
 * @package PandaLeague\OpenApiBuilder
 *
 * @example
 * {
 *  "title": "Sample Pet Store App",
 *  "description": "This is a sample server for a pet store.",
 *  "termsOfService": "http://example.com/terms/",
 *  "contact": {
 *      "name": "API Support",
 *      "url": "http://www.example.com/support",
 *      "email": "support@example.com"
 *  },
 *  "license": {
 *      "name": "Apache 2.0",
 *      "url": "https://www.apache.org/licenses/LICENSE-2.0.html"
 *  },
 *  "x-logo": {
 *      "url": "http://www.example.com/assets/img/logo.png",
 *      "backgroundColor": "#000000",
 *      "altText": "Examplef"
 *  },
 *  "version": "1.0.1"
 * }
 */
class Info implements Arrayable
{
    use ToArray;

    protected $title;
    protected $version;
    protected $description;
    protected $termsOfService;
    protected $contact;
    protected $x_logo;

    /**
     * Info constructor.
     * @param string $title The title of the application.
     * @param string $version The version of the OpenAPI document (which is distinct from the OpenAPI Specification
     *  version or the API implementation version).
     */
    public function __construct(string $title, string $version)
    {
        $this->title   = $title;
        $this->version = $version;
    }

    /**
     * A short description of the application. CommonMark syntax MAY be used for rich text representation.
     * http://spec.commonmark.org/
     *
     * @param string $description
     * @return Info
     */
    public function description(string $description) : Info
    {
        $this->description = $description;

        return $this;
    }

    /**
     * A URL to the Terms of Service for the API. MUST be in the format of a URL.
     *
     * @param string $toc
     * @return Info
     */
    public function termsOfService(string $toc) : Info
    {
        $this->termsOfService = $toc;

        return $this;
    }

    /**
     * The contact information for the exposed API.
     *
     * @param Contact $contact
     * @return Info
     */
    public function contact(Contact $contact) : Info
    {
        $this->contact = $contact->toArray();

        return $this;
    }

    /**
     * The logo information for the exposed API.
     *
     * @param Logo $logo
     * @return Info
     */
    public function logo(Logo $logo) : Info
    {
        $this->x_logo = $logo;

        return $this;
    }

    /**
     * The license information for the exposed API.
     *
     * @param License $license
     * @return Info
     */
    public function license(License $license) : Info
    {
        $this->license = $license;

        return $this;
    }
}
