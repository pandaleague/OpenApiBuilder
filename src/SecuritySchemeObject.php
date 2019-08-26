<?php

namespace PandaLeague\OpenApiBuilder;

use Illuminate\Contracts\Support\Arrayable;

abstract class SecuritySchemeObject implements Arrayable
{
    use ToArray;
}
