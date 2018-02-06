<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Describes a single request body.
 *
 * Class RequestBody
 * @package PandaLeague\OpenApiBuilder
 */
class RequestBody implements Arrayable
{
   use ToArray;

   protected $description;
   protected $content = [];
   protected $required = false;

    /**
     * The content of the request body. The key is a media type or media type range and the value describes it.
     * For requests that match multiple keys, only the most specific key is applicable. e.g. text/plain overrides text/*
     *
     * @param string $type
     * @param MediaType $mediaType
     * @return RequestBody
     */
   public function content(string $type, MediaType $mediaType) : RequestBody
   {
       $this->content[$type] = $mediaType;

       return $this;
   }

   public function required(bool $required) : RequestBody
   {
       $this->required = $required;
       return $this;
   }

    /**
     * A brief description of the request body. This could contain examples of use. CommonMark syntax MAY be used for rich text representation.
     *
     * @param string $description
     * @return RequestBody
     */
   public function description(string $description) : RequestBody
   {
       $this->description = $description;
       return $this;
   }
}