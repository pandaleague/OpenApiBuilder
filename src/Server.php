<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * An object representing a Server.
 *
 * Class Server
 * @package PandaLeague\OpenApiBuilder
 */
class Server implements Arrayable
{
    use ToArray;

    protected $url;
    protected $description;
    protected $variables = [];

    /**
     * A URL to the target host. This URL supports Server Variables and MAY be relative, to indicate that the host
     * location is relative to the location where the OpenAPI document is being served. Variable substitutions will
     * be made when a variable is named in {brackets}.
     *
     * Server constructor.
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * An optional string describing the host designated by the URL. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return Server
     */
    public function description(string $description) : Server
    {
        $this->description = $description;

        return $this;
    }

    /**
     * A map between a variable name and its value. The value is used for substitution in the server's URL template.
     *
     * @param string $name
     * @param ServerVariable $variable
     * @return Server
     */
    public function variable(string $name, ServerVariable $variable) : Server
    {
        $this->variables[$name] = $variable;

        return $this;
    }

    /**
     * Array of ServerVariable. The array key will be used as the variable name as per addVariable
     *
     * @param ServerVariable[] $variables
     * @return Server
     */
    public function variables(array $variables) : Server
    {
        foreach ($variables as $variable) {
            if ( ! $variable instanceof ServerVariable) {
                throw new \RuntimeException('Expecting a variable of type: '.ServerVariable::class);
            }
        }
        $this->variables = $variables;

        return $this;
    }
}
