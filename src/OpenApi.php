<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class OpenApi implements Arrayable
{
    use ToArray;

    protected $openapi;
    protected $info;
    protected $paths;
    protected $servers = [];
    protected $components;
    protected $securityRequirements = [];
    protected $tags = [];
    protected $externalDocumentation;

    /**
     * Schema constructor.
     * @param string $openApiVersion This string MUST be the semantic version number of the OpenAPI Specification
     *  version that the OpenAPI document uses. The openapi field SHOULD be used by tooling specifications and clients
     *  to interpret the OpenAPI document. This is not related to the API info.version string.
     * @param Info $info Provides metadata about the API. The metadata MAY be used by tooling as required.
     * @param Path[] $paths The available paths and operations for the API.
     */
    public function __construct(string $openApiVersion, Info $info, array $paths)
    {
        $this->openapi = $openApiVersion;
        $this->info           = $info;

        foreach ($paths as $path => $properties) {
            if (strpos($path, '/') !== 0) {
                throw new \InvalidArgumentException('{$path} must start with a /');
            }

            if (!$properties instanceof Path) {
                throw new \InvalidArgumentException('A Path object is expected for '.$path);
            }
        }
        $this->paths = $paths;
    }

    /**
     * An array of Server Objects, which provide connectivity information to a target server. If the servers property
     * is not provided, or is an empty array, the default value would be a Server Object with a url value of /.
     *
     * @param Server $server
     * @return OpenApi
     */
    public function server(Server $server) : OpenApi
    {
        $this->servers[] = $server;

        return $this;
    }

    /**
     * An element to hold various schemas for the specification.
     *
     * @param Components $components
     * @return OpenApi
     */
    public function componenets(Components $components) : OpenApi
    {
        $this->components = $components;

        return $this;
    }

    /**
     * A declaration of which security mechanisms can be used across the API. The list of values includes alternative
     * security requirement objects that can be used. Only one of the security requirement objects need to be satisfied
     * to authorize a request. Individual operations can override this definition.
     *
     * @param SecurityRequirement $securityRequirement
     * @return OpenApi
     */
    public function securityRequirement(SecurityRequirement $securityRequirement) : OpenApi
    {
        $this->securityRequirements[] = $securityRequirement;

        return $this;
    }

    /**
     * A list of tags used by the specification with additional metadata. The order of the tags can be used to reflect
     * on their order by the parsing tools. Not all tags that are used by the Operation Object must be declared.
     * The tags that are not declared MAY be organized randomly or based on the tools' logic.
     * Each tag name in the list MUST be unique.
     *
     * @param Tag $tag
     * @return OpenApi
     */
    public function tag(Tag $tag) : OpenApi
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Additional external documentation.
     *
     * @param ExternalDocumentation $externalDocumentation
     * @return OpenApi
     */
    public function externalDocs(ExternalDocumentation $externalDocumentation) : OpenApi
    {
        $this->externalDocumentation = $externalDocumentation;

        return $this;
    }
}

