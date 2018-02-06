<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Describes a single response from an API Operation, including design-time, static links to operations based on
 * the response.
 *
 * Class Response
 * @package PandaLeague\OpenApiBuilder
 */
class Response implements Arrayable
{

    use ToArray;

    protected $headers = [];
    protected $description;
    protected $content = [];
    protected $links = [];

    /**
     * Response constructor.
     * @param string $description A short description of the response. CommonMark syntax MAY be used for rich text
     *  representation.
     */
    public function __construct(string $description)
    {
        $this->description = $description;
    }

    /**
     * Maps a header name to its definition. RFC7230 states header names are case insensitive. If a response header is
     * defined with the name "Content-Type", it SHALL be ignored.
     *
     * @param string $name
     * @param Header $header
     * @return Response
     */
    public function header(string $name, Header $header) : Response
    {
        $this->headers[$name] = $header;
        return $this;
    }

    /**
     * A map containing descriptions of potential response payloads. The key is a media type or media type range and
     * the value describes it. For responses that match multiple keys, only the most specific key is applicable. e.g.
     * text/plain overrides text/*
     *
     * @param string $name
     * @param MediaType $mediaType
     * @return Response
     */
    public function content(string $name, MediaType $mediaType) : Response
    {
        $this->content[$name] = $mediaType;
        return $this;
    }

    /**
     * A map of operations links that can be followed from the response. The key of the map is a short name for the
     * link, following the naming constraints of the names for Component Objects.
     *
     * @param string $name
     * @param Link $link
     * @return Response
     */
    public function links(string $name, Link $link) : Response
    {
        $this->links[$name] = $link;
        return $this;
    }

}