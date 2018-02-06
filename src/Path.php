<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Describes the operations available on a single path. A Path Item MAY be empty, due to ACL constraints.
 * The path itself is still exposed to the documentation viewer but they will not know which operations and parameters are available.
 *
 * Class Path
 * @package PandaLeague\OpenApiBuilder
 */
class Path implements Arrayable
{
    use ToArray;

    protected $summary;
    protected $description;
    protected $get;
    protected $put;
    protected $post;
    protected $delete;
    protected $options;
    protected $head;
    protected $patch;
    protected $trace;
    protected $servers = [];
    protected $parameters = [];

    /**
     * An optional, string summary, intended to apply to all operations in this path.
     *
     * @param string $summary
     * @return Path
     */
    public function summary(string $summary) : Path
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * An optional, string description, intended to apply to all operations in this path. CommonMark syntax
     * MAY be used for rich text representation.
     *
     * @param string $description
     * @return Path
     */
    public function description(string $description) : Path
    {
        $this->description = $description;
        return $this;
    }

    /**
     * A definition of a GET operation on this path.
     *
     * @param Operation $get
     * @return Path
     */
    public function get(Operation $get) : Path
    {
        $this->get = $get;
        return $this;
    }

    /**
     * A definition of a PUT operation on this path.
     *
     * @param Operation $put
     * @return Path
     */
    public function put(Operation $put) : Path
    {
        $this->put = $put;
        return $this;
    }

    /**
     * A definition of a POST operation on this path.
     *
     * @param Operation $post
     * @return Path
     */
    public function post(Operation $post) : Path
    {
        $this->post = $post;
        return $this;
    }

    /**
     * A definition of a DELETE operation on this path.
     *
     * @param Operation $delete
     * @return Path
     */
    public function delete(Operation $delete) : Path
    {
        $this->delete = $delete;
        return $this;
    }

    /**
     * A definition of a OPTIONS operation on this path.
     *
     * @param Operation $option
     * @return $this
     */
    public function options(Operation $option)
    {
        $this->options = $option;
        return $this;
    }

    /**
     * A definition of a HEAD operation on this path.
     *
     * @param Operation $head
     * @return $this
     */
    public function head(Operation $head)
    {
        $this->head = $head;
        return $this;
    }

    /**
     * A definition of a PATCH operation on this path.
     *
     * @param Operation $patch
     * @return $this
     */
    public function patch(Operation $patch)
    {
        $this->patch = $patch;
        return $this;
    }

    /**
     * A definition of a TRACE operation on this path.
     *
     * @param Operation $trace
     * @return $this
     */
    public function trace(Operation $trace)
    {
        $this->trace = $trace;
        return $this;
    }

    /**
     * An alternative server array to service all operations in this path.
     *
     * @param string $name
     * @param Server $server
     * @return Path
     */
    public function server(string $name, Server $server) : Path
    {
        $this->servers[$name] = $server;
        return $this;
    }

    /**
     * @param Server[] $servers
     * @return Path
     */
    public function servers(array $servers) : Path
    {
        foreach ($servers as $name => $server) {
            if (!$server instanceof Server) {
                throw new \InvalidArgumentException('Server object must be of type: '.Server::class);
            }
        }
        $this->servers = $servers;
        return $this;
    }

    /**
     * A list of parameters that are applicable for all the operations described under this path.
     * These parameters can be overridden at the operation level, but cannot be removed there.
     * The list MUST NOT include duplicated parameters. A unique parameter is defined by a combination of a name and
     * location. The list can use the Reference Object to link to parameters that are defined at the
     * OpenAPI Object's components/parameters.
     *
     * @param string $name
     * @param Parameter $parameter
     * @return Path
     */
    public function parameter(string $name, Parameter $parameter) : Path
    {
        $this->parameters[$name] = $parameter;
        return $this;
    }

    /**
     * @param array $parameters
     * @return Path
     */
    public function parameters(array $parameters) : Path
    {
        foreach ($parameters as $name => $parameter) {
            if (!$parameter instanceof Parameter) {
                throw new \InvalidArgumentException('Parameter object must be of type: '.Parameter::class);
            }
        }
        $this->parameters = $parameters;
        return $this;
    }
}
