<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * The Link object represents a possible design-time link for a response. The presence of a link does not guarantee the
 * caller's ability to successfully invoke it, rather it provides a known relationship and traversal mechanism between
 * responses and other operations.
 *
 * Unlike dynamic links (i.e. links provided in the response payload), the OAS linking mechanism does not require link
 * information in the runtime response.
 *
 * For computing links, and providing instructions to execute them, a runtime expression is used for accessing values
 * in an operation and using them as parameters while invoking the linked operation.
 *
 * @see https://swagger.io/docs/specification/links/
 *
 * Class Link
 * @package PandaLeague\OpenApiBuilder
 */
class Link implements Arrayable
{
    use ToArray;

    protected $operationId;
    protected $description;
    protected $parameters;
    protected $operationRef;
    protected $requestBody;

    /**
     * operationId that specifies the target operation. It can be the same operation or a different operation in
     * the current or external API specification. operationId is used for local links only.
     *
     * Link constructor.
     * @param string $operationId
     */
    public function __construct(string $operationId)
    {
        $this->operationId = $operationId;
    }

    /**
     * $reference that specifies the target operation. It can be the same operation or a different operation in the
     * current or external API specification. operationRef can link to both local and external operations.
     *
     * @param string $reference
     * @return Link
     */
    public function operationRef(string $reference) : Link
    {
        $this->operationRef = $reference;
        return $this;
    }

    /**
     * parameters and/or requestBody sections that specify the values to pass to the target operation.
     * Runtime expression syntax is used to extract these values from the parent operation.
     *
     * @param string $name
     * @param string $reference
     * @return Link
     */
    public function parameter(string $name, string $reference) : Link
    {
        $this->parameters[$name] = $reference;
        return $this;
    }

    /**
     * A description of this link. CommonMark syntax can be used for rich text representation.
     *
     * @param string $reference
     * @return Link
     */
    public function requestBody(string $reference) : Link
    {
        $this->requestBody = $reference;
        return $this;
    }
}