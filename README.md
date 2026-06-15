# OpenApiBuilder

A small, fluent PHP library for assembling [OpenAPI 3.0](https://spec.openapis.org/oas/v3.0.3) specifications as PHP arrays — ready to encode to JSON or YAML.

## Requirements

- PHP 8.3+
- `illuminate/contracts` ^11 || ^12

## Installation

```bash
composer require pandaleague/openapibuilder
```

## Quick example

```php
use PandaLeague\OpenApiBuilder\{
    OpenApi, Info, Path, Operation, Parameter, Response, MediaType, Schema
};

$listPets = (new Operation())
    ->tag('Pets')
    ->summary('List pets')
    ->operationId('listPets')
    ->parameter(
        new Parameter('limit', Parameter::IN_QUERY, new Schema(['type' => 'integer']))
    )
    ->response(
        200,
        (new Response('A list of pets'))
            ->content(
                'application/json',
                (new MediaType())->schema(new Schema([
                    'type'  => 'array',
                    'items' => ['$ref' => '#/components/schemas/Pet'],
                ]))
            )
    );

$openApi = new OpenApi(
    '3.0.0',
    new Info('Pet Store API', '1.0.0'),
    ['/pets' => (new Path())->get($listPets)]
);

echo json_encode($openApi->toArray(), JSON_PRETTY_PRINT);
```

All builder classes implement `Illuminate\Contracts\Support\Arrayable`, so `toArray()` produces the final spec.

## Development

Install dev dependencies and run the test suite:

```bash
composer install
composer test
```

## License

MIT
