<?php

namespace PandaLeague\OpenApiBuilder;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Describes a single operation parameter.
 * A unique parameter is defined by a combination of a name and location.
 *
 * Parameter Locations
 * There are four possible parameter locations specified by the in field:
 *  + path - Used together with Path Templating, where the parameter value is actually part of the operation's URL.
 *      This does not include the host or base path of the API. For example, in /items/{itemId}, the path parameter
 *      is itemId.
 *  + query - Parameters that are appended to the URL. For example, in /items?id=###, the query parameter is id.
 *  + header - Custom headers that are expected as part of the request. Note that RFC7230 states header names are
 *      case insensitive.
 *  + cookie - Used to pass a specific cookie value to the API.
 *
 * Class Parameter
 * @package PandaLeague\OpenApiBuilder
 */
class Parameter implements Arrayable
{
    use ToArray;

    const IN_QUERY  = 'query';
    const IN_HEADER = 'header';
    const IN_PATH   = 'path';
    const IN_COOKIE = 'cookie';

    const STYLE_FORM   = 'form';
    const STYLE_SIMPLE = 'simple';

    protected $name;
    protected $in;
    protected $description;
    protected $required;
    protected $deprecated;
    protected $allowEmptyValues;
    protected $style;
    protected $explode;
    protected $allowReserved;
    protected $schema;
    protected $example;
    protected $examples;
    protected $content;

    /** TODO: Implement the below formatting fields */
    protected $matrix;
    protected $label;
    protected $form;
    protected $simple;
    protected $spaceDelimited;
    protected $pipeDelimited;
    protected $deepObject;

    /**
     * Parameter constructor.
     * @param string $name The name of the parameter. Parameter names are case sensitive.
     *  + If in is "path", the name field MUST correspond to the associated path segment from the path field in the
     *      Paths Object. See Path Templating for further information.
     *  + If in is "header" and the name field is "Accept", "Content-Type" or "Authorization", the parameter definition
     *      SHALL be ignored.
     *  + For all other cases, the name corresponds to the parameter name used by the in property.
     * @param string $in The location of the parameter. Possible values are "query", "header", "path" or "cookie".
     * @param Schema $schema The schema defining the type used for the parameter.
     */
    public function __construct(string $name, string $in, Schema $schema)
    {
        if (!in_array($in, [Parameter::IN_QUERY, Parameter::IN_COOKIE, Parameter::IN_HEADER, Parameter::IN_PATH])) {
            throw new \InvalidArgumentException('Invalid "in" option received');
        }

        if ($in == Parameter::IN_PATH) {
            $this->required = true;
        }

        $this->schema = $schema;
        $this->in = $in;
        $this->name = $name;
    }

    /**
     * A brief description of the parameter. This could contain examples of use. CommonMark syntax MAY be used for
     * rich text representation.
     *
     * @param string $description
     * @return Parameter
     */
    public function description(string $description) : Parameter
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Determines whether this parameter is mandatory. If the parameter location is "path", this property is
     * REQUIRED and its value MUST be true. Otherwise, the property MAY be included and its default value is false.
     *
     * @param bool $required
     * @return Parameter
     */
    public function required(bool $required) : Parameter
    {
        if ($this->in == Parameter::IN_PATH) {
            $required = true;
        }

        $this->required = $required;
        return $this;
    }

    /**
     * Specifies that a parameter is deprecated and SHOULD be transitioned out of usage.
     *
     * @param bool $deprecated
     * @return Parameter
     */
    public function deprecated(bool $deprecated) : Parameter
    {
        $this->deprecated = $deprecated;
        return $this;
    }

    /**
     * Sets the ability to pass empty-valued parameters. This is valid only for query parameters and allows sending
     * a parameter with an empty value. Default value is false. If style is used, and if behavior is n/a (cannot be
     * serialized), the value of allowEmptyValue SHALL be ignored.
     *
     * @param bool $value
     * @return Parameter
     */
    public function allowEmptyValues(bool $value) : Parameter
    {
        $this->allowEmptyValues = $value;
        return $this;
    }

    /**
     * Describes how the parameter value will be serialized depending on the type of the parameter value. Default
     * values (based on value of in): for query - form; for path - simple; for header - simple; for cookie - form.
     *
     * @param string $style
     * @return Parameter
     */
    public function style(string $style) : Parameter
    {
        if (!in_array($style, [Parameter::STYLE_SIMPLE, Parameter::STYLE_FORM])) {
            throw new \InvalidArgumentException('Invalid style parameter received');
        }
        $this->style = $style;
        return $this;
    }

    /**
     * When this is true, parameter values of type array or object generate separate parameters for each value of the
     * array or key-value pair of the map. For other types of parameters this property has no effect. When style is
     * form, the default value is true. For all other styles, the default value is false.
     *
     * @param bool $explode
     * @return Parameter
     */
    public function explode(bool $explode) : Parameter
    {
        $this->explode = $explode;
        return $this;
    }

    /**
     * Determines whether the parameter value SHOULD allow reserved characters,
     * as defined by RFC3986 :/?#[]@!$&'()*+,;= to be included without percent-encoding. This property only applies
     * to parameters with an in value of query. The default value is false.
     *
     * @param bool $reserved
     * @return Parameter
     */
    public function allowReserved(bool $reserved) : Parameter
    {
        $this->allowReserved = $reserved;
        return $this;
    }

    /**
     * Example of the media type. The example SHOULD match the specified schema and encoding properties if present.
     * The example field is mutually exclusive of the examples field. Furthermore, if referencing a schema which
     * contains an example, the example value SHALL override the example provided by the schema. To represent
     * examples of media types that cannot naturally be represented in JSON or YAML, a string value can contain the
     * example with escaping where necessary.
     *
     * @param $example
     * @return Parameter
     */
    public function examples($example) : Parameter
    {
        $this->example = $example;
        return $this;
    }

    /**
     * Examples of the media type. Each example SHOULD contain a value in the correct format as specified in the
     * parameter encoding. The examples field is mutually exclusive of the example field. Furthermore, if referencing
     * a schema which contains an example, the examples value SHALL override the example provided by the schema.
     *
     * @param string $encoding
     * @param Example $example
     * @return Parameter
     */
    public function example(string $encoding, Example $example) : Parameter
    {
        $this->examples[$encoding] = $example;
        return $this;
    }

    /**
     * A map containing the representations for the parameter. The key is the media type and the value describes it.
     * The map MUST only contain one entry.
     *
     * @param string $key
     * @param MediaType $mediaType
     * @return Parameter
     */
    public function content(string $key, MediaType $mediaType) : Parameter
    {
        $this->content = [$key => $mediaType];
        return $this;
    }
}