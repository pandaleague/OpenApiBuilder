<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

class Operation implements Arrayable
{
    use ToArray;

    protected $tags = [];
    protected $summary;
    protected $description;
    protected $externalDocs;
    protected $operationId;
    protected $parameters = [];
    protected $requestBody;
    protected $responses = [];
    protected $callbacks = [];
    protected $deprecated = false;
    protected $security = [];
    protected $servers = [];

    /**
     * A list of tags for API documentation control. Tags can be used for logical grouping of operations by resources
     * or any other qualifier.
     *
     * @param string $tag
     * @return Operation
     */
    public function tag(string $tag) : Operation
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * A short summary of what the operation does.
     *
     * @param string $summary
     * @return Operation
     */
    public function summary(string $summary) : Operation
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * A verbose explanation of the operation behavior. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return Operation
     */
    public function description(string $description) : Operation
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Additional external documentation for this operation.
     *
     * @param ExternalDocumentation $externalDocumentation
     * @return Operation
     */
    public function externalDocs(ExternalDocumentation $externalDocumentation) : Operation
    {
        $this->externalDocs = $externalDocumentation;
        return $this;
    }

    /**
     * Unique string used to identify the operation. The id MUST be unique among all operations described in the API.
     * Tools and libraries MAY use the operationId to uniquely identify an operation, therefore, it is RECOMMENDED to
     * follow common programming naming conventions.
     *
     * @param string $operationId
     * @return Operation
     */
    public function operationId(string $operationId) : Operation
    {
        $this->operationId = $operationId;
        return $this;
    }

    /**
     * The list of possible responses as they are returned from executing this operation.
     *
     * @param $statusCode
     * @param Response $response
     * @return Operation
     */
    public function response($statusCode, Response $response) : Operation
    {
        $this->responses[$statusCode] = $response;
        return $this;
    }

    /**
     * A list of parameters that are applicable for this operation. If a parameter is already defined at the Path Item,
     * the new definition will override it but can never remove it. The list MUST NOT include duplicated parameters. A
     * unique parameter is defined by a combination of a name and location. The list can use the Reference Object to
     * link to parameters that are defined at the OpenAPI Object's components/parameters.
     *
     * @param Parameter $parameter
     * @return Operation
     */
    public function parameter(Parameter $parameter) : Operation
    {
        $this->parameters[] = $parameter;
        return $this;
    }

    /**
     * The request body applicable for this operation. The requestBody is only supported in HTTP methods where the
     * HTTP 1.1 specification RFC7231 has explicitly defined semantics for request bodies. In other cases where the
     * HTTP spec is vague, requestBody SHALL be ignored by consumers.
     *
     * @param RequestBody $body
     * @return Operation
     */
    public function requestBody(RequestBody $body) : Operation
    {
        $this->requestBody = $body;
        return $this;
    }

    /**
     * A map of possible out-of band callbacks related to the parent operation. The key is a unique identifier for
     * the Callback Object. Each value in the map is a Callback Object that describes a request that may be initiated
     * by the API provider and the expected responses. The key value used to identify the callback object is an
     * expression, evaluated at runtime, that identifies a URL to use for the callback operation.
     *
     * @param string $key
     * @param callable $callback
     * @return Operation
     */
    public function callback(string $key, Callback $callback) : Operation
    {
        $this->callbacks[$key] = $callback;
        return $this;
    }

    /**
     * Declares this operation to be deprecated. Consumers SHOULD refrain from usage of the declared operation.
     * Default value is false.
     *
     * @param bool $deprecated
     * @return Operation
     */
    public function deprecated(bool $deprecated) : Operation
    {
        $this->deprecated = $deprecated;
        return $this;
    }

    /**
     * A declaration of which security mechanisms can be used for this operation. The list of values includes
     * alternative security requirement objects that can be used. Only one of the security requirement objects need to
     * be satisfied to authorize a request. This definition overrides any declared top-level security. To remove a
     * top-level security declaration, an empty array can be used.
     *
     * @param Security $security
     * @return Operation
     */
//    public function addSecurity(Security $security) : Operation
//    {
//        $this->security[] = $security;
//        return $this;
//    }

    /**
     * An alternative server array to service this operation. If an alternative server object is specified at the Path
     * Item Object or Root level, it will be overridden by this value.
     * @param Server $serer
     * @return Operation
     */
    public function server(Server $serer) : Operation
    {
        $this->servers[] = $serer;
        return $this;
    }
}
