<?php

namespace PandaLeague\OpenApiBuilder;

class Encoding
{
    protected $contentType;
    protected $headers = [];
    protected $style;
    protected $explode = true;
    protected $allowReserved = false;

    /**
     * The Content-Type for encoding a specific property. Default value depends on the property type: for string with
     * format being binary – application/octet-stream; for other primitive types – text/plain;
     * for object - application/json; for array – the default is defined based on the inner type.
     * The value can be a specific media type (e.g. application/json), a wildcard media type (e.g. image/*),
     * or a comma-separated list of the two types.
     *
     * @param string $contentType
     * @return Encoding
     */
    public function contentType(string $contentType) : Encoding
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * A map allowing additional information to be provided as headers, for example Content-Disposition. Content-Type
     * is described separately and SHALL be ignored in this section. This property SHALL be ignored if the request body
     * media type is not a multipart.
     *
     * @param string $name
     * @param Header $header
     * @return Encoding
     */
    public function header(string $name, Header $header) : Encoding
    {
        $this->headers[$name] = $header;
        return $this;
    }

    /**
     * Describes how a specific property value will be serialized depending on its type. See Parameter Object for
     * details on the style property. The behavior follows the same values as query parameters, including default
     * values. This property SHALL be ignored if the request body media type is not application/x-www-form-urlencoded.
     *
     * @param string $style
     * @return Encoding
     */
    public function style(string $style) : Encoding
    {
        $this->style = $style;
        return $this;
    }

    /**
     * When this is true, property values of type array or object generate separate parameters for each value of the
     * array, or key-value-pair of the map. For other types of properties this property has no effect. When style is
     * form, the default value is true. For all other styles, the default value is false. This property SHALL be ignored
     * if the request body media type is not application/x-www-form-urlencoded.
     *
     * @param bool $explode
     * @return Encoding
     */
    public function explode(bool $explode) : Encoding
    {
        $this->explode = $explode;
        return $this;
    }

    /**
     * Determines whether the parameter value SHOULD allow reserved characters, as defined by
     * RFC3986 :/?#[]@!$&'()*+,;= to be included without percent-encoding. The default value is false. This property
     * SHALL be ignored if the request body media type is not application/x-www-form-urlencoded.
     *
     * @param bool $reserved
     * @return Encoding
     */
    public function allowedReserved(bool $reserved) : Encoding
    {
        $this->allowReserved = $reserved;
        return $this;
    }
}